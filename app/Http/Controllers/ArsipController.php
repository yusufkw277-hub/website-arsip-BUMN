<?php

namespace App\Http\Controllers;

use App\Exports\ArsipFullExport;
use Illuminate\Http\Request;
use App\Models\Arsip;
use App\Imports\ArsipImport;
use Maatwebsite\Excel\Facades\Excel;

class ArsipController extends Controller
{
    public function index(Request $request)
    {
        $filter = [];
        $keywordPerusahaan = $request->get('nama_perusahaan');
        $keywordInformasiBerkas = $request->get('informasi_berkas');
        $keywordTahun = $request->get('tahun');
        $keywordUnit = $request->get('unit');
        $keywordUraian = $request->get('uraian');
        $simpanBoxParam = $request->get('box');
        $simpanFolderParam = $request->get('folder');
        $primaryKeyParam = $request->get('primary_key');
        if ($keywordPerusahaan != null || 
            $keywordTahun != null || 
            $keywordUnit != null || 
            $keywordInformasiBerkas != null || 
            $keywordUraian != null ||
            $simpanBoxParam != null ||
            $simpanFolderParam != null ||
            $primaryKeyParam != null) {
            $arsips = Arsip::query()
                ->when($keywordPerusahaan, function ($q) use ($keywordPerusahaan) {
                    $q->where('nama_perusahaan', $keywordPerusahaan);
                })
                ->when($keywordUnit, function ($q) use ($keywordUnit) {
                    $q->where('unit_pengolah', 'like', "%{$keywordUnit}%");
                })
                ->when($keywordTahun, function ($q) use ($keywordTahun) {
                    $q->where('tahun_pemberkasan', 'like', "%{$keywordTahun}%");
                })
                ->when($keywordInformasiBerkas, function ($q) use ($keywordInformasiBerkas) {
                    $q->where('informasi_berkas_indeks', 'like', "%{$keywordInformasiBerkas}%");
                })
                ->when($keywordUraian, function ($q) use ($keywordUraian) {
                    $q->where('uraian_informasi_berkas', 'like', "%{$keywordUraian}%");
                })
                ->when($simpanBoxParam, function ($q) use ($simpanBoxParam) {
                    $q->where('lokasi_simpan_bok', "{$simpanBoxParam}");
                })
                ->when($simpanFolderParam, function ($q) use ($simpanFolderParam) {
                    $q->where('lokasi_simpan_folder', "{$simpanFolderParam}");
                })
                ->when($primaryKeyParam, function ($q) use ($primaryKeyParam) {
                    $q->where('primary_key_final', 'like', "%{$primaryKeyParam}%");
                })
                ->paginate(10);

                if (!empty($keywordUnit)) {
                    $filter[] = "Unit Pengolah : {$keywordUnit}";
                }

                if (!empty($keywordInformasiBerkas)) {
                    $filter[] = "Informasi Berkas : {$keywordInformasiBerkas}";
                }

                if (!empty($keywordPerusahaan)) {
                    $filter[] = "Nama Perusahaan : {$keywordPerusahaan}";
                }

                if (!empty($keywordTahun)) {
                    $filter[] = "Tahun : {$keywordTahun}";
                }

                if (!empty($keywordUraian)) {
                    $filter[] = "Uraian Informasi Berkas : {$keywordUraian}";
                }

                if (!empty($simpanBoxParam)) {
                    $filter[] = "Lokasi Simpan Box : {$simpanBoxParam}";
                }

                if (!empty($simpanFolderParam)) {
                    $filter[] = "Lokasi Simpan Folder : {$simpanFolderParam}";
                }

                if (!empty($primaryKeyParam)) {
                    $filter[] = "Primary Key : {$primaryKeyParam}";
                }
        } else {
            $arsips = Arsip::orderBy('id', 'asc')->paginate(10);
        }
        $data = [
            'perusahaan' => Arsip::select('nama_perusahaan')->distinct()->get(),
            'tahun' => Arsip::select('tahun_pemberkasan')->distinct()->get(),
            'unit_pengolah' => Arsip::select('unit_pengolah')->distinct()->orderBy('unit_pengolah', 'asc')->get(),
            'informasi_berkas' => Arsip::select('informasi_berkas_indeks')->distinct()->get(),
        ];
        return view('arsip.data',$data, compact('arsips', 'keywordPerusahaan', 'keywordTahun', 'keywordUnit', 'keywordInformasiBerkas', 'keywordUraian','filter', 'primaryKeyParam', 'simpanBoxParam', 'simpanFolderParam'));
    }

