<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Ruangan::all();
        $petugas = User::all();
        return view('ruangan.index', compact('data', 'petugas'));
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
        $request->validate([
            'kode_ruangan' => 'max:10|string|unique:ruangan|required',
            'nama_ruangan' => 'max:255|string|required',
            'foto_ruangan' => 'mimes:jpg,jpeg,png|max:5400|required',
            'denah_ruangan' => 'mimes:jpg,jpeg,png|max:5400|required',
        ]);

        if($request->hasFile('foto_ruangan'))
        {
            $gambar = $request->file('foto_ruangan');
            $extension = $gambar->getClientOriginalExtension();
            $path_destination = 'public/images/ruangan';
            $name = 'foto_ruangan_'.Carbon::now()->format('Ymd_his').'.'.$extension;
            $path = $request->file('foto_ruangan')->storeAs($path_destination, $name);
            $input['foto_ruangan'] = $name;
        }

        if($request->hasFile('denah_ruangan'))
        {
            $gambar = $request->file('denah_ruangan');
            $extension = $gambar->getClientOriginalExtension();
            $path_destination = 'public/images/denah';
            $name = 'denah_ruangan_'.Carbon::now()->format('Ymd_his').'.'.$extension;
            $path = $request->file('denah_ruangan')->storeAs($path_destination, $name);
            $input['denah_ruangan'] = $name;
        }
        Ruangan::create($input);
        return redirect()->route('ruangan.index')->with('Data ruangan berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Ruangan::find($id);
        $petugas = User::all();
        return view('ruangan.show', compact('data', 'petugas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruangan $ruangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $data = Ruangan::find($id);
        $request->validate([
            'kode_ruangan' => 'max:10|string|unique:ruangan|required',
            'nama_ruangan' => 'max:255|string|required',
            'foto_ruangan' => 'mimes:jpg,jpeg,png|max:5400',
            'denah_ruangan' => 'mimes:jpg,jpeg,png|max:5400',
        ]);

        //kondisi ruangan 
        if($request->hasFile('foto_ruangan'))
        {
            $gambar = $request->file('foto_ruangan');
            $extension = $gambar->getClientOriginalExtension();
            $path_destination = 'public/images/ruangan';
            $name = 'foto_ruangan_'.Carbon::now()->format('Ymd_his').'.'.$extension;
            $path = $request->file('foto_ruangan')->storeAs($path_destination, $name);
            $input['foto_ruangan'] = $name;
            Storage::delete('public/images/ruangan/'.$data->foto_ruangan);
        }

        // kondisi denah
        if($request->hasFile('denah_ruangan'))
        {
            $gambar = $request->file('denah_ruangan');
            $extension = $gambar->getClientOriginalExtension();
            $path_destination = 'public/images/denah';
            $name = 'denah_ruangan_'.Carbon::now()->format('Ymd_his').'.'.$extension;
            $path = $request->file('denah_ruangan')->storeAs($path_destination, $name);
            $input['denah_ruangan'] = $name;
            Storage::delete('public/images/denah/'.$data->denah_ruangan);

        }

        $data->update($input);
        return redirect()->route('ruangan.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ruangan $ruangan)
    {
        //
    }
}
