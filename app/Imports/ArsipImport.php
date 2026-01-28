<?php

namespace App\Imports;

use App\Models\Arsip;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ArsipImport implements ToModel, WithHeadingRow, WithChunkReading
{
    public function model(array $row)
    {
        return new Arsip([
            // NO (biasanya nomor urut excel, tidak disimpan ke DB)
            // 'no' => $row['no'] ?? null,

            // UNIT
            'unit_pengolah'          => $row['unit_pengolah'] ?? null,

            // LOKASI SIMPAN
            'lokasi_simpan_lemari'          => $row['lokasi_simpan_lemari'] ?? null,
            'lokasi_simpan_baris'           => $row['lokasi_simpan_baris'] ?? null,
            'lokasi_simpan_bok'             => $row['lokasi_simpan_bok'] ?? null,
            'lokasi_simpan_folder'          => $row['lokasi_simpan_folder'] ?? null,
            'lokasi_simpan_no_definitif'    => $row['lokasi_simpan_no_defenitif'] ?? null,

            // NF & NU (kalau belum ada di DB, aman pakai null dulu)
            'nf'                     => $row['nf'] ?? null,
            'nu'                     => $row['nu'] ?? null,

            // NOMOR ARSIP
            'no_arsip'               => $row['no_arsip'] ?? null,
            'no_lama'                => $row['no_lama'] ?? null,

            // KODE
            'kode_klasifikasi'       => $row['kode_klasifikasi'] ?? null,
            'kode_pelaksana'         => $row['kode_pelaksana'] ?? null,

            // INFORMASI BERKAS
            'informasi_berkas_indeks'       => $row['informasi_berkas_indeks'] ?? null,
            'nama_perusahaan'               => $row['nama_perusahaan'] ?? null,
            'uraian_informasi_berkas'       => $row['uraian_informasi_berkas'] ?? null,

            // KURUN WAKTU
            'kurun_waktu_awal'       => $row['kurun_waktu_awal'] ?? null,
            'kurun_waktu_akhir'      => $row['kurun_waktu_akhir'] ?? null,

            // RETENSI
            'jangka_waktu_penyimpanan_aktif'          => $row['jangka_waktu_penyimpanan_aktif'] ?? null,
            'jangka_waktu_penyimpanan_inaktif'        => $row['jangka_waktu_penyimpanan_inaktif'] ?? null,

            // KONDISI
            'tingkat_perkembangan'   => $row['tingkat_perkembangan'] ?? null,
            'media_simpan'           => $row['media_simpan'] ?? null,
            'kondisi_fisik'          => $row['kondisi_fisik'] ?? null,

            // JUMLAH
            'jumlah_berkas'          => $row['jumlah_berkas'] ?? null,

            // KETERANGAN
            'keterangan'             => $row['keterangan'] ?? null,
            'keterangan_2'            => $row['keterangan_2'] ?? null,
            'karung_duplikasi'       => $row['karung_duplikasi'] ?? null,

            // KEAMANAN
            'klasifikasi_keamanan'   => $row['klasifikasi_keamanan'] ?? null,
            'hak_akses'              => $row['hak_akses'] ?? null,
            'dasar_pertimbangan'     => $row['dasar_pertimbangan'] ?? null,
            'pengguna'               => $row['pengguna'] ?? null,

            // UNIT & STATUS
            'unit_penanggung_jawab'  => $row['unit_penanggung_jawab'] ?? null,
            'jenis_arsip'            => $row['jenis_arsip'] ?? null,
            'metode_perlindungan'    => $row['metode_perlindungan'] ?? null,
            'arsip_terjaga'          => $row['arsip_terjaga'] ?? null,
            'status_arsip'           => $row['status_arsip'] ?? null,

            // TAHUN
            'tahun_pemberkasan'      => $row['tahun_pemberkasan'] ?? null,

            // penambahan parameter primary key
            'unit_code'            => $row['unit_code'] ?? null,
            'thn'                  => $row['thn'] ?? null,
            'temp_unique_box'      => $row['temp_unique_box'] ?? null,
            'global_bok_int'       => $row['global_bok_int'] ?? null,
            'id_bok'               => $row['id_bok'] ?? null,
            'no_item_urut'         => $row['no_item_urut'] ?? null,
            'no_item_str'          => $row['no_item_str'] ?? null,
            'primary_key_final'    => $row['primary_key_final'] ?? null,


        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}