<?php

namespace App\Http\Controllers;

use App\Models\ArsipTukin;
use App\Models\Direktorat;
use App\Models\Satker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArsipTukinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentYear = date('Y');
        $startYear = 2020;
        $years = [];

        for ($year = $startYear; $year <= $currentYear; $year++) {
            $years[] = $year;
        }


        $direktorats = Direktorat::all();

        $arsips = DB::table('arsip')
            ->select('arsip.id', 'arsip.direktorat_id', 'arsip.bulan', 'arsip.tahun', 'arsip.file_dok', 'arsip.jenis', 'direktorat.direktorat as nama_direktorat')
            ->leftJoin('direktorat', 'arsip.direktorat_id', '=', 'direktorat.direktorat_id')
            ->get();

        foreach ($arsips as $arsip) {
            $bulanAngka = $arsip->bulan;
            $namaBulan = date('F', mktime(0, 0, 0, $bulanAngka, 1)) ;
            $arsip->nama_bulan = $namaBulan;
        }

        return view('admin.arsiptukin.index', compact('direktorats', 'years', 'arsips'));
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
        return view('admin.arsiptukin.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,jpg,png,pdf|max:2048',
            'direktorat_id' => 'required',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('arsip'), $fileName);

            DB::table('arsip')->insert([
                'direktorat_id' => $request->input('direktorat_id'),
                'satker_id' => $request->input('satker'),
                'bulan' => $request->input('bulan'),
                'tahun' => $request->input('tahun'),
                'file_dok' => $fileName,
                'jenis' => 'tukin',
            ]);

            return redirect()->route('arsiptukin.index')->with('success', 'Berhasil Upload.');
        }

        return back()->withErrors(['error' => 'Terjadi kesalahan saat mengunggah file.']);

    }

    /**
     * Display the specified resource.
     */
    public function show(ArsipTukin $arsipTukin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArsipTukin $arsipTukin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArsipTukin $arsipTukin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArsipTukin $arsipTukin ,$id)
    {
        $data= DB::table('arsip')->where('id',$id);
        $data->delete();
        return redirect('arsiptukin');
    }
}
