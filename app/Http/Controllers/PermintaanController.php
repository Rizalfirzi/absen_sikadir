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
        // Pastikan izin memiliki st = 0
        if ($permintaan->st == 0) {
            return view('admin.konfirmasi_izin.edit', compact('izin'));
        } else {
            // Izin sudah dikonfirmasi
            return redirect()->route('konfirmasi.index')->with('status', [
                'type' => 'warning',
                'message' => 'Izin sudah dikonfirmasi sebelumnya.'
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function konfirmasi(Request $request, $nik, $nosurat)
    {
        // Tambahkan logika validasi dan konfirmasi di sini...

        // Perbarui status (st) izin dengan nosurat yang sama
        Izin::where('nosurat', $nosurat)->update(['st' => 1]);

        // Redirect kembali atau ke halaman yang diinginkan
        return redirect()->route('konfirmasi.index')->with('status', [
            'type' => 'success',
            'message' => 'Izin berhasil dikonfirmasi!'
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permintaan $permintaan)
    {
        //
    }

    public function delete(Request $request, $nik, $nosurat)
    {
        // Hapus data dari tabel 'izin' berdasarkan 'nik' dan 'nosurat'
        $deleted = DB::table('izin')->where('nik', $nik)->where('nosurat', $nosurat)->delete();
        return redirect()->route('konfirmasi.index')->with('success', 'Data berhasil dihapus.');
        // if ($deleted) {
        //     return "success";
        // } else {
        //     return "gagal";
        //      return redirect()->back()->with('error', 'Gagal menghapus data.');
        // }
    }

}
