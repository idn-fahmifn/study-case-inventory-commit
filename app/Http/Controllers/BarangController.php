<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    
    public function index()
    {
        $data = Barang::all();
        $ruangan = Ruangan::all();
        return view('barang.index', compact('data','ruangan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        // angka random untuk kode_barang 
        $rand = random_int(000000000,999999999);
        $input['kode_barang'] = $input['kode_barang'].$rand;

        $request->validate([
            'kode_barang' => 'max:10|string|unique:barang|required',
            'nama_barang' => 'max:255|string|required',
            'gambar' => 'mimes:jpg,jpeg,png|max:5400|required',
        ]);
        if($request->hasFile('gambar'))
        {
            $gambar = $request->file('gambar');
            $extension = $gambar->getClientOriginalExtension();
            $path_destination = 'public/images/barang';
            $name = 'gambar_barang_'.Carbon::now()->format('Ymd_his').'.'.$extension;
            $path = $request->file('gambar')->storeAs($path_destination, $name);
            $input['gambar'] = $name;
        }
        Barang::create($input);
        return redirect()->route('barang.index')->with('Data barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Barang::find($id);
        $ruangan = Ruangan::all();
        return view('barang.show', compact('data','ruangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $data = Barang::find($id);


        if($request->input('kode_barang') ){
            //untuk kode_barang angka random
            $rand = random_int(000000000,9999999999);
            $input['kode_barang'] = $input['kode_barang'].$rand;
        }else{
           $input['kode_barang'] = $data->kode_barang;
        }

        $request->validate([
            'nama_barang' => 'max:255|string|required',
            'gambar' => 'mimes:jpg,jpeg,png|max:5400',
        ]);
        // kondisi denah
        if($request->hasFile('gambar'))
        {
            $gambar = $request->file('gambar');
            $extension = $gambar->getClientOriginalExtension();
            $path_destination = 'public/images/barang';
            $name = 'gambar_barang_'.Carbon::now()->format('Ymd_his').'.'.$extension;
            $path = $request->file('gambar')->storeAs($path_destination, $name);
            $input['denah_ruangan'] = $name;
            Storage::delete('public/images/barang/'.$data->gambar);
        }

        // $data->update($input);
        // return redirect()->route('ruangan.index')->with('success', 'Data berhasil diubah');

        dd($input);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        //
    }
}
