<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Direktorat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiNonPnsTidakAktif extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $direktorats = Direktorat::all();
        $pegawai = DB::table('t_pegawai')
            ->select('t_pegawai.*', 'direktorat.direktorat as nama_direktorat', 'satker.nama as nama_satker', 'profil_pegawai.tgl_lahir')
            ->leftJoin('direktorat', 't_pegawai.direktorat_id', '=', 'direktorat.direktorat_id')
            ->leftJoin('satker', function ($join) {
                $join->on('t_pegawai.satker_id', '=', 'satker.satker_id')->orWhere('t_pegawai.ppk_id', '=', DB::raw('satker.satker_id'));
            })
            ->leftJoin('profil_pegawai', 'profil_pegawai.id_pegawai', '=', 't_pegawai.id')
            ->where('t_pegawai.status', '!=', '1')
            ->where('t_pegawai.status', '!=', '4')
            ->where('t_pegawai.aktif', 'Tidak Aktif')
            ->orderBy('t_pegawai.satker_id')
            ->orderBy('t_pegawai.nama', 'asc')
            ->get();

        // dd($pegawai);
        return view('admin.pegawai_non_pns_tidak_aktif.index', compact('direktorats', 'pegawai'));

    }

    public function getSatker($direktoratId)
    {
        $satkers = Satker::where('direktorat_id', $direktoratId)->get();

        return response()->json($satkers);
    }

    public function getSatkerByDirektorat($direktoratId)
    {
        $satkers = Satker::where('direktorat_id', $direktoratId)
            ->whereNotNull('prop')
            ->orderBy('nama', 'asc')
            ->get();

        return response()->json($satkers);
    }

    public function getPpkByDirektorat($direktoratId)
    {
        $ppk = Satker::where('direktorat_id', $direktoratId)
            ->whereNull('prop')
            ->get();

        return response()->json($ppk);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $direktorats = DB::table('direktorat')->get();
        return view('admin.pegawai_non_pns_tidak_aktif.create', compact('direktorats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
