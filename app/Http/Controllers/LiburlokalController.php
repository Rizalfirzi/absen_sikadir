<?php

namespace App\Http\Controllers;

use App\Models\Liburlokal;
use Illuminate\Http\Request;
use App\Models\Direktorat;
use App\Models\Satker;
use Illuminate\Support\Facades\DB;

class LiburlokalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $direktorats = Direktorat::all();
        return view('admin.liburlokal.index', compact('direktorats'));
    }

    public function getSatker($direktoratId)
    {
        $satkers = Satker::where('direktorat_id', $direktoratId)->get();

        return response()->json($satkers);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function filter(Request $request)
    {
        $satkerId = $request->input('satker');
        $direktoratId = $request->input('direktorat');

        $direktorats = DB::table('direktorat')->get();

        $liburLokal = DB::table('liburlokal')
            ->select('liburlokal.*', 'satker.nama as nama_satker')
            ->leftJoin('satker', 'liburlokal.kdunitkerja', '=', DB::raw('CAST(satker.satker_id AS VARCHAR)'));

        if ($direktoratId) {
            $liburLokal->where(function ($query) use ($direktoratId) {
                $query->where('satker.direktorat_id', $direktoratId);
            });
        }

        $satkerName = ''; // Initialize $satkerName

        if ($satkerId) {
            if ($satkerId === 'all') {
                $liburLokal->whereNotNull('liburlokal.kdunitkerja');
                $satkerName = 'All Satker';
            } else {
                $liburLokal->where(function ($query) use ($satkerId) {
                    $query->where('liburlokal.kdunitkerja', $satkerId);
                });
                $satkerName = DB::table('satker')
                    ->where('satker_id', $satkerId)
                    ->value('nama');
            }
        }

        $liburLokals = $liburLokal->orderBy('liburlokal.tanggal')->get();
        // dd($liburLokals);
        return view('admin.liburlokal.filtered', compact('liburLokals', 'satkerName', 'direktorats'));
    }
    public function create()
    {
        //
        $direktorats = Direktorat::all();
        return view('admin.liburlokal.create', compact('direktorats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'kdunitkerja' => 'required',
            'keterangan' => 'required',
        ]);

        Liburlokal::create($validatedData);

        return redirect()
            ->route('liburlokal.index')
            ->with('success', 'Data libur berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Liburlokal $liburlokal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Liburlokal $liburlokal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Liburlokal $liburlokal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Liburlokal $liburlokal)
    {
        //
    }
}
