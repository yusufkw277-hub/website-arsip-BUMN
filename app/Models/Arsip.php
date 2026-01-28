<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    protected $table = 'arsips';

    protected $fillable = [
        // UNIT
        'unit_pengolah',
        'unit_penanggung_jawab',

        // LOKASI SIMPAN
        'lokasi_lemari',
        'lokasi_baris',
        'lokasi_bok',
        'lokasi_folder',
        'lokasi_no_definitif',

        // NF & NU
        'nf',
        'nu',

        // NOMOR ARSIP
        'no_arsip',
        'no_lama',

        // KODE
        'kode_klasifikasi',
        'kode_pelaksana',

        // INFORMASI
        'informasi_berkas',
        'nama_perusahaan',
        'uraian_informasi',

        // KURUN WAKTU
        'kurun_waktu_awal',
        'kurun_waktu_akhir',

        // RETENSI
        'retensi_aktif',
        'retensi_inaktif',

        // KONDISI
        'tingkat_perkembangan',
        'media_simpan',
        'kondisi_fisik',

        // JUMLAH
        'jumlah_berkas',

        // KETERANGAN
        'keterangan',
        'keterangan2',
        'karung_duplikasi',

        // KEAMANAN & AKSES
        'klasifikasi_keamanan',
        'hak_akses',
        'dasar_pertimbangan',
        'pengguna',

        // STATUS ARSIP
        'jenis_arsip',
        'metode_perlindungan',
        'arsip_terjaga',
        'status_arsip',

        // TAHUN
        'tahun_pemberkasan',
    ];
}
