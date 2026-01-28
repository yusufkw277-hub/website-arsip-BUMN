@extends('layouts.app')
@push('scripts')
    <script>
        // clear filter scrip
        function clearFilter() {
            document.getElementById('unit').value = ''
            document.getElementById('informasi_berkas').value = ''
            document.getElementById('nama_perusahaan').value = ''
            document.getElementById('tahun').value = ''
            window.location.href = '/data-arsip'
        }

        // CHECK ALL
        // Ambil selected IDs dari localStorage
        let selectedIds = JSON.parse(localStorage.getItem('selectedArsipIds') || '[]');

        // Fungsi untuk update checkbox UI berdasarkan selectedIds
        function syncCheckboxes() {
            document.querySelectorAll('.data-row').forEach(row => {
                const id = row.getAttribute('data-id');
                const checkbox = row.querySelector('.row-check');
                if (checkbox) {
                    checkbox.checked = selectedIds.includes(id);
                }
            });

            // Update status "Check All"
            const allCheckboxes = document.querySelectorAll('.row-check');
            const checkedCheckboxes = document.querySelectorAll('.row-check:checked');
            const checkAll = document.getElementById('checkAll');
            if (checkAll && allCheckboxes.length > 0) {
                checkAll.checked = (allCheckboxes.length === checkedCheckboxes.length);
            }
        }

        // Jalankan saat halaman dimuat
        document.addEventListener('DOMContentLoaded', syncCheckboxes);

        // Event listener untuk checkbox per baris
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('row-check')) {
                const row = e.target.closest('.data-row');
                const id = row.getAttribute('data-id');
                if (e.target.checked) {
                    if (!selectedIds.includes(id)) {
                        selectedIds.push(id);
                    }
                } else {
                    selectedIds = selectedIds.filter(i => i !== id);
                }
                localStorage.setItem('selectedArsipIds', JSON.stringify(selectedIds));
                syncCheckboxes(); // Update Check All status
            }
        });

        // Event listener untuk "Check All"
        const checkAll = document.getElementById('checkAll');
        if (checkAll) {
            checkAll.addEventListener('change', function() {
                const isChecked = this.checked;
                document.querySelectorAll('.data-row').forEach(row => {
                    const id = row.getAttribute('data-id');
                    const checkbox = row.querySelector('.row-check');
                    if (checkbox) {
                        checkbox.checked = isChecked;
                        if (isChecked) {
                            if (!selectedIds.includes(id)) {
                                selectedIds.push(id);
                            }
                        } else {
                            selectedIds = selectedIds.filter(i => i !== id);
                        }
                    }
                });
                localStorage.setItem('selectedArsipIds', JSON.stringify(selectedIds));
            });
        }

        // Export Excel: gunakan selectedIds dari localStorage
        document.getElementById('exportExcel')?.addEventListener('click', function() {
            if (selectedIds.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Pilih minimal satu baris untuk diexport',
                    confirmButtonText: 'OK'
                });
                return;
            }

            Swal.fire({
                title: 'Sedang mengekspor...',
                html: 'Harap tunggu, data sedang diproses.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            fetch("{{ route('exportArsipToExcel') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        selected_ids: selectedIds // ← ini sudah mencakup SEMUA halaman!
                    })
                })
                .then(res => res.blob())
                .then(blob => {
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'arsip_lengkap.xlsx';
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                    Swal.close();
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Export data berhasil.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                })
                .catch(err => {
                    console.error(err);
                    Swal.close();
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat export data.',
                        confirmButtonText: 'OK'
                    });
                });
        });


        // function disableSubmit() {
        //     document.querySelector('button[type=submit]').innerHTML = "Processing..."
        //     document.querySelector('button[type=submit]').disabled = true
        //     document.querySelector('button[type=submit]').classList.remove('bg-gray-900')
        //}
    </script>
@endpush

