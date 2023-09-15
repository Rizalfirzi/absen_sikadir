<?php

namespace App\Http\Controllers;

use App\Models\Skp;
use Illuminate\Http\Request;
use App\Models\Direktorat;
use App\Models\Satker;
use Illuminate\Support\Facades\DB;

class SkpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentYear = date('Y');
        $startYear = 2015;
        $endYear = $currentYear - 1;
        $years = [];

        for ($year = $startYear; $year <= $endYear; $year++) {
            $years[] = $year;
        }
        $direktorats = Direktorat::all();
        $tahun = 2022;

        $skps = DB::table('skp')
            ->join('t_pegawai', 'skp.nip', '=', 't_pegawai.nip')
            ->join('satker', function ($join) {
                $join->on('t_pegawai.satker_id', '=', 'satker.satker_id')->orOn('t_pegawai.ppk_id', '=', 'satker.satker_id');
            })
            ->where('skp.tahun', $tahun)
            ->where('t_pegawai.status', 1)
            ->orderBy('skp.tahun', 'asc')
            ->orderBy('t_pegawai.nama', 'asc')
            ->select('skp.id', 'skp.nip', 'skp.nilai', 'skp.persentase', 'skp.tahun', 't_pegawai.nama as nama_pegawai', 'satker.nama as nama_satker')
            ->distinct('t_pegawai.nama','skp.tahun', 'skp.nip')
            ->get();
        // dd($skps);
        return view('admin.skp.index', compact('skps', 'tahun', 'direktorats', 'years'));
    }

    public function getSatker($direktoratId)
    {
        $satkers = Satker::where('direktorat_id', $direktoratId)->get();

        return response()->json($satkers);
    }

    public function editSkp($direktoratId)
    {
        $edits = Satker::where('direktorat_id', $direktoratId)->get();

        return response()->json($edits);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(skp $skp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(skp $skp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'nilai' => 'required'
    //     ]);
    //     $skp = Skp::findOrFail($id);
    //     $skp->nilai = $request->input('nilai');
    //     $skp->save();

    //     return response()->json(['message' => 'Data updated successfully']);
    // }
    public function update(Request $request, $id)
    {
        $nilai = $request->input('nilai');

        DB::table('skp')->where('id', $id)->update(['nilai' => $nilai]);

        return response()->json(['message' => 'Nilai berhasil diperbarui']);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(skp $skp)
    {
        //
    }
}
