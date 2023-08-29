<?php

namespace App\Http\Controllers;

use App\Models\Tjamkerja;
use Illuminate\Http\Request;

class HarikerjapuasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $harikerjapuasa = Tjamkerja::orderBy('tgl_awal', 'asc')->get();

        return view('admin.harikerjapuasa.index', compact('harikerjapuasa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.harikerjapuasa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validasi data input jika diperlukan
        $validatedData = $request->validate([
            'hari' => 'required',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
            'ket' => 'required',
        ]);

        // Simpan data ke dalam database
        Tjamkerja::create($validatedData);
        
        // dd($validatedData);
        return redirect()->route('harikerjapuasa.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tjamkerja $tjamkerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $harikerjapuasa = Tjamkerja::findOrFail($id);

        return view('admin.harikerjapuasa.edit', compact('harikerjapuasa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $validatedData = $request->validate([
            'hari' => 'required',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
            'ket' => 'required',
        ]);

        $harikerjapuasa = Tjamkerja::findOrFail($id);
        $harikerjapuasa->update($validatedData);

        return redirect()
            ->route('harikerjapuasa.index')
            ->with('success', 'Jam kerja berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tjamkerja $tjamkerja)
    {
        //
    }
}
