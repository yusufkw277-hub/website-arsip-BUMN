@extends('layouts.app')
@section('content')
    @include('alert')
    {{-- NOTIFIKASI --}}
    {{-- @if (session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any() || session('error'))
        <div style="color: red; margin-bottom: 15px;">
            {{ $errors->first() . session('error') }}
        </div>
    @endif --}}
    <div class="w-100 d-flex align-items-center p-3 z-99">
        <a href="/data-arsip" class="link-underline link-underline-opacity-0 text-black fs-1"><i
                class="bi bi-arrow-left-short"></i></a>
        <h2 class="mb-0">Edit Data Arsip</h2>
    </div>


    <div class="bg-white rounded-4 m-4 text-base-content p-4">
        <form action="{{ route('arsip.update', $data->id) }}" method="post">
            @csrf

            <div class="row g-3">

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Unit Pengolah</legend>
                    <input type="text" name="unit_pengolah" class="form-control" value="{{ $data->unit_pengolah }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Lokasi Simpan Baris</legend>
                    <input type="text" name="lokasi_simpan_baris" class="form-control"
                        value="{{ $data->lokasi_simpan_baris }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Lokasi Simpan Lemari</legend>
                    <input type="text" name="lokasi_simpan_lemari" class="form-control"
                        value="{{ $data->lokasi_simpan_lemari }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Lokasi Simpan Bok</legend>
                    <input type="text" name="lokasi_simpan_bok" class="form-control"
                        value="{{ $data->lokasi_simpan_bok }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Lokasi Simpan Folder</legend>
                    <input type="text" name="lokasi_simpan_folder" class="form-control"
                        value="{{ $data->lokasi_simpan_folder }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Lokasi Simpan No Defenitif</legend>
                    <input type="text" name="lokasi_simpan_no_definitif" class="form-control"
                        value="{{ $data->lokasi_simpan_no_definitif }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">NF</legend>
                    <input type="text" name="nf" class="form-control" value="{{ $data->nf }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">NU</legend>
                    <input type="text" name="nu" class="form-control" value="{{ $data->nu }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">No Arsip</legend>
                    <input type="text" name="no_arsip" class="form-control" value="{{ $data->no_arsip }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">No Lama</legend>
                    <input type="text" name="no_lama" class="form-control" value="{{ $data->no_lama }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Kode Klasifikasi</legend>
                    <input type="text" name="kode_klasifikasi" class="form-control"
                        value="{{ $data->kode_klasifikasi }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Kode Pelaksana</legend>
                    <input type="text" name="kode_pelaksana" class="form-control" value="{{ $data->kode_pelaksana }}">
                </fieldset>

                <fieldset class="col-12 col-sm-6">
                    <legend class="fs-6">Informasi Berkas Indeks</legend>
                    <input type="text" name="informasi_berkas_indeks" class="form-control"
                        value="{{ $data->informasi_berkas_indeks }}">
                </fieldset>

                <fieldset class="col-12 col-sm-6">
                    <legend class="fs-6">Nama Perusahaan</legend>
                    <input type="text" name="nama_perusahaan" class="form-control" value="{{ $data->nama_perusahaan }}">
                </fieldset>

                <fieldset class="col-12 col-sm-6">
                    <legend class="fs-6">Uraian Informasi Berkas</legend>
                    <textarea name="uraian_informasi_berkas" class="form-control" rows="5">{{ $data->uraian_informasi_berkas }}</textarea>
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Kurun Waktu Awal</legend>
                    <input type="text" name="kurun_waktu_awal" class="form-control"
                        value="{{ $data->kurun_waktu_awal }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Kurun Waktu Akhir</legend>
                    <input type="text" name="kurun_waktu_akhir" class="form-control"
                        value="{{ $data->kurun_waktu_akhir }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Jangka Waktu Penyimpanan Aktif</legend>
                    <input type="text" name="jangka_waktu_penyimpanan_aktif" class="form-control"
                        value="{{ $data->jangka_waktu_penyimpanan_aktif }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Jangka Waktu Penyimpanan Inaktif</legend>
                    <input type="text" name="jangka_waktu_penyimpanan_inaktif" class="form-control"
                        value="{{ $data->jangka_waktu_penyimpanan_inaktif }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Tingkat Perkembangan</legend>
                    <input type="text" name="tingkat_perkembangan" class="form-control"
                        value="{{ $data->tingkat_perkembangan }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Media Simpan</legend>
                    <input type="text" name="media_simpan" class="form-control" value="{{ $data->media_simpan }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Kondisi Fisik</legend>
                    <input type="text" name="kondisi_fisik" class="form-control" value="{{ $data->kondisi_fisik }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Jumlah Berkas</legend>
                    <input type="text" name="jumlah_berkas" class="form-control" value="{{ $data->jumlah_berkas }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Keterangan</legend>
                    <input type="text" name="keterangan" class="form-control" value="{{ $data->keterangan }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Keterangan 2</legend>
                    <input type="text" name="keterangan_2" class="form-control" value="{{ $data->keterangan_2 }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Karung Duplikasi</legend>
                    <input type="text" name="karung_duplikasi" class="form-control"
                        value="{{ $data->karung_duplikasi }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Klasifikasi Keamanan</legend>
                    <input type="text" name="klasifikasi_keamanan" class="form-control"
                        value="{{ $data->klasifikasi_keamanan }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Hak Akses</legend>
                    <input type="text" name="hak_akses" class="form-control" value="{{ $data->hak_akses }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Dasar Pertimbangan</legend>
                    <input type="text" name="dasar_pertimbangan" class="form-control"
                        value="{{ $data->dasar_pertimbangan }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Pengguna</legend>
                    <input type="text" name="pengguna" class="form-control" value="{{ $data->pengguna }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Unit Penanggung Jawab</legend>
                    <input type="text" name="unit_penanggung_jawab" class="form-control"
                        value="{{ $data->unit_penanggung_jawab }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Jenis Arsip</legend>
                    <input type="text" name="jenis_arsip" class="form-control" value="{{ $data->jenis_arsip }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Metode Perlindungan</legend>
                    <input type="text" name="metode_perlindungan" class="form-control"
                        value="{{ $data->metode_perlindungan }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Arsip Terjaga</legend>
                    <input type="text" name="arsip_terjaga" class="form-control" value="{{ $data->arsip_terjaga }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Status Arsip</legend>
                    <input type="text" name="status_arsip" class="form-control" value="{{ $data->status_arsip }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Tahun Pemberkasan</legend>
                    <input type="text" name="tahun_pemberkasan" class="form-control"
                        value="{{ $data->tahun_pemberkasan }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Unit Code</legend>
                    <input type="text" name="unit_code" class="form-control" value="{{ $data->unit_code }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Tahun</legend>
                    <input type="text" name="thn" class="form-control" value="{{ $data->thn }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Temp Unique Box</legend>
                    <input type="text" name="temp_unique_box" class="form-control"
                        value="{{ $data->temp_unique_box }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Global Box Int</legend>
                    <input type="text" name="global_bok_int" class="form-control"
                        value="{{ $data->global_bok_int }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">ID Box</legend>
                    <input type="text" name="id_bok" class="form-control" value="{{ $data->id_bok }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">No Item Urut</legend>
                    <input type="text" name="no_item_urut" class="form-control" value="{{ $data->no_item_urut }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">No Item STR</legend>
                    <input type="text" name="no_item_str" class="form-control" value="{{ $data->no_item_str }}">
                </fieldset>

                <fieldset class="col-12 col-sm-3">
                    <legend class="fs-6">Primary Key Final</legend>
                    <input type="text" name="primary_key_final" class="form-control"
                        value="{{ $data->primary_key_final }}" disabled>
                </fieldset>

            </div>

            <button type="submit" class="btn btn-primary w-100 mt-4">
                Submit
            </button>
        </form>
    </div>
@endsection
