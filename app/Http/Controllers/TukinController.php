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
