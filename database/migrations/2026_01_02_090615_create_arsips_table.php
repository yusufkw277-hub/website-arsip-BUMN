<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('arsips', function (Blueprint $table) {
            $table->bigIncrements('id');

            // UNIT
            $table->string('unit_pengolah')->nullable();
    
            // LOKASI SIMPAN
            $table->string('lokasi_simpan_lemari')->nullable();
            $table->string('lokasi_simpan_baris')->nullable();
            $table->string('lokasi_simpan_bok')->nullable();
            $table->string('lokasi_simpan_folder')->nullable();
            $table->string('lokasi_simpan_no_definitif')->nullable();
    
            // NF & NU
            $table->string('nf')->nullable();
            $table->string('nu')->nullable();
    
            // NOMOR ARSIP
            $table->string('no_arsip')->nullable();
            $table->string('no_lama')->nullable();
    
            // KODE
            $table->string('kode_klasifikasi')->nullable();
            $table->string('kode_pelaksana')->nullable();
    
            // INFORMASI
            $table->string('informasi_berkas_indeks')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->text('uraian_informasi_berkas')->nullable();
    
            // KURUN WAKTU
            $table->string('kurun_waktu_awal')->nullable();
            $table->string('kurun_waktu_akhir')->nullable();
    
            // RETENSI
            $table->string('jangka_waktu_penyimpanan_aktif')->nullable();
            $table->string('jangka_waktu_penyimpanan_inaktif')->nullable();
    
            // KONDISI
            $table->string('tingkat_perkembangan')->nullable();
            $table->string('media_simpan')->nullable();
            $table->string('kondisi_fisik')->nullable();
    
            // JUMLAH
            $table->string('jumlah_berkas')->default(1);
    
            // KETERANGAN
            $table->string('keterangan')->nullable();
            $table->string('keterangan_2')->nullable();
            $table->string('karung_duplikasi')->nullable();
    
            // KEAMANAN
            $table->string('klasifikasi_keamanan')->nullable();
            $table->string('hak_akses')->nullable();
            $table->string('dasar_pertimbangan')->nullable();
            $table->string('pengguna')->nullable();
            $table->string('unit_penanggung_jawab')->nullable();

            // STATUS
            $table->string('jenis_arsip')->nullable();
            $table->string('metode_perlindungan')->nullable();
            $table->string('arsip_terjaga')->nullable();
            $table->string('status_arsip')->nullable();
    
            // TAHUN
            $table->integer('tahun_pemberkasan')->nullable();
            $table->string('unit_code')->nullable();
            $table->integer('thn')->nullable();
            $table->string('temp_unique_box')->nullable();
            $table->integer('global_bok_int')->nullable();
            $table->integer('id_bok')->nullable();
            $table->integer('no_item_urut')->nullable();
            $table->integer('no_item_str')->nullable();
            $table->string('primary_key_final')->unique();
    
            $table->timestamps();
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsips');
    }
};