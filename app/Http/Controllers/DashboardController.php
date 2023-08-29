<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function chartData()
    {
        $pnsCount = Dashboard::where('status', 1)->count();
        $pendukungCount = Dashboard::where('status', 2)->count();
        $substansiCount = Dashboard::where('status', 3)->count();
        $kiCount = Dashboard::where('status', 4)->count();

        $data = [
            'pns' => $pnsCount,
            'pendukung' => $pendukungCount,
            'substansi' => $substansiCount,
            'ki' => $kiCount,
        ];

        return response()->json($data);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
