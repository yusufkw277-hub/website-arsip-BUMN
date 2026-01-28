<?php

namespace App\Exports;

use App\Models\Arsip;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ArsipFullExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $arsips;

    public function __construct($arsips)
    {
        $this->arsips = $arsips;
    }

    public function collection()
    {
        return $this->arsips;
    }

    // HEADER 45 KOLOM
    public function headings(): array
    {
        return [
            'ID',
            'Unit Pengolah',
            'Lokasi Simpan Lemari',
            'Lokasi Simpan Baris',
            'Lokasi Simpan Bok',
            'Lokasi Simpan Folder',
            'Lokasi Simpan No Defenitif',
            'NF',
            'NU',
            'No Arsip',
            'No Lama',
            'Kode Klasifikasi',
            'Kode Pelaksana',
            'Informasi Berkas/Indeks',
            'Nama Perusahaan',
            'Uraian Informasi Berkas',
            'Kurun Waktu Awal',
            'Kurun Waktu Akhir',
            'Jangka Waktu Penyimpanan Aktif',
            'Jangka Waktu Penyimpanan Inaktif',
            'Tingkat Perkembangan',
            'Media Simpan',
            'Kondisi Fisik',
            'Jumlah Berkas',
            'Keterangan',
            'Keterangan 2',
            'Karung Duplikasi',
            'Klasifikasi Keamanan',
            'Hak Akses',
            'Dasar Pertimbangan',
            'Pengguna',
            'Unit Penanggung Jawab',
            'Jenis Arsip',
            'Metode Perlindungan',
            'Arsip Terjaga',
            'Status Arsip',
            'Tahun Pemberkasan',
            'Unit Code',
            'Tahun',
            'Temp Unique Box',
            'Global Bok Int',
            'ID Bok',
            'No Item Urut',
            'No Item Str',
            'Primary Key Final'
        ];
    }

    // MAPPING 45 KOLOM
    public function map($arsip): array
    {
        return [
            $arsip->id,
            $arsip->unit_pengolah,
            $arsip->lokasi_simpan_lemari,
            $arsip->lokasi_simpan_baris,
            $arsip->lokasi_simpan_bok,
            $arsip->lokasi_simpan_folder,
            $arsip->lokasi_simpan_no_defenitif,
            $arsip->nf,
            $arsip->nu,
            $arsip->no_arsip,
            $arsip->no_lama,
            $arsip->kode_klasifikasi,
            $arsip->kode_pelaksana,
            $arsip->informasi_berkas_indeks,
            $arsip->nama_perusahaan,
            $arsip->uraian_informasi_berkas,
            $arsip->kurun_waktu_awal,
            $arsip->kurun_waktu_akhir,
            $arsip->jangka_waktu_penyimpanan_aktif,
            $arsip->jangka_waktu_penyimpanan_inaktif,
            $arsip->tingkat_perkembangan,
            $arsip->media_simpan,
            $arsip->kondisi_fisik,
            $arsip->jumlah_berkas,
            $arsip->keterangan,
            $arsip->keterangan_2,
            $arsip->karung_duplikasi,
            $arsip->klasifikasi_keamanan,
            $arsip->hak_akses,
            $arsip->dasar_pertimbangan,
            $arsip->pengguna,
            $arsip->unit_penanggung_jawab,
            $arsip->jenis_arsip,
            $arsip->metode_perlindungan,
            $arsip->arsip_terjaga,
            $arsip->status_arsip,
            $arsip->tahun_pemberkasan,
            $arsip->unit_code,
            $arsip->thn,
            $arsip->temp_unique_box,
            $arsip->global_bok_int,
            $arsip->id_bok,
            $arsip->no_item_urut,
            $arsip->no_item_str,
            $arsip->primary_key_final
        ];
    }

    // STYLING HEADER - Background Biru Muda & Huruf Tebal
    public function styles(Worksheet $sheet)
    {
        // Styling untuk header (baris pertama)
        $sheet->getStyle('A1:AS1')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFE2EFFF', // Biru muda
                ],
            ],
            'font' => [
                'bold' => true, // Huruf tebal
                'size' => 11,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true, // Wrap teks panjang
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ]);

        // Styling untuk semua data
        $lastRow = $this->arsips->count() + 1;
        $sheet->getStyle('A2:AS' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FFCCCCCC'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Auto filter
        $sheet->setAutoFilter('A1:AS' . $lastRow);

        // Freeze pane (header tetap saat scroll)
        $sheet->freezePane('A2');

        return [
            // Styling khusus untuk kolom tertentu jika perlu
            1 => ['font' => ['bold' => true]],
        ];
    }

    // SET LEBAR KOLOM OTOMATIS (Auto Fit)
    public function columnWidths(): array
    {
        return [
            'A' => 8,  // ID
            'B' => 15, // Unit Pengolah
            'C' => 20, // Lokasi Simpan Lemari
            'D' => 18, // Lokasi Simpan Baris
            'E' => 18, // Lokasi Simpan Bok
            'F' => 20, // Lokasi Simpan Folder
            'G' => 25, // Lokasi Simpan No Defenitif
            'H' => 10, // NF
            'I' => 10, // NU
            'J' => 15, // No Arsip
            'K' => 15, // No Lama
            'L' => 18, // Kode Klasifikasi
            'M' => 15, // Kode Pelaksana
            'N' => 25, // Informasi Berkas/Indeks
            'O' => 20, // Nama Perusahaan
            'P' => 25, // Uraian Informasi Berkas
            'Q' => 18, // Kurun Waktu Awal
            'R' => 18, // Kurun Waktu Akhir
            'S' => 25, // Jangka Waktu Penyimpanan Aktif
            'T' => 28, // Jangka Waktu Penyimpanan Inaktif
            'U' => 20, // Tingkat Perkembangan
            'V' => 15, // Media Simpan
            'W' => 15, // Kondisi Fisik
            'X' => 15, // Jumlah Berkas
            'Y' => 20, // Keterangan
            'Z' => 20, // Keterangan 2
            'AA' => 18, // Karung Duplikasi
            'AB' => 20, // Klasifikasi Keamanan
            'AC' => 15, // Hak Akses
            'AD' => 20, // Dasar Pertimbangan
            'AE' => 15, // Pengguna
            'AF' => 22, // Unit Penanggung Jawab
            'AG' => 15, // Jenis Arsip
            'AH' => 20, // Metode Perlindungan
            'AI' => 15, // Arsip Terjaga
            'AJ' => 15, // Status Arsip
            'AK' => 18, // Tahun Pemberkasan
            'AL' => 12, // Unit Code
            'AM' => 10, // Tahun
            'AN' => 18, // Temp Unique Box
            'AO' => 15, // Global Bok Int
            'AP' => 12, // ID Bok
            'AQ' => 15, // No Item Urut
            'AR' => 15, // No Item Str
            'AS' => 20, // Primary Key Final
        ];
    }

    // OPTIONAL: Untuk auto fit width berdasarkan konten (tapi bisa lambat untuk data banyak)
    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class => function(AfterSheet $event) {
    //             $worksheet = $event->sheet->getDelegate();
                
    //             // Auto fit semua kolom berdasarkan konten
    //             foreach(range('A', 'AS') as $column) {
    //                 $worksheet->getColumnDimension($column)->setAutoSize(true);
    //             }
    //         },
    //     ];
    // }
}