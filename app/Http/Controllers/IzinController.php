<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use Illuminate\Http\Request;
use App\Models\Direktorat;
use App\Models\Satker;
use Illuminate\Support\Facades\DB;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $direktorats = Direktorat::all();
        return view('admin.izin.index', compact('direktorats'));
    }

    public function getSatker($direktoratId)
    {
        $satkers = Satker::where('direktorat_id', $direktoratId)->get();

        return response()->json($satkers);
    }
    public function filter(Request $request)
    {
        $satkerId = $request->input('satker');
        $direktoratId = $request->input('direktorat');
        $tipePegawai = $request->input('tipe_pegawai');
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        $direktorats = Direktorat::all();

        $filteredData = DB::table('t_pegawai')
            ->join('izin', 't_pegawai.nip', '=', 'izin.nik')
            ->where(function ($query) use ($satkerId, $tipePegawai, $awal, $akhir) {
                $query
                    ->where('t_pegawai.satker_id', $satkerId)
                    ->where('t_pegawai.status', $tipePegawai)
                    ->whereBetween('izin.tanggal', [$awal, $akhir])
                    ->where('izin.st', '1')
                    ->where('izin.deleted', '0');
            })
            ->orWhere(function ($query) use ($satkerId, $tipePegawai, $awal, $akhir) {
                $query
                    ->where('t_pegawai.ppk_id', $satkerId)
                    ->where('t_pegawai.status', $tipePegawai)
                    ->whereBetween('izin.tanggal', [$awal, $akhir])
                    ->where('izin.st', '1')
                    ->where('izin.deleted', '0');
            });

        $satkerName = '';

        if ($satkerId) {
            if ($satkerId === 'all') {
                $filteredData->whereNotNull('t_pegawai.satker_id');
                $satkerName = 'All Satker';
            } else {
                $filteredData->where(function ($query) use ($satkerId) {
                    $query->where('t_pegawai.satker_id', $satkerId);
                });
                $satker = DB::table('satker')
                    ->where('satker_id', $satkerId)
                    ->first();

                if ($satker) {
                    $satkerName = $satker->nama;
                } else {
                    // Handle jika satker tidak ditemukan
                    $satkerName = 'Unknown Satker';
                }
            }
        } else {
            // Tidak ada satker yang dipilih, jadi atur untuk menampilkan semua satker
            $filteredData->whereNotNull('t_pegawai.satker_id');
            $satkerName = 'All Satker';
        }

        $filteredData = $filteredData
            ->orderBy('t_pegawai.nama', 'asc')
            ->select('izin.nik', 'izin.tanggal', 'izin.jenis', 'izin.nosurat', 'izin.alasan', 't_pegawai.nama')
            ->get();

        return view('admin.izin.filtered', compact('filteredData', 'direktorats', 'satkerName'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $employees = DB::table('t_pegawai')
            ->select('nip', 'nama')
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.izin.create', compact('employees'));
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
    public function show(Izin $izin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Izin $izin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Izin $izin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Izin $izin)
    {
        //
    }
}
