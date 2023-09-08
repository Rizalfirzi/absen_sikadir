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
        $employees = DB::table('t_pegawai')
            ->select('nip', 'nama')
            ->where('aktif', '=', 'Aktif')
            ->where('status', '=', '1')
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.izin.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Membuat validasi data
        $request->validate([
            'nip'       => 'required',
            'awal'      => 'required|date',
            'akhir'     => 'required|date|after_or_equal:awal',
            'jenis'     => 'required',
            'alasan'    => 'required',
            'file'      => 'required|file|mimes:png,jpg,pdf'
        ]);

        // Validasi file
        $file_name = $request->file('file')->getClientOriginalName(); // Nama file beserta ekstensi
        $file_ext = $request->file('file')->getClientOriginalExtension(); // Ekstensi file

        // Validasi untuk tanggal
        $now = 'awal';
        $akhir = date('Y-m-d', strtotime('akhir' . ' +1 day')); // Tambahkan satu hari untuk mencakup tanggal akhir

        // Membuat instance model dengan data yang akan disimpan
        while ($now < $akhir) {
            Izin::create([
                'nik'       => $request->input('nip'),
                'tanggal'   => $request->input($now),
                    $now = date('Y-m-d', strtotime($now . ' +1 day')),
                'alasan'    => $request->input('alasan'),
                'jenis'     => $request->input('jenis'),
                'nosurat'   => $request->input($file_name),
                'deleted'   => '0',
                'extensi'   => $request->input($file_ext),
                'st'        => '0',
                'anak'      => '0'
            ]);
        }

        return redirect()
                ->route('izin.index')
                ->with('success', 'Permintaan Berhasil Terkirim');
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
