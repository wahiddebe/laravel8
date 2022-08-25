<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class BeritaController extends Controller
{

    //
    public function __construct()
    {
        $setting = Setting::first();
        view()->share('setting', $setting);
    }
    public function index()
    {
        $data = Berita::with('kategori')->where('status', 1)->latest()->get();
        $year = Berita::selectRaw('year(created_at) as year')->where('status', 1)->groupBy('year')->get();
        $tahun = '';
        return view('berita', ['title' => 'Berita', 'data' => $data, 'year' => $year, 'tahun' => $tahun]);
    }

    public function tahun($tahun)
    {

        $data = Berita::with('kategori')->where('status', 1)->whereYear('created_at', $tahun)->latest()->get();
        $year = Berita::selectRaw('year(created_at) as year')->where('status', 1)->groupBy('year')->get();

        return view('berita', ['title' => 'Berita', 'data' => $data, 'year' => $year, 'tahun' => $tahun]);
    }

    public function show($id, $slug)
    {

        $id = Crypt::decryptString($id);
        $data = Berita::find($id);
        $data2 = Berita::with('kategori')->where('id', '!=', $id)->latest()->get();
        return view('berita-detail', ['title' => 'Berita', 'data' => $data, 'data2' => $data2]);
    }
}
