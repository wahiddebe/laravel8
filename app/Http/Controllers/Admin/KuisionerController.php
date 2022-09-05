<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hasil_Kategori;
use App\Models\Hasil_Kuisioner;
use App\Models\Hasil_Kuisioner_Pilihan;
use App\Models\Kategori;
use App\Models\KategoriKuis;
use App\Models\Kuisioner;
use App\Models\PilihanKuis;
use App\Models\SubKategoriKuis;
use Illuminate\Http\Request;

class KuisionerController extends Controller
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

        $kategori = KategoriKuis::first();
        $subkategori = SubKategoriKuis::where('kategori_id', $kategori->id)->get();
        $data = Kuisioner::where('kategori_id', $kategori->id)->with('kategori', 'subkategori')->get();
        $kategoriall = KategoriKuis::all();
        return view('admin.kuisioner.kuisioner', ['data' => $data, 'title' => 'Kuisioner', 'kategori' => $kategori, 'subkategori' => $subkategori, 'kategoriall' => $kategoriall]);
    }
    public function index_params($id)
    {
        # code...

        $data = Kuisioner::where('kategori_id', $id)->with('kategori', 'subkategori')->get();
        $subkategori = SubKategoriKuis::where('kategori_id', $id)->get();
        $kategori = KategoriKuis::find($id);
        $kategoriall = KategoriKuis::all();
        return view('admin.kuisioner.kuisioner', ['data' => $data, 'title' => 'Kuisioner', 'kategori' => $kategori, 'subkategori' => $subkategori, 'kategoriall' => $kategoriall]);
    }
    public function kategori_index()
    {
        $data = KategoriKuis::all();

        return view('admin.kuisioner.kategori', ['data' => $data, 'title' => 'Kategori']);
    }
    public function subkategori_index()
    {
        $data = SubKategoriKuis::with('kategori')->get();
        $kategori = KategoriKuis::all();
        return view('admin.kuisioner.subkategori', ['data' => $data, 'title' => 'Sub Kategori', 'kategori' => $kategori]);
    }

    public function pilihan_index($id)
    {
        # code...
        $data = Kuisioner::where('id', $id)->with('pilihans')->first();
        $pilihan = PilihanKuis::where('kuisioner_id', $id)->get();
        return view('admin.kuisioner.pilihan', ['data' => $data, 'title' => 'Pilihan', 'pilihan' => $pilihan]);
    }
    public function hasil_kategori_index()
    {
        # code...
        $data = Hasil_Kategori::with('kategori')->get();
        $kategori = KategoriKuis::all();
        return view('admin.kuisioner.hasil_kategori', ['data' => $data, 'title' => 'Kunci Jawaban', 'kategori' => $kategori]);
    }

    public function hasil_kuisioner_index()
    {
        # code...
        $data = Hasil_Kuisioner::with('kategori', 'hasil_kategori')->get();
        return view('admin.kuisioner.hasil_kuisioner', ['data' => $data, 'title' => 'Hasil Kuisioner',]);
    }
    public function hasil_kuisioner_per_index($id)
    {
        # code...
        $data = Hasil_Kuisioner_Pilihan::where('hasil_kuisioner_id', $id)->get();
        return view('admin.kuisioner.hasil_kuisioner_per', ['data' => $data, 'title' => 'Hasil Kuisioner',]);
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
        $data = new Kuisioner();
        $data->kategori_id = $request->kategori;
        $data->sub_kategori_id = $request->subkategori;
        $data->pertanyaan = $request->pertanyaan;


        if ($data->save()) {
            return redirect('admin/kuisioner/' . $data->kategori_id)->with('message', 'Data berhasil ditambah');
        } else {
            return redirect('admin/kuisioner/' . $data->kategori_id)->with('message', 'Data gagal ditambah');
        }
    }

    public function kategori_store(Request $request)
    {
        $data = new KategoriKuis();
        $data->nama = $request->nama;

        if ($data->save()) {
            return redirect('admin/kuisioner/kategori')->with('message', 'Data berhasil ditambah');
        } else {
            return redirect('admin/kuisioner/kategori')->with('message', 'Data gagal ditambah');
        }
    }
    public function subkategori_store(Request $request)
    {
        $data = new SubKategoriKuis();
        $data->nama = $request->nama;
        $data->kategori_id = $request->kategori_id;

        if ($data->save()) {
            return redirect('admin/kuisioner/subkategori')->with('message', 'Data berhasil ditambah');
        } else {
            return redirect('admin/kuisioner/subkategori')->with('message', 'Data gagal ditambah');
        }
    }
    public function pilihan_store(Request $request)
    {
        # code...
        $data = new PilihanKuis();
        $jenis = $request->jenis;
        if ($jenis != 1) {
            # code...
            $data->pilihan = $jenis;
        } else {
            # code...
            $data->pilihan = $request->pilihan;
            $data->nilai = $request->nilai;
        }

        $data->kuisioner_id = $request->kuisioner_id;
        if ($data->save()) {
            return redirect('admin/kuisioner/pilihan/' . $data->kuisioner_id)->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/kuisioner/pilihan/' . $data->kuisioner_id)->with('message', 'Data gagal diubah');
        }
    }

    public function hasil_kategori_store(Request $request)
    {
        # code...
        $data = new Hasil_Kategori();
        $data->jawaban = $request->jawaban;
        $data->kategori_id = $request->kategori_id;
        $data->min_jawaban = $request->min_jawaban;
        $data->max_jawaban = $request->max_jawaban;
        if ($data->save()) {
            return redirect('admin/kuisioner/hasil/kategori')->with('message', 'Data berhasil ditambah');
        } else {
            return redirect('admin/kuisioner/hasil/kategori')->with('message', 'Data gagal ditambah');
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
        $data = Kuisioner::find($request->id)->first();
        $data->kategori_id = $request->kategori;
        $data->sub_kategori_id = $request->subkategori;
        $data->pertanyaan = $request->pertanyaan;


        if ($data->update()) {
            return redirect('admin/kuisioner/show/' . $data->kategori_id)->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/kuisioner/show/' . $data->kategori_id)->with('message', 'Data gagal diubah');
        }
    }

    public function kategori_update(Request $request)
    {
        $data = KategoriKuis::find($request->id);
        $data->nama = $request->nama;

        if ($data->update()) {
            return redirect('admin/kuisioner/kategori')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/kuisioner/kategori')->with('message', 'Data gagal diubah');
        }
    }
    public function subkategori_update(Request $request)
    {
        $data = SubKategoriKuis::find($request->id);
        $data->nama = $request->nama;
        $data->kategori_id = $request->kategori_id;

        if ($data->update()) {
            return redirect('admin/kuisioner/subkategori')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/kuisioner/subkategori')->with('message', 'Data gagal diubah');
        }
    }
    public function pilihan_update(Request $request)
    {
        # code...
        $data = PilihanKuis::find($request->id);
        $jenis = $request->jenis;
        if ($jenis != 1) {
            # code...
            $data->pilihan = $jenis;
        } else {
            # code...
            $data->pilihan = $request->pilihan;
            $data->nilai = $request->nilai;
        }

        if ($data->update()) {
            return redirect('admin/kuisioner/pilihan/' . $data->kuisioner_id)->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/kuisioner/pilihan/' . $data->kuisioner_id)->with('message', 'Data gagal diubah');
        }
    }

    public function hasil_kategori_update(Request $request)
    {
        # code...
        $data = Hasil_Kategori::find($request->id);
        $data->jawaban = $request->jawaban;
        $data->kategori_id = $request->kategori_id;
        $data->min_jawaban = $request->min_jawaban;
        $data->max_jawaban = $request->max_jawaban;
        if ($data->update()) {
            return redirect('admin/kuisioner/hasil/kategori')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/kuisioner/hasil/kategori')->with('message', 'Data gagal diubah');
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
        $data = Kuisioner::find($request->id);
        if ($data->delete()) {
            return redirect('admin/kuisioner/show/' . $data->kategori_id)->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('admin/kuisioner/show/' . $data->kategori_id)->with('message', 'Data gagal dihapus');
        }
    }

    public function kategori_destroy(Request $request)
    {
        # code...
        $data = KategoriKuis::find($request->id);
        if ($data->delete()) {
            return redirect('admin/kuisioner/kategori')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('admin/kuisioner/kategori')->with('message', 'Data gagal dihapus');
        }
    }
    public function subkategori_destroy(Request $request)
    {
        # code...
        $data = SubKategoriKuis::find($request->id);
        if ($data->delete()) {
            return redirect('admin/kuisioner/subkategori')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('admin/kuisioner/subkategori')->with('message', 'Data gagal dihapus');
        }
    }
    public function pilihan_destroy(Request $request)
    {
        # code...
        $data = PilihanKuis::find($request->id);
        if ($data->delete()) {
            return redirect('admin/kuisioner/pilihan/' . $data->kuisioner_id)->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('admin/kuisioner/pilihan/' . $data->kuisioner_id)->with('message', 'Data gagal dihapus');
        }
    }
    public function hasil_kategori_destroy(Request $request)
    {
        # code...
        $data = Hasil_Kategori::find($request->id);
        if ($data->delete()) {
            return redirect('admin/kuisioner/hasil/kategori')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('admin/kuisioner/hasil/kategori')->with('message', 'Data gagal dihapus');
        }
    }
    public function hasil_kuisioner_destroy(Request $request)
    {
        # code...
        $data = Hasil_Kuisioner::find($request->id);
        if ($data->delete()) {
            return redirect('/admin/kuisioner/hasil/kuisioner/')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('/admin/kuisioner/hasil/kuisioner/')->with('message', 'Data gagal dihapus');
        }
    }
}
