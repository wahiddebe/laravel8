<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
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
        $data = Shop::where('status', '!=', 0)->latest()->get();
        return view('admin.shop', ['data' => $data, 'title' => 'Yogasmarashop']);
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
        $price = str_replace(['.', "/\s+/", 'Rp'], '', $request->price);
        $data = new Shop();
        $data->title = $request->title;
        $data->slug = \Str::slug($request->title);
        $data->desc = $request->desc;
        $data->price = $price;
        $data->link = $request->link;
        $data->status = 1;
        if ($request->file('gambar')) {
            // Storage::delete($data->gambar);
            $data->gambar = $request->file('gambar')->store('shop');
        }
        if ($data->save()) {
            return redirect('admin/shop')->with('message', 'Data berhasil ditambah');
        } else {
            return redirect('admin/shop')->with('message', 'Data gagal ditambah');
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
        $price = str_replace(['.', "/\s+/", 'Rp'], '', $request->price);
        $data = Shop::find($request->id);
        $data->title = $request->title;
        $data->slug = \Str::slug($request->title);
        $data->desc = $request->desc;
        $data->price = $price;
        $data->link = $request->link;
        $data->status = 1;
        if ($request->file('gambar')) {
            Storage::delete($data->gambar);
            $data->gambar = $request->file('gambar')->store('shop');
        }
        if ($data->save()) {
            return redirect('admin/shop')->with('message', 'Data berhasil diubah');
        } else {
            return redirect('admin/shop')->with('message', 'Data gagal diubah');
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
        $data = Shop::find($id);
        $data->status = 0;
        if ($data->update()) {
            return redirect('admin/shop')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('admin/shop')->with('message', 'Data gagal dihapus');
        }
    }
}
