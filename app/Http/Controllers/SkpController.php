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
            ->orderBy('skp.nip', 'asc')
            ->orderBy('t_pegawai.nama', 'asc')
            ->select('skp.id', 'skp.nip', 'skp.nilai', 'skp.persentase', 'skp.tahun', 't_pegawai.nama as nama_pegawai', 'satker.nama as nama_satker')
            ->distinct('skp.tahun', 'skp.nip')
            ->get();
        // dd($skps);
        return view('admin.skp.index', compact('skps', 'tahun', 'direktorats', 'years'));
    }

    public function getSatker($direktoratId)
    {
        $satkers = Satker::where('direktorat_id', $direktoratId)->get();

        return response()->json($satkers);
    }

    public function filter(Request $request)
    {
        $currentYear = date('Y');
        $startYear = 2015;
        $endYear = $currentYear - 1;
        $years = [];

        for ($year = $startYear; $year <= $endYear; $year++) {
            $years[] = $year;
        }
        $direktoratId = $request->input('direktorat');
        $satkerId = $request->input('satker');
        $tahun = $request->input('tahun');

        $direktorats = DB::table('direktorat')->get(); // Menggunakan \Illuminate\Support\Facades\DB
        $satkerOptions = [];

        $query = DB::table('skp')
            ->join('t_pegawai', 'skp.nip', '=', 't_pegawai.nip')
            ->join('satker', function ($join) {
                $join->on('t_pegawai.satker_id', '=', 'satker.satker_id')->orOn('t_pegawai.ppk_id', '=', DB::raw('satker.satker_id')); // Menggunakan DB::raw()
            })
            ->where('t_pegawai.status', 1);

        if ($tahun) {
            $query->where('skp.tahun', $tahun);
        }

        if ($direktoratId) {
            $satkerOptions = DB::table('satker')
                ->where('direktorat_id', $direktoratId)
                ->get();
            $query->where('t_pegawai.direktorat_id', $direktoratId);
        }

        if ($satkerId) {
            $query->where('t_pegawai.satker_id', $satkerId);
        }

        $query
            ->orderBy('skp.tahun', 'asc')
            ->orderBy('skp.nip', 'asc')
            ->orderBy('t_pegawai.nama', 'asc');

        $results = $query
            ->select('skp.id', 'skp.nip', 'skp.nilai', 'skp.persentase', 'skp.tahun', 't_pegawai.nama as nama_pegawai', 'satker.nama as nama_satker')
            ->distinct('skp.tahun', 'skp.nip')
            ->get();

        return view('admin.skp.filtered', compact('results', 'direktorats', 'satkerOptions', 'years'));
    }

    public function simpanSKP(Request $request)
    {
        $this->validate($request, [
            'ket' => 'required'
        ]);

        // Simpan data atau lakukan tindakan lain sesuai kebutuhan
        // Misalnya, menyimpan data keterangan pada database
        // $nip = $request->input('nip');
        // $ket = $request->input('ket');
        // ... lakukan tindakan sesuai kebutuhan ...

        // Mengembalikan respons ke JavaScript
        return response()->json(['message' => 'Data berhasil disimpan']);
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
    public function update(Request $request, skp $skp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(skp $skp)
    {
        //
    }
}
