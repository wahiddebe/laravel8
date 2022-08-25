<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
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
        $data = Berita::with('kategori')->where('status', 1)->get();
        $kategori = Kategori::all();
        return view('admin.berita', ['data' => $data, 'title' => 'Berita', 'kategori' => $kategori]);
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
        $data = new Berita();
        $data->title = $request->title;
        $data->slug = \Str::slug($request->title);
        $data->desc = $request->desc;
        $data->kategoris_id = $request->kategoris_id;
        $data->penulis = $request->penulis;
        $data->status = 1;
        if ($request->file('gambar')) {
            // Storage::delete($data->gambar);
            $data->gambar = $request->file('gambar')->store('berita');
        }
        if ($data->save()) {
            return redirect('admin/berita')->with('message', 'Data berhasil ditambah');
        } else {
            return redirect('admin/berita')->with('message', 'Data gagal ditambah');
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
        $data = Berita::find($request->id);
        $data->title = $request->title;
        $data->slug = \Str::slug($request->title);
        $data->desc = $request->desc;
        $data->kategoris_id = $request->kategoris_id;
        $data->penulis = $request->penulis;
        $data->status = 1;
        if ($request->file('gambar')) {
            Storage::delete($data->gambar);
            $data->gambar = $request->file('gambar')->store('berita');
        }
        if ($data->update()) {
            return redirect('admin/berita')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/berita')->with('message', 'Data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        $data = Berita::find($id);
        $data->status = 0;
        if ($data->update()) {
            return redirect('admin/berita')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('admin/berita')->with('message', 'Data gagal dihapus');
        }
    }
}
