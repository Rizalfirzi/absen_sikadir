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
    try {
        // Validasi data yang dikirimkan melalui formulir
        $validatedData = $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'tanggal' => 'required',
            'jenis' => 'required',
            'nosurat' => 'required',
            'alasan' => 'required',
        ]);

        // Simpan data izin baru ke dalam tabel 'izin'
        Izin::create($validatedData);

        // Redirect ke halaman yang sesuai setelah penyimpanan sukses
        return redirect()->route('konfirmasi.index')->with('status', [
            'type' => 'success',
            'message' => 'Data izin baru berhasil disimpan!'
        ]);
    } catch (\Exception $e) {
        // Tangani kesalahan jika ada, misalnya validasi gagal atau kesalahan database
        return redirect()->back()->with('status', [
            'type' => 'error',
            'message' => 'Terjadi kesalahan saat menyimpan data izin: ' . $e->getMessage()
        ]);
    }
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
