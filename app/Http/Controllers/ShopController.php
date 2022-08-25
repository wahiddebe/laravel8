<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function __construct()
    {
        $setting = Setting::first();
        view()->share('setting', $setting);
    }
    public function index()
    {
        //
        $data = Shop::where('status', '!=', 0)->latest()->get();
        return view('shop', ['data' => $data, 'title' => 'Yogasmarashop']);
    }
}
