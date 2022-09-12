<?php

namespace App\Http\Controllers;

use App\Models\Hasil_Kuisioner;
use App\Models\Hasil_Kuisioner_Pilihan;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    //

    public function export_kuisioner($id)
    {
        $data = Hasil_Kuisioner::with('kategori', 'hasil_kategori')->find($id);
        $data2 = Hasil_Kuisioner_Pilihan::where('hasil_kuisioner_id', $id)->get();
        return view('admin.kuisioner.export', ['data' => $data, 'data2' => $data2]);
    }
}
