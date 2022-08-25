<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Berita;
use App\Models\Home_hero;
use App\Models\Home_lingkup;
use App\Models\Home_nilai;
use App\Models\Kategori;
use App\Models\Setting;
use App\Models\Shop;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $setting = Setting::first();
        view()->share('setting', $setting);
    }
    public function index()
    {
        $hero = Home_hero::all()->first();
        $lingkup = Home_lingkup::all()->first();
        $nilai = Home_nilai::all()->first();
        $kategori = Kategori::all();
        $berita = Berita::with('kategori')->where('status', 1)->latest()->get();
        $shop = Shop::where('status', '!=', 0)->latest()->get();
        $artikel = Artikel::with('kategori')->where('status', '!=', 0)->latest()->get();
        return view('welcome', ['title' => 'Home', 'hero' => $hero, 'lingkup' => $lingkup, 'nilai' => $nilai, 'kategori' => $kategori, 'berita' => $berita, 'shop' => $shop, 'artikel' => $artikel]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
