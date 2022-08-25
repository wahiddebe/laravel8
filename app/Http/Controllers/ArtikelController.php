<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ArtikelController extends Controller
{
    //


    public function __construct()
    {
        $setting = Setting::first();
        view()->share('setting', $setting);
    }
    public function index()
    {
        $data = Artikel::with('kategori')->where('status', '!=', 0)->latest()->get();
        $year = Artikel::selectRaw('year(created_at) as year')->where('status', '!=', 0)->groupBy('year')->get();
        $tahun = '';
        return view('artikel', ['title' => 'Artikel', 'data' => $data, 'year' => $year, 'tahun' => $tahun]);
    }

    public function tahun($tahun)
    {

        $data = Artikel::with('kategori')->where('status', '!=', 0)->whereYear('created_at', $tahun)->latest()->get();
        $year = Artikel::selectRaw('year(created_at) as year')->where('status', '!=', 0)->groupBy('year')->get();

        return view('artikel', ['title' => 'Artikel', 'data' => $data, 'year' => $year, 'tahun' => $tahun]);
    }

    public function show($id, $slug)
    {

        $id = Crypt::decryptString($id);
        $data = Artikel::find($id);
        $data2 = Artikel::with('kategori')->where('id', '!=', $id)->latest()->get();
        return view('artikel-detail', ['title' => 'Artikel', 'data' => $data, 'data2' => $data2]);
    }
}
