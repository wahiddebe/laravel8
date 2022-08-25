<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data = Kategori::all();
        return view('admin.kategori', ['data' => $data, 'title' => 'Kategori']);
    }

    public function update(Request $request)
    {
        # code...
        $id = $request->id;
        $data = Kategori::find($id);

        $data->nama    = $request->nama;
        if ($request->file('gambar')) {
            Storage::delete($data->gambar);
            $data->gambar = $request->file('gambar')->store('images');
        }
        if ($data->update()) {
            return redirect('admin/kategori')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/kategori')->with('message', 'Data gagal diubah');
        }
    }
}
