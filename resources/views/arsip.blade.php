@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/arsip.css') }}">
@endpush
@push('scripts')
    <script>
        function disableSubmit() {
            document.querySelector('button[type=submit]').innerHTML = "Processing..."
            document.querySelector('button[type=submit]').disabled = true
            document.querySelector('button[type=submit]').classList.remove('bg-gray-900')
        }
    </script>
@endpush

@section('content')
<div class="arsip-page"> {{-- ⬅️ INI PENTING --}}

    <div class="page-header">
        <h2>Pencarian Arsip</h2>
        <p>Masukkan informasi filter terlebih dahulu untuk melanjutkan</p>
    </div>

    <div class="search-container">

        <form action="/data-arsip" method="get" onsubmit="disableSubmit()">

            <div class="form-row">
                <div class="form-group">
                    <label>
                        INFORMASI BERKAS
                        {{-- <span class="wajib">WAJIB</span> --}}
                    </label>
                    <input type="text"
                           id="informasi_berkas" name="informasi_berkas"
                           placeholder="Pilih jenis Informasi Berkas">
                </div>

                <div class="form-group">
                    <label>
                        URAIAN INFORMASI BERKAS
                        {{-- <span class="wajib">WAJIB</span> --}}
                    </label>
                    <input type="text"
                           id="uraian_informasi" name="uraian"
                           placeholder="Pilih jenis Uraian Berkas">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>LOKASI SIMPAN BOX</label>
                    <input type="text" name="box" placeholder="Pilih jenis Lokasi Box">
                </div>

                <div class="form-group">
                    <label>LOKASI SIMPAN FOLDER</label>
                    <input type="text" name="folder" placeholder="Pilih jenis Lokasi Folder">
                </div>
            </div>

            <div class="form-row center">
                <div class="form-group full">
                    <label>UNIT PENGOLAH</label>
                    <input type="text" name="unit">
                </div>
            </div>

            <button type="submit" id="btnSearch">
                SEARCH
            </button>

        </form>

    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('js/arsip.js') }}"></script>
@endpush
