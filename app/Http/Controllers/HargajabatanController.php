<?php

namespace App\Http\Controllers;

use App\Models\HargaJabatan;
use Illuminate\Http\Request;

class HargajabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $harga_jabatan = HargaJabatan::orderBy('id', 'asc')->get();
        return view('admin.hargajabatan.index', compact('harga_jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.hargajabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $harga_jabatan = HargaJabatan::create($request->all());
        return redirect()->route('hargajabatan.index')->with('success', 'Jam kerja berhasil diperbarui!.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $harga_jabatan = HargaJabatan::find($id);
        return view('admin.hargajabatan.edit', compact('harga_jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $harga_jabatan = HargaJabatan::find($id);
        $harga_jabatan->update($request->all());
        return redirect()->route('hargajabatan.index')->with('success', 'Jam kerja berhasil diperbarui!.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $harga_jabatan = HargaJabatan::findOrFail($id);
        $harga_jabatan->delete();
        return redirect()->route('hargajabatan.index')->with('success', 'Jam kerja berhasil dihapus!.');
    }
}
