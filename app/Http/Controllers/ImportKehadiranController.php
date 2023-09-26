<?php

namespace App\Http\Controllers;
use App\Models\Import_kehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class ImportKehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $destinationFolder = scandir(resource_path('views/admin/import_pegawai/files'));
        $file = $request->file('file');

        $data = [];
        foreach ($destinationFolder as $row) {
            if ($row != '.' && $row != '..') {
                $data[] = [
                    'name' => explode('.', $row)[0],
                    'url' => asset('views/admin/import_pegawai/files/' .$row)
                ];
            }
        }
        return view('admin.import_pegawai.index', compact('data'));

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
        $file = $request->file('file');
        $fileName = time().rand(1,100).'.'.$file->extension();
        $file->move(resource_path('views/admin/import_pegawai/files'));
        return response()->json(['succes'=>$fileName]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Import_kehadiran $import_kehadiran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Import_kehadiran $import_kehadiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Import_kehadiran $import_kehadiran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Import_kehadiran $import_kehadiran)
    {
        //
    }
}
