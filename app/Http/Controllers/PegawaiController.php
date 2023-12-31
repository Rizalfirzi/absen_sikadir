<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Direktorat;
use App\Models\Satker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $direktorats = Direktorat::all();
        $pegawai = DB::table('t_pegawai')
            ->select('t_pegawai.id', 't_pegawai.badgenumber', 't_pegawai.nama', 't_pegawai.nip', 't_pegawai.jabatan', 't_pegawai.gradejabatan', 't_pegawai.golongan_ruang', 't_pegawai.satker', 't_pegawai.unitkerjalama', 't_pegawai.provinsi', 't_pegawai.direktorat_id', 't_pegawai.satker_id', 't_pegawai.ppk_id', 't_pegawai.status', 't_pegawai.aktif', 't_pegawai.badgenumber_baru', 't_pegawai.badge_on', 'direktorat.direktorat as nama_direktorat', 'satker.nama as nama_satker')
            ->leftJoin('direktorat', 't_pegawai.direktorat_id', '=', 'direktorat.direktorat_id')
            ->leftJoin('satker', function ($join) {
                $join->on('t_pegawai.satker_id', '=', 'satker.satker_id')->orWhere('t_pegawai.ppk_id', '=', DB::raw('satker.satker_id'));
            })
            ->where('t_pegawai.status', 1)
            ->where('t_pegawai.aktif', 'Aktif')
            ->orderBy('t_pegawai.satker_id')
            ->orderBy('t_pegawai.nama', 'asc')
            ->get();

        $hargajabatan = DB::table('harga_jabatan')
            ->select('harga_jabatan.peringkat_jabatan as grade', 'harga_jabatan.harga_jabatan as harga')
            ->orderBy('harga_jabatan.peringkat_jabatan')
            ->get();

        $golongan = DB::table('golongan')
            ->select('golongan.golongan', 'golongan.tingkat', 'golongan.pangkat', 'golongan.bagian')
            ->orderBy('golongan.id')
            ->get();

        return view('admin.pegawai.index', compact('direktorats', 'pegawai', 'hargajabatan', 'golongan'));
    }

    public function getSatker($direktoratId)
    {
        $satkers = Satker::where('direktorat_id', $direktoratId)->get();

        return response()->json($satkers);
    }
    
    public function getSatkerByDirektorat($direktoratId)
    {
        $satkers = Satker::where('direktorat_id', $direktoratId)
            ->whereNotNull('prop')
            ->orderBy('nama', 'asc')
            ->get();

        return response()->json($satkers);
    }

    public function getPpkByDirektorat($direktoratId)
    {
        $ppk = Satker::where('direktorat_id', $direktoratId)
            ->whereNull('prop')
            ->get();

        return response()->json($ppk);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $direktorats = DB::table('direktorat')->get();
        // $golongans = DB::table('golongan')->get();
        // $hargaJabatans = DB::table('harga_jabatan')->get();

        $hargaJabatans = DB::table('harga_jabatan')
            ->select('harga_jabatan.peringkat_jabatan as grade', 'harga_jabatan.harga_jabatan as harga')
            ->orderBy('harga_jabatan.peringkat_jabatan')
            ->get();

        $golongans = DB::table('golongan')
            ->select('golongan.golongan', 'golongan.tingkat', 'golongan.pangkat', 'golongan.bagian')
            ->orderBy('golongan.id')
            ->get();

        return view('admin.pegawai.create', compact('direktorats', 'golongans', 'hargaJabatans'));
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
    public function show(pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang dikirimkan dari frontend jika perlu
        $request->validate([
            'badgenumber' => 'required',
            'badgenumber_baru' => 'required',
            'nama' => 'required',
            'nip' => 'required',
            'golonganRuang' => 'required',
            'jabatan' => 'required',
            'gradeJabatan' => 'required',
            'direktorat' => 'required',
            'satker' => 'required',
            'ppk' => 'required',
            'status' => 'required',
            'aktif' => 'required',
        ]);

        // Ambil data pegawai berdasarkan ID
        $pegawai = Pegawai::find($id);

        // Update data pegawai dengan data baru
        $pegawai->badgenumber = $request->badgenumber;
        $pegawai->badgenumber_baru = $request->badgenumber_baru;
        $pegawai->nama = $request->nama;
        $pegawai->nip = $request->nip;
        $pegawai->golonganRuang = $request->golonganRuang;
        $pegawai->jabatan = $request->jabatan;
        $pegawai->gradeJabatan = $request->gradeJabatan;
        $pegawai->direktorat = $request->direktorat;
        $pegawai->satker = $request->satker;
        $pegawai->ppk = $request->ppk;
        $pegawai->status = $request->status;
        $pegawai->aktif = $request->aktif;

        // Simpan perubahan
        $pegawai->save();

        // Beri respons kepada frontend
        return response()->json(['message' => 'Data pegawai berhasil diperbarui']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pegawai $pegawai)
    {
        //
    }
}
