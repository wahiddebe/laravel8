<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Home_hero;
use App\Models\Home_lingkup;
use App\Models\Home_nilai;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
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

        $data = Home_hero::all()->first();
        return view('admin.home.hero', ['data' => $data, 'title' => 'Home']);
    }

    public function lingkup()
    {

        $data = Home_lingkup::all()->first();
        return view('admin.home.lingkup', ['data' => $data, 'title' => 'Lingkup Kegiatan']);
    }
    public function nilai()
    {

        $data = Home_nilai::all()->first();
        $kategori = Kategori::all();
        return view('admin.home.nilai', ['data' => $data, 'title' => 'Nilai', 'kategori' => $kategori]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // $data           = new \App\Models\Post;
        // $data->title    = $request->title;
        // $data->slug     = \Str::slug(request('title'));
        // $data->desc     = $request->desc;
        // if ($request->file('thumbnail')) {
        //     $data->thumbnail = $request->file('thumbnail')->store('thumbnail');
        // }
        // $data->save();
        // return redirect('home');
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
        $data = Home_hero::find($request->id);
        $data->judul    = $request->judul;
        $data->sub_judul    = $request->sub_judul;
        $data->tahun    = $request->tahun;
        if ($request->file('gambar')) {
            Storage::delete($data->gambar);
            $data->gambar = $request->file('gambar')->store('images');
        }
        if ($data->update()) {
            return redirect('admin/hero')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/hero')->with('message', 'Data gagal diubah');
        }
    }

    public function lingkup_store(Request $request)
    {

        $data = Home_lingkup::all()->first();

        $point = json_decode($data->point);
        array_push($point, $request->point);
        $data->point = json_encode($point);
        if ($data->save()) {
            return redirect('admin/lingkup')->with('message', 'Data berhasil tambah');
        } else {
            return redirect('admin/lingkup')->with('message', 'Data gagal tambah');
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
    public function lingkup_update(Request $request)
    {
        $id = $request->id;
        $data = Home_lingkup::all()->first();

        $point = json_decode($data->point);
        if (($key = array_search($id, $point)) !== false) {
            $point[$key] = $request->point;
        }
        $data->point = json_encode($point);
        if ($data->update()) {
            return redirect('admin/lingkup')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/lingkup')->with('message', 'Data gagal ditambah');
        }
    }

    public function nilai_update(Request $request)
    {
        $id = $request->id;
        $data = Kategori::find($id);

        $data->nama    = $request->nama;
        if ($request->file('gambar')) {
            Storage::delete($data->gambar);
            $data->gambar = $request->file('gambar')->store('images');
        }
        if ($data->update()) {
            return redirect('admin/nilai')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/nilai')->with('message', 'Data gagal ditambah');
        }
    }

    public function lingkup_gambar_update(Request $request)
    {
        $data = Home_lingkup::all()->first();
        if ($request->file('gambar')) {
            Storage::delete($data->gambar);
            $data->gambar = $request->file('gambar')->store('images');
        }
        $data->judul = $request->judul;
        if ($data->update()) {
            return redirect('admin/lingkup')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/lingkup')->with('message', 'Data gagal ditambah');
        }
    }

    public function nilai_gambar_update(Request $request)
    {
        $data = Home_nilai::all()->first();
        if ($request->file('gambar1')) {
            Storage::delete($data->gambar1);
            $data->gambar1 = $request->file('gambar1')->store('images');
        }
        if ($request->file('gambar2')) {
            Storage::delete($data->gambar2);
            $data->gambar2 = $request->file('gambar2')->store('images');
        }
        $data->judul = $request->judul;
        if ($data->update()) {
            return redirect('admin/nilai')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/nilai')->with('message', 'Data gagal ditambah');
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_lingkup(Request $request)
    {
        $id = $request->id;
        $data = Home_lingkup::all()->first();
        $point = $data->point;
        array_diff($point, $id);
        $data->point = json_encode($point);
        if ($data->update()) {
            return redirect('admin/lingkup')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('admin/lingkup')->with('message', 'Data gagal dihapus');
        }
    }
}