@section('content')

    <style>
        .header-arsip {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .upload-box {
            background: #f4f8fb;
            padding: 10px 15px;
            border-radius: 6px;
        }

        .upload-box input {
            font-size: 14px;
        }

        /* Chrome, Edge, Safari */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Firefox */
        .hide-scrollbar {
            scrollbar-width: none;
        }

        /* Internet Explorer (legacy) */
        .hide-scrollbar {
            -ms-overflow-style: none;
        }
    </style>

    <div>
        @include('alert')
        <div class="w-100">
            <div class="d-flex align-items-center">
                @if ($primaryKeyParam)
                    <a href="/data-arsip" class="text-black fs-1 link-underline link-underline-opacity-0"><i
                            class="bi bi-arrow-left-short"></i></a>
                @endif
                <h2 class="mb-0">Data Arsip</h2>
            </div>
            <p>Master data arsip BUMN</p>
        </div>
        <div class="d-flex justify-content-between align-items-center w-100 mb-3">
            <div class="d-flex align-items-center justify-content-between gap-2 bg-light">
                @if (count($filter) > 0)
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#my_modal_2">
                        Filter
                    </button>
                @endif
                <div class="w-100 d-flex flex-wrap align-items-center gap-1">
                    @if (count($filter) > 0)
                        {{-- <p class="mb-0">Filter :</p> --}}

                        @foreach ($filter as $item)
                            <span class="badge bg-secondary rounded-pill text-white mw-25 sm:mw-100 fw-bold text-truncate">
                                {{ $item }}
                            </span>
                        @endforeach

                        <button onclick="clearFilter()" class="btn btn-link p-0 text-decoration-underline">
                            clear
                        </button>
                    @endif
                </div>
            </div>

            <button class="btn btn-success" id="exportExcel">
                Download Excel
            </button>
            {{-- FORM UPLOAD --}}
            {{-- <div class="upload-box">
            <form action="{{ route('arsip.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex align-items-center gap-2">
                    <div>
                        <label for="file" class="form-label">Pilih file Excel</label>
                        <input class="form-control" type="file" id="file" name="file" accept=".xlsx,.xls" required>
                        <div class="form-text">Hanya file Excel (.xlsx / .xls) yang diperbolehkan</div>
                    </div>
        
                    <button type="submit" class="btn btn-light btn-sm mt-2">Upload Excel</button>
                </div>
            </form>
        </div> --}}
        </div>
    </div>

    {{-- FILTER MODAL --}}
    <div class="modal fade" id="my_modal_2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
{{-- ini mau coba hapus --}}
                <form action="/data-arsip" method="get">
                    <div class="modal-body">
                        <div class="row g-2 mb-3">

                            <div class="col-12">
                                <label class="form-label">Unit</label>
                                <select name="unit" id="unit" class="form-select">
                                    <option value="">Unit</option>
                                    @foreach ($unit_pengolah as $item)
                                        <option value="{{ $item->unit_pengolah }}"
                                            @if ($keywordUnit == $item->unit_pengolah) selected @endif>
                                            {{ $item->unit_pengolah }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Informasi Berkas</label>
                                <select name="informasi_berkas" id="informasi_berkas" class="form-select">
                                    <option value="">Informasi Berkas</option>
                                    @foreach ($informasi_berkas as $item)
                                        <option value="{{ $item->informasi_berkas_indeks }}"
                                            @if ($keywordInformasiBerkas == $item->informasi_berkas_indeks) selected @endif>
                                            {{ $item->informasi_berkas_indeks }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Nama Perusahaan</label>
                                <select name="nama_perusahaan" id="nama_perusahaan" class="form-select">
                                    <option value="">Nama Perusahaan</option>
                                    @foreach ($perusahaan as $item)
                                        <option value="{{ $item->nama_perusahaan }}"
                                            @if ($keywordPerusahaan == $item->nama_perusahaan) selected @endif>
                                            {{ $item->nama_perusahaan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Tahun</label>
                                <select name="tahun" id="tahun" class="form-select">
                                    <option value="">Tahun</option>
                                    @foreach ($tahun as $item)
                                        <option value="{{ $item->tahun_pemberkasan }}"
                                            @if ($keywordTahun == $item->tahun_pemberkasan) selected @endif>
                                            {{ $item->tahun_pemberkasan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Uraian Informasi Berkas</label>
                                <input type="text" name="uraian" class="form-control" placeholder="Uraian"
                                    value="{{ $keywordUraian }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Lokasi Simpan Box</label>
                                <input type="text" name="uraian" class="form-control" placeholder="Lokasi Simpan Box"
                                    value="{{ $simpanBoxParam }}">
                            </div>

                            <div class="col-12">
                                <label class="form-label">Lokasi Simpan Folder</label>
                                <input type="text" name="uraian" class="form-control" placeholder="Lokasi Simpan Folder"
                                    value="{{ $simpanFolderParam }}">
                            </div>

                            @if ($primaryKeyParam)
                                <div class="col-12">
                                    <label class="form-label">Primary Key</label>
                                    <input type="text" name="primary_key" class="form-control bg-light"
                                        placeholder="Uraian" value="{{ $primaryKeyParam }}" readonly>
                                </div>
                            @endif

                            <div class="col-12 text-end">
                                <button type="button" onclick="clearFilter()"
                                    class="btn btn-link p-0 text-decoration-underline">
                                    Clear
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary w-100">Cari</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    {{-- NOTIFIKASI --}}
    {{-- @if (session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            {{ $errors->first() }}
        </div>
    @endif --}}

    {{-- TABEL DATA --}}

    <div class="bg-white shadow-sm rounded-3 p-2">
        <div class="table-responsive rounded border shadow-sm">
            <table class="table table-bordered table-hover align-middle small arsip-table mb-0" id="arsipTable">
                <thead class="text-center table-primary">
                    <tr>
                        <th>ID</th>
                        <th class="">
                            <input type="checkbox" id="checkAll" class="">
                        </th>
                        <th class="text-nowrap">Primary Key Final</th>
                        <th class="text-nowrap">Unit Pengolah</th>
                        <th class="text-nowrap">Lokasi Simpan Lemari</th>
                        <th class="text-nowrap">Lokasi Simpan Baris</th>
                        <th class="text-nowrap">Lokasi Simpan Bok</th>
                        <th class="text-nowrap">Lokasi Simpan Folder</th>
                        <th class="text-nowrap">No Definitif</th>
                        <th class="text-nowrap">Kode Klasifikasi</th>
                        <th class="text-nowrap">Info Berkas Indeks</th>
                        <th class="text-nowrap">Nama Perusahaan</th>
                        <th class="text-nowrap">Uraian Informasi Berkas</th>
                        <th class="text-nowrap">Kurun Awal</th>
                        <th class="text-nowrap">Kurun Akhir</th>
                        <th class="text-nowrap">JW Aktif</th>
                        <th class="text-nowrap">JW Inaktif</th>
                        <th class="text-nowrap">Tingkat Perkembangan</th>
                        <th class="text-nowrap">Media Simpan</th>
                        <th class="text-nowrap">Kondisi Fisik</th>
                        <th class="text-nowrap">Klasifikasi Keamanan</th>
                        <th class="text-nowrap">Hak Akses</th>
                        <th class="text-nowrap">Dasar Pertimbangan</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Tahun</th>
                        <th class="text-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($arsips as $arsip)
                        <tr class="data-row" data-id="{{ $arsip->id }}">
                            <td class="">{{ $arsip->id }}</td>
                            <td class="border-base-200 border-[1px] text-center">
                                <input type="checkbox" class="row-check checkbox checkbox-primary size-4 rounded-sm">
                            </td>
                            <td class=""><a href="?primary_key={{ substr($arsip->primary_key_final, 0, -5) }}">
                                    {{ $arsip->primary_key_final ?? '-' }}</td>
                            </a>
                            <td>{{ $arsip->unit_pengolah ?? '-' }}</td>
                            <td class="">{{ $arsip->lokasi_simpan_lemari ?? '-' }}</td>
                            <td class="">{{ $arsip->lokasi_simpan_baris ?? '-' }}</td>
                            <td class="">{{ $arsip->lokasi_simpan_bok ?? '-' }}</td>
                            <td class="">{{ $arsip->lokasi_simpan_folder ?? '-' }}</td>
                            <td>{{ $arsip->lokasi_simpan_no_definitif ?? '-' }}</td>
                            <td>{{ $arsip->kode_klasifikasi ?? '-' }}</td>
                            <td>{{ $arsip->informasi_berkas_indeks ?? '-' }}</td>
                            <td>{{ $arsip->nama_perusahaan ?? '-' }}</td>
                            <td>{{ $arsip->uraian_informasi_berkas ?? '-' }}</td>
                            <td class="">{{ $arsip->kurun_waktu_awal ?? '-' }}</td>
                            <td class="">{{ $arsip->kurun_waktu_akhir ?? '-' }}</td>
                            <td class="">{{ $arsip->jangka_waktu_penyimpanan_aktif ?? '-' }}</td>
                            <td class="">{{ $arsip->jangka_waktu_penyimpanan_inaktif ?? '-' }}</td>
                            <td>{{ $arsip->tingkat_perkembangan ?? '-' }}</td>
                            <td>{{ $arsip->media_simpan ?? '-' }}</td>
                            <td>{{ $arsip->kondisi_fisik ?? '-' }}</td>
                            <td>{{ $arsip->klasifikasi_keamanan ?? '-' }}</td>
                            <td>{{ $arsip->hak_akses ?? '-' }}</td>
                            <td>{{ $arsip->dasar_pertimbangan ?? '-' }}</td>
                            <td class="">
                                {{ $arsip->status ?? '-' }}
                            </td>
                            <td class="">{{ $arsip->tahun_pemberkasan ?? '-' }}</td>
                            <td class="">
                                <a href="{{ '/data-arsip/' . $arsip->id }}" class="btn btn-primary"><i
                                        class="bi bi-pencil-square"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="25" class="text-center text-muted py-4">
                                Belum ada data arsip
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



    <br>
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div class="text-muted small">
            Menampilkan {{ $arsips->firstItem() }} - {{ $arsips->lastItem() }}
            dari {{ $arsips->total() }} data
        </div>

        <div>
            {{ $arsips->appends(request()->query())->links() }}
        </div>
    </div>


@endsection