    public function edit($id) {
        $data = Arsip::where('id', $id)->first();
        return view('arsip.edit', compact('data'));
    }

    public function update(Request $request, $id) {
        try {

            // $obj = Arsip::find($id);
            $obj = Arsip::findOrFail($id);
            $obj->nama_perusahaan = $request->nama_perusahaan;
            $obj->uraian_informasi_berkas = $request->uraian_informasi_berkas;
            $obj->unit_pengolah = $request->unit_pengolah;

            $obj->lokasi_simpan_baris = $request->lokasi_simpan_baris;
            $obj->lokasi_simpan_lemari = $request->lokasi_simpan_lemari;
            $obj->lokasi_simpan_bok = $request->lokasi_simpan_bok;
            $obj->lokasi_simpan_folder = $request->lokasi_simpan_folder;
            $obj->lokasi_simpan_no_definitif = $request->lokasi_simpan_no_definitif;

            $obj->nf = $request->nf;
            $obj->nu = $request->nu;
            $obj->no_arsip = $request->no_arsip;
            $obj->no_lama = $request->no_lama;
            $obj->kode_klasifikasi = $request->kode_klasifikasi;
            $obj->kode_pelaksana = $request->kode_pelaksana;
            $obj->informasi_berkas_indeks = $request->informasi_berkas_indeks;

            $obj->kurun_waktu_awal = $request->kurun_waktu_awal;
            $obj->kurun_waktu_akhir = $request->kurun_waktu_akhir;
            $obj->jangka_waktu_penyimpanan_aktif = $request->jangka_waktu_penyimpanan_aktif;
            $obj->jangka_waktu_penyimpanan_inaktif = $request->jangka_waktu_penyimpanan_inaktif;
            $obj->tingkat_perkembangan = $request->tingkat_perkembangan;
            $obj->media_simpan = $request->media_simpan;
            $obj->kondisi_fisik = $request->kondisi_fisik;
            $obj->jumlah_berkas = $request->jumlah_berkas;

            $obj->keterangan = $request->keterangan;
            $obj->keterangan_2 = $request->keterangan_2;
            $obj->karung_duplikasi = $request->karung_duplikasi;
            $obj->klasifikasi_keamanan = $request->klasifikasi_keamanan;
            $obj->hak_akses = $request->hak_akses;
            $obj->dasar_pertimbangan = $request->dasar_pertimbangan;
            $obj->pengguna = $request->pengguna;
            $obj->unit_penanggung_jawab = $request->unit_penanggung_jawab;

            $obj->jenis_arsip = $request->jenis_arsip;
            $obj->metode_perlindungan = $request->metode_perlindungan;
            $obj->arsip_terjaga = $request->arsip_terjaga;
            $obj->status_arsip = $request->status_arsip;
            $obj->tahun_pemberkasan = $request->tahun_pemberkasan;
            $obj->unit_code = $request->unit_code;
            $obj->thn = $request->thn;

            $obj->temp_unique_box = $request->temp_unique_box;
            $obj->global_bok_int = $request->global_bok_int;
            $obj->id_bok = $request->id_bok;
            $obj->no_item_urut = $request->no_item_urut;
            $obj->no_item_str = $request->no_item_str;
            // $obj->primary_key_final = $request->primary_key_final;

    
            // $obj->update();
            $obj->save();

            $primaryKey = $obj->primary_key_final;
    
            return redirect()->route('arsip.data')->with('success', 'Berhasil edit arsip : ' . $primaryKey);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', "Gagal Edit Arsip " . $e);
        }
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new ArsipImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data arsip berhasil diimport');
    }
    public function exportArsipToExcel(Request $request)
    {
        try {
            // Validasi request
            $request->validate([
                'selected_ids' => 'required|array',
                'selected_ids.*' => 'integer'
            ]);

            // Ambil semua 10 kolom dari database berdasarkan ID
            $selectedArsips = Arsip::whereIn('id', $request->selected_ids)
                                  ->get(); // Ambil semua kolom
            
            // Kirim ke Excel Export Class
            return Excel::download(new ArsipFullExport($selectedArsips), 'arsip_lengkap.xlsx');
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Export failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
