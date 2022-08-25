<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tentang;
use App\Models\Tentang_layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TentangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //

        $data = Tentang::all()->first();
        return view('admin.tentang.hero', ['data' => $data, 'title' => 'Tentang Kami']);
    }

    public function layanan()
    {
        # code...
        $data = Tentang::all()->first();
        $data1 = Tentang_layanan::all();
        return view('admin.tentang.layanan', ['data' => $data, 'title' => 'Layanan', 'data1' => $data1]);
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
    public function point_store(Request $request)
    {
        //
        $data = new Tentang_layanan();
        $data->title   = $request->title;
        $data->desc   = $request->desc;
        if ($data->save()) {
            return redirect('/admin/tentang-kami/layanan')->with('message', 'Data berhasil ditambah');
        } else {
            return redirect('/admin/tentang-kami/layanan')->with('message', 'Data gagal ditambah');
        }
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
    public function update(Request $request)
    {
        //
        $data = Tentang::all()->first();
        $data->title_hero    = $request->title_hero;
        $data->desc_hero    = $request->desc_hero;
        if ($request->file('gambar_hero')) {
            Storage::delete($data->gambar_hero);
            $data->gambar_hero = $request->file('gambar_hero')->store('images');
        }
        if ($data->update()) {
            return redirect('admin/tentang-kami')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/tentang-kami')->with('message', 'Data gagal diubah');
        }
    }
    public function layanan_update(Request $request)
    {
        $data = Tentang::all()->first();
        $data->title_layanan    = $request->title_layanan;
        if ($request->file('gambar_layanan')) {
            Storage::delete($data->gambar_layanan);
            $data->gambar_layanan = $request->file('gambar_layanan')->store('images');
        }
        if ($data->update()) {
            return redirect('admin/tentang-kami/layanan')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/tentang-kami/layanan')->with('message', 'Data gagal diubah');
        }
    }
    public function visimisi_update(Request $request)
    {
        # code...
        $data = Tentang::all()->first();;
        $data->title_visi    = $request->title_visi;
        $data->desc_visi    = $request->desc_visi;
        $data->title_misi    = $request->title_misi;
        $data->desc_misi    = $request->desc_misi;
        if ($data->update()) {
            return redirect('admin/tentang-kami')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/tentang-kami')->with('message', 'Data gagal diubah');
        }
    }

    public function point_update(Request $request)
    {
        # code...
        $id = $request->id;
        $data = Tentang_layanan::find($id);
        $data->title   = $request->title;
        $data->desc   = $request->desc;
        if ($data->update()) {
            return redirect('/admin/tentang-kami/layanan')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('/admin/tentang-kami/layanan')->with('message', 'Data gagal diubah');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function point_destroy(Request $request)
    {
        //
        $id = $request->id;
        $data = Tentang_layanan::find($id);
        if ($data->delete()) {
            return redirect('/admin/tentang-kami/layanan')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('/admin/tentang-kami/layanan')->with('message', 'Data gagal dihapus');
        }
    }
}
