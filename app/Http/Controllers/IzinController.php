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
            'delete'    => 'required',
            'st'        => 'required',
            'anak'      => 'required',
            'file'      => 'required|file|mimes:png,jpg,pdf'
        ]);

        // Validasi file
        $file_ext = $request->file('file')->getClientOriginalExtension(); // Ekstensi file
        $t = time(); // Nosurat (spesial namafile)
        $nmFile = $t . '.' . $file_ext;
        $request->file('file')->storeAs('public/uploaded', $nmFile);

        // Validasi untuk tanggal
        $startDate = $request->input('awal');
        $endDate = $request->input('akhir');

        $currentDate = $startDate;

        // Membuat instance model dengan data yang akan disimpan
        while ($currentDate <= $endDate) {
            Izin::create([
                'nik'       => $request->input('nip'),
                'tanggal'   => $currentDate,
                'alasan'    => $request->input('alasan'),
                'jenis'     => $request->input('jenis'),
                'nosurat'   => $t, // Gunakan nama file saja, tanpa input
                'deleted'   => $request->input('delete'),
                'extensi'   => $file_ext,
                'st'        => $request->input('st'),
                'anak'      => $request->input('anak')
            ]);

            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        return redirect()->route('izin.index');
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
