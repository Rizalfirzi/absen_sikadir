<?php

namespace App\Http\Controllers;

use App\Models\Tukin;
use App\Models\Satker;
use App\Models\Direktorat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TukinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $currentYear = date('Y');
        $startYear = 2016;
        $endYear = 2027;
        $years = [];

        for ($year = $startYear; $year <= $endYear; $year++) {
            $years[] = $year;
        }
        $direktorats = Direktorat::all();

        return view('admin.rekaptukin.index', compact('direktorats', 'years', 'months'));
    }

    public function getSatker($direktoratId)
    {
        $satkers = Satker::where('direktorat_id', $direktoratId)->get();

        return response()->json($satkers);
    }

    public function filter(Request $request)
    {
        $direktoratId = $request->input('direktorat');
        $satkerId = $request->input('satker');
        $selectedTahun = $request->input('tahun');
        $selectedBulan = $request->input('bulan');

        $currentYear = date('Y');
        $startYear = 2016;
        $endYear = 2027;
        $years = range($startYear, $endYear);

        $direktorats = DB::table('direktorat')->get();

        $tukinMatangs = Tukin::select(
            't_pegawai.nip',
            't_pegawai.nama',
            'satker.nama AS nama_satker',
            't_tukin_matang.gradejabatan',
            'harga_jabatan.harga_jabatan',
            't_tukin_matang.skp_persentase',
            't_tukin_matang.tukin_dasar',
            't_tukin_matang.tukin_terima',
            't_tukin_matang.cuti_besar',
            't_tukin_matang.cuti_besar_pot',
            't_tukin_matang.cuti_penting',
            't_tukin_matang.cuti_penting_pot',
            't_tukin_matang.cuti_lahir',
            't_tukin_matang.cuti_lahir_pot',
            't_tukin_matang.tubel',
            't_tukin_matang.tubel_pot',
            't_tukin_matang.izin',
            't_tukin_matang.izin_pot',
            't_tukin_matang.tk',
            't_tukin_matang.tk_pot',
            't_tukin_matang.telat_tl',
            't_tukin_matang.psw',
            't_tukin_matang.total_kjk',
            't_tukin_matang.kjk_pot',
            't_tukin_matang.bulan',
            't_tukin_matang.tahun',
            't_tukin_matang.tot_potongan'

        )
        ->join('t_pegawai', 't_pegawai.nip','=','t_tukin_matang.nip')
        ->leftJoin('harga_jabatan', 't_pegawai.gradejabatan', '=', 'harga_jabatan.peringkat_jabatan')
        ->leftJoin('satker', 't_pegawai.satker_id', '=', 'satker.satker_id');

        if ($direktoratId) {
            $tukinMatangs->where(function ($query) use ($direktoratId) {
                $query->where('t_pegawai.direktorat_id', $direktoratId)->orWhere('t_pegawai.ppk_id', '=', DB::raw($direktoratId));
            });
        }
        if ($satkerId) {
            $tukinMatangs->where(function ($query) use ($satkerId) {
                $query->where('t_pegawai.satker_id', $satkerId)->orWhere('t_pegawai.ppk_id', '=', DB::raw($satkerId));
            });
            $satkerName = DB::table('satker')->where('satker_id', $satkerId)->value('nama');
        }
        if ($selectedTahun) {
            $tukinMatangs->where('tahun', $selectedTahun);
        }

        if ($selectedBulan) {
            $tukinMatangs->where('bulan',$selectedBulan);
        }

        $tukinMatangs = $tukinMatangs
            ->orderBy('t_pegawai.satker_id')
            ->orderBy('t_pegawai.nama', 'asc')
            ->get();

        return view('admin.rekaptukin.filtered', compact('direktorats', 'years', 'tukinMatangs','satkerName'));
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
    public function show(Tukin $tukin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tukin $tukin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tukin $tukin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tukin $tukin)
    {
        //
    }
}
