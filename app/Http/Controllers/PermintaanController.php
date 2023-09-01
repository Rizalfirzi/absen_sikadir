<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\Satker;
use App\Models\Direktorat;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermintaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $direktorats = Direktorat::all();

        return view('admin.konfirmasi_izin.index', compact('direktorats'));
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

        $direktorats = Direktorat::all();

        $filteredData = DB::table('t_pegawai')
            ->join('izin', 't_pegawai.nip', '=', 'izin.nik')
            ->where(function ($query) use ($satkerId, $tipePegawai) {
                $query
                    ->where('t_pegawai.satker_id', $satkerId)
                    ->where('t_pegawai.status', $tipePegawai)
                    ->where('izin.st', '0')
                    ->where('izin.deleted', '0');
            })
            ->orWhere(function ($query) use ($satkerId, $tipePegawai) {
                $query
                    ->where('t_pegawai.ppk_id', $satkerId)
                    ->where('t_pegawai.status', $tipePegawai)
                    ->where('izin.st', '0')
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

        $filtered = $filteredData
            ->orderBy('t_pegawai.nama', 'asc')
            ->select('izin.nik', 'izin.tanggal', 'izin.jenis', 'izin.nosurat', 'izin.alasan', 't_pegawai.nama')
            ->get();

        return view('admin.konfirmasi_izin.filtered', compact('filtered', 'direktorats', 'satkerName'));
    }

    public function getKonfirmasiNotification(Request $request)
    {
        $notif = DB::table('t_pegawai')
        ->join('izin', 't_pegawai.nip', '=', 'izin.nik')
        ->where(function ($query) {
            $query
                ->where('izin.st', '0')
                ->where('izin.deleted', '0')
                ->where('t_pegawai.aktif', 'Aktif');
        })
        ->count();
        // dd($notif);
        return response()->json(['notif' => $notif]);
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
    public function show(Permintaan $permintaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permintaan $permintaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permintaan $permintaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permintaan $permintaan)
    {
        //
    }
}
