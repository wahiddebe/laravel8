<?php

namespace App\Http\Controllers;

use App\Models\Hasil_Kategori;
use App\Models\Hasil_Kuisioner;
use App\Models\Hasil_Kuisioner_Pilihan;
use App\Models\KategoriKuis;
use App\Models\Kuisioner;
use App\Models\Setting;
use App\Models\SubKategoriKuis;
use Illuminate\Http\Request;

class KuisionerController extends Controller
{
    //
    public function __construct()
    {
        $setting = Setting::first();
        view()->share('setting', $setting);
    }
    public function index()
    {
        $data = KategoriKuis::all();
        return view('kuisioner', ['title' => 'Kuisioner', 'data' => $data]);
    }
    public function create(Request $request)
    {
        $data = $request->all();
        $kategori = KategoriKuis::find($data['kategori']);
        $kuisioner = Kuisioner::where('kategori_id', $data['kategori'])->orderBy('sub_kategori_id', 'asc')->with('kategori', 'subkategori', 'pilihans')->get();
        return view('kuisioner-create', ['title' => 'Kuisioner', 'kuisioner' => $kuisioner, 'kategori' => $kategori, 'data' => $data]);
    }

    public function store(Request $request)
    {

        $subkategori = SubKategoriKuis::where('kategori_id', $request->kategori)->get();
        $pilihan = array();
        $totalpersub = [];
        $total = 0;
        foreach ($subkategori as $item) {
            # code...
            $tot = 0;
            $kuis = Kuisioner::where('sub_kategori_id', $item->id)->get();
            foreach ($kuis as $item2) {
                $name = 'pilihan' . $item->id . '' . $item2->id;
                if (is_numeric($request->$name) == true) {
                    $tot += $request->$name;
                }
                $totalpersub[$item->id]['total'] = $tot;
            }
            $total += $tot;
        }
        $kategori = KategoriKuis::find($request->kategori);
        $hasil = Hasil_Kategori::where('kategori_id', $request->kategori)->get();
        $hasilprint = '';
        $hasil_kategori_id = 0;
        foreach ($hasil as $item2) {
            if ($total >= $item2->min_jawaban && $total <= $item2->max_jawaban) {
                $hasilprint = $item2->jawaban;
                $hasil_kategori_id = $item2->id;
            }
        }
        $data = new Hasil_Kuisioner();
        $data->kategori_id = $request->kategori;
        $data->nama = $request->nama;
        $data->tgllahir = $request->tgllahir;
        $data->usia = $request->usia;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->hasil_kategori_id = $hasil_kategori_id;
        $data->hasil = $total;


        if ($data->save()) {
            # code...
            foreach ($subkategori as $item) {
                # code...
                $kuis = Kuisioner::where('sub_kategori_id', $item->id)->get();
                foreach ($kuis as $item2) {
                    $data2
                        = new Hasil_Kuisioner_Pilihan();

                    $name = 'pilihan' . $item->id . '' . $item2->id;
                    if ($request->file($name)) {
                        // Storage::delete($data->gambar);
                        $data2->nilai = $request->file($name)->store('kuisioner');
                    } else {
                        $data2->nilai = $request->$name;
                    }
                    $data2->pertanyaan = $item2->pertanyaan;
                    $data2->hasil_kuisioner_id = $data->id;
                    $data2->save();
                }
            }
            $hasilpil = Hasil_Kuisioner_Pilihan::where('hasil_kuisioner_id', $data->id)->get();
            return view('kuisioner-result', ['subkategori' => $subkategori, 'title' => 'Kuisioner', 'pilihan' => $pilihan, 'totalpersub' => $totalpersub, 'total' => $total, 'kategori' => $kategori, 'hasil' => $hasilprint, 'hasilpil' => $hasilpil]);
        }
    }
}
