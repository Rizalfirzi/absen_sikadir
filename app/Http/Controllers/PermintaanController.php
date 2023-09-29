<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\Satker;
use App\Models\Direktorat;
use App\Models\Permintaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
    public function show($nosurat)
    {
        // Menampilkan Document yang di pilih
        $documentPath = storage_path("app/public/uploaded/$nosurat");
            return response()->file($documentPath);
            // dd($documentPath);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($nik, $nosurat)
    {
        $permintaan = DB::table('izin')->where('nik', $nik)->where('nosurat', $nosurat)->first();

        return view('admin.konfirmasi_izin.edit', compact('permintaan'));

        // // Pastikan izin memiliki st = 0
        // if ($permintaan->st == 0) {
        //     return view('admin.konfirmasi_izin.edit', compact('employees'));
        // } else {
        //     // Izin sudah dikonfirmasi
        //     return redirect()->route('konfirmasi.index')->with('status', [
        //         'type' => 'warning',
        //         'message' => 'Izin sudah dikonfirmasi sebelumnya.'
        //     ]);
        // }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nik, $nosurat)
    {
        $deleteData = DB::table('izin')->where('nik', $nik)->where('nosurat', $nosurat);
        if($deleteData->delete()){
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
                Izin::where('nosurat', $nosurat)->create([
                    'nik'       => $request->input('nik'),
                    'tanggal'   => $currentDate,
                    'alasan'    => $request->input('alasan'),
                    'jenis'     => $request->input('jenis'),
                    'nosurat'   => $t, // Gunakan nama file saja, tanpa input
                    'deleted'   => $request->input('delete'),
                    'extensi'   => $file_ext,
                    'st'        => $request->input('st'),
                    'anak'      => $request->input('anak')
                ]);

                    // $izin = Izin::where('nosurat', $permintaan)->first();
                    // $izin->nik       = $request->input('nik');
                    // $izin->tanggal   = $currentDate;
                    // $izin->alasan    = $request->input('alasan');
                    // $izin->jenis     = $request->input('jenis');
                    // $izin->nosurat   = $t; // Gunakan nama file saja, tanpa input
                    // $izin->deleted   = $request->input('delete');
                    // $izin->extensi   = $file_ext;
                    // $izin->st        = $request->input('st');
                    // $izin->anak      = $request->input('anak');
                    // $izin->save();
                $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
            }

            // Storage::delete("public/uploaded/$nosurat");

            return redirect()->route('konfirmasi.index');
        } else {
            return "Gagal menghapus data.";
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($permintaan)
    {
        // $izin = Izin::where('nosurat', $permintaan)->first();
        // $izin->delete();

        // return redirect()->router('permintaan.update');
    }

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
