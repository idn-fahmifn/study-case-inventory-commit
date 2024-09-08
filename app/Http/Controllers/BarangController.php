<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    public function update(Request $request, Barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        //
    }
}
