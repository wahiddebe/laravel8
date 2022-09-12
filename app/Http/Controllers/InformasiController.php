<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Models\Setting;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    //
    public function __construct()
    {
        $setting = Setting::first();
        view()->share('setting', $setting);
    }
    public function show($id)
    {
        $data = Informasi::find($id);
        if ($id == 1) {
            $subtitle = 'Autisma';
        } else {
            $subtitle = 'Disabilitas';
        }
        return view('informasi', ['title' => 'Informasi', 'data' => $data, 'subtitle' => $subtitle]);
    }
}
