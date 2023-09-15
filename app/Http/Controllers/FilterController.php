<?php

namespace App\Http\Controllers;

use App\Models\Tukin;
use App\Models\Direktorat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    public function filterPegawai(Request $request)
    {
        $satkerId = $request->input('satker');
        $aktif = $request->input('aktif');
        $direktoratId = $request->input('direktorat');

        $direktorats = DB::table('direktorat')->get();

        $pegawaiQuery = DB::table('t_pegawai')
            ->select('t_pegawai.*', 'direktorat.direktorat as nama_direktorat', 'satker.nama as nama_satker')
            ->leftJoin('direktorat', 't_pegawai.direktorat_id', '=', 'direktorat.direktorat_id')
            ->leftJoin('satker', function ($join) {
                $join->on('t_pegawai.satker_id', '=', 'satker.satker_id')->orWhere('t_pegawai.ppk_id', '=', DB::raw('satker.satker_id'));
            })
            ->where('t_pegawai.status', 1);

        if ($direktoratId) {
            $pegawaiQuery->where(function ($query) use ($direktoratId) {
                $query->where('t_pegawai.direktorat_id', $direktoratId)->orWhere('t_pegawai.ppk_id', '=', DB::raw($direktoratId));
            });
        }

        if ($aktif) {
            $pegawaiQuery->where('t_pegawai.aktif', $aktif);
        }

        if ($satkerId) {
            $pegawaiQuery->where(function ($query) use ($satkerId) {
                $query->where('t_pegawai.satker_id', $satkerId)->orWhere('t_pegawai.ppk_id', '=', DB::raw($satkerId));
            });
        }

        $pegawai = $pegawaiQuery
            ->orderBy('t_pegawai.satker_id')
            ->orderBy('t_pegawai.nip')
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
        // dd($pegawai);
        // dd($pegawaiQuery->toSql());
        return view('admin.pegawai.filtered', compact('pegawai', 'direktorats','hargajabatan','golongan'));
    }

    public function filterIzin(Request $request)
    {
        $satkerId = $request->input('satker');
        $direktoratId = $request->input('direktorat');
        $tipePegawai = $request->input('tipe_pegawai');
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        $direktorats = Direktorat::all();

        $filteredData = DB::table('t_pegawai')
            ->join('izin', 't_pegawai.nip', '=', 'izin.nik')
            ->where(function ($query) use ($satkerId, $tipePegawai, $awal, $akhir) {
                $query
                    ->where('t_pegawai.satker_id', $satkerId)
                    ->where('t_pegawai.status', $tipePegawai)
                    ->whereBetween('izin.tanggal', [$awal, $akhir])
                    ->where('izin.st', '1')
                    ->where('izin.deleted', '0');
            })
            ->orWhere(function ($query) use ($satkerId, $tipePegawai, $awal, $akhir) {
                $query
                    ->where('t_pegawai.ppk_id', $satkerId)
                    ->where('t_pegawai.status', $tipePegawai)
                    ->whereBetween('izin.tanggal', [$awal, $akhir])
                    ->where('izin.st', '1')
                    ->where('izin.deleted', '0');
            });

        $satkerName = '';

        if ($satkerId) {
            if ($satkerId === 'all') {
                $filteredData->whereNotNull('t_pegawai.satker_id');
                $satkerName = 'All Satker';
            } else {
                $filteredData->where(function ($query) use ($satkerId) {
                    $query->where('t_pegawai.satker_id', $satkerId);
                });
                $satker = DB::table('satker')
                    ->where('satker_id', $satkerId)
                    ->first();

                if ($satker) {
                    $satkerName = $satker->nama;
                } else {
                    // Handle jika satker tidak ditemukan
                    $satkerName = 'Unknown Satker';
                }
            }
        } else {
            // Tidak ada satker yang dipilih, jadi atur untuk menampilkan semua satker
            $filteredData->whereNotNull('t_pegawai.satker_id');
            $satkerName = 'All Satker';
        }

        $filteredData = $filteredData
            ->orderBy('t_pegawai.nama', 'asc')
            ->select('izin.nik', 'izin.tanggal', 'izin.jenis', 'izin.nosurat', 'izin.alasan', 't_pegawai.nama')
            ->get();

        return view('admin.izin.filtered', compact('filteredData', 'direktorats', 'satkerName'));
    }

    public function filterLiburlokal(Request $request)
    {
        $satkerId = $request->input('satker');
        $direktoratId = $request->input('direktorat');

        $direktorats = DB::table('direktorat')->get();

        $liburLokal = DB::table('liburlokal')
            ->select('liburlokal.kdliburlokal as kdliburlokal', 'liburlokal.tanggal as tanggal',
                     'liburlokal.keterangan as keterangan', 'liburlokal.kdunitkerja as kdunitkerja',
                     'satker.nama as nama_satker')
            ->leftJoin('satker', 'liburlokal.kdunitkerja', '=', DB::raw('CAST(satker.satker_id AS VARCHAR)'));

        if ($direktoratId) {
            $liburLokal->where(function ($query) use ($direktoratId) {
                $query->where('satker.direktorat_id', $direktoratId);
            });
        }

        $liburLokals = $liburLokal->orderBy('kdunitkerja')->get();

        // dd($liburLokals);
        return view('admin.liburlokal.filtered', compact('libur','liburLokals', 'direktorats', 'satkerId'));
    }

    public function filterPermintaan(Request $request)
    {
        $satkerId = $request->input('satker');
        $direktoratId = $request->input('direktorat');
        $tipePegawai = $request->input('tipe_pegawai');

        $direktorats = Direktorat::all();

        $filteredData = DB::table('t_pegawai')
            ->join('izin', 't_pegawai.nip', '=', 'izin.nik')
            ->where(function ($query) use ($satkerId, $tipePegawai) {
                $query
                    ->where('t_pegawai.satker_id', $satkerId)
                    ->where('t_pegawai.status', $tipePegawai)
                    ->where('izin.st', '0')
                    ->where('izin.deleted', '0');
            })
            ->orWhere(function ($query) use ($satkerId, $tipePegawai) {
                $query
                    ->where('t_pegawai.ppk_id', $satkerId)
                    ->where('t_pegawai.status', $tipePegawai)
                    ->where('izin.st', '0')
                    ->where('izin.deleted', '0');
            });

        $satkerName = '';

        if ($satkerId) {
            if ($satkerId === 'all') {
                $filteredData->whereNotNull('t_pegawai.satker_id');
                $satkerName = 'All Satker';
            } else {
                $filteredData->where(function ($query) use ($satkerId) {
                    $query->where('t_pegawai.satker_id', $satkerId);
                });
                $satker = DB::table('satker')
                    ->where('satker_id', $satkerId)
                    ->first();

                if ($satker) {
                    $satkerName = $satker->nama;
                } else {
                    // Handle jika satker tidak ditemukan
                    $satkerName = 'Unknown Satker';
                }
            }
        } else {
            // Tidak ada satker yang dipilih, jadi atur untuk menampilkan semua satker
            $filteredData->whereNotNull('t_pegawai.satker_id');
            $satkerName = 'All Satker';
        }

        $filtered = $filteredData
            ->orderBy('t_pegawai.nama', 'asc')
            ->select('izin.nik', 'izin.tanggal', 'izin.jenis', 'izin.nosurat', 'izin.alasan', 't_pegawai.nama')
            ->get();

        return view('admin.konfirmasi_izin.filtered', compact('filtered', 'direktorats', 'satkerName'));
    }

    public function filterSkp(Request $request)
    {
        $currentYear = date('Y');
        $startYear = 2015;
        $endYear = $currentYear - 1;
        $years = [];

        for ($year = $startYear; $year <= $endYear; $year++) {
            $years[] = $year;
        }
        $direktoratId = $request->input('direktorat');
        $satkerId = $request->input('satker');
        $tahun = $request->input('tahun');

        $direktorats = DB::table('direktorat')->get(); // Menggunakan \Illuminate\Support\Facades\DB
        $satkerOptions = [];

        $query = DB::table('skp')
            ->join('t_pegawai', 'skp.nip', '=', 't_pegawai.nip')
            ->join('satker', function ($join) {
                $join->on('t_pegawai.satker_id', '=', 'satker.satker_id')->orOn('t_pegawai.ppk_id', '=', DB::raw('satker.satker_id')); // Menggunakan DB::raw()
            })
            ->where('t_pegawai.status', 1);

        if ($tahun) {
            $query->where('skp.tahun', $tahun);
        }

        if ($direktoratId) {
            $satkerOptions = DB::table('satker')
                ->where('direktorat_id', $direktoratId)
                ->get();
            $query->where('t_pegawai.direktorat_id', $direktoratId);
        }

        if ($satkerId) {
            $query->where('t_pegawai.satker_id', $satkerId);
        }

        $query
            ->orderBy('skp.tahun', 'asc')
            ->orderBy('t_pegawai.nama', 'asc');

        $results = $query
            ->select('skp.id', 'skp.nip', 'skp.nilai', 'skp.persentase', 'skp.tahun', 't_pegawai.nama as nama_pegawai', 'satker.nama as nama_satker')
            ->distinct('t_pegawai.nama','skp.tahun', 'skp.nip')
            ->get();

        return view('admin.skp.filtered', compact('results', 'direktorats', 'satkerOptions', 'years'));
    }

    public function filterTukin(Request $request)
    {
        $direktoratId = $request->input('direktorat');
        $satkerId = $request->input('satker');
        $selectedTahun = $request->input('tahun');
        $selectedBulan = $request->input('bulan');

        $currentYear = date('Y');
        $startYear = 2016;
        $endYear = 2027;
        $years = range($startYear, $endYear);

        $direktorats = DB::table('direktorat')->get();

        $tukinMatangs = Tukin::select(
            't_pegawai.nip',
            't_pegawai.nama',
            'satker.nama AS nama_satker',
            't_tukin_matang.gradejabatan',
            'harga_jabatan.harga_jabatan',
            't_tukin_matang.skp_persentase',
            't_tukin_matang.tukin_dasar',
            't_tukin_matang.tukin_terima',
            't_tukin_matang.cuti_besar',
            't_tukin_matang.cuti_besar_pot',
            't_tukin_matang.cuti_penting',
            't_tukin_matang.cuti_penting_pot',
            't_tukin_matang.cuti_lahir',
            't_tukin_matang.cuti_lahir_pot',
            't_tukin_matang.tubel',
            't_tukin_matang.tubel_pot',
            't_tukin_matang.izin',
            't_tukin_matang.izin_pot',
            't_tukin_matang.tk',
            't_tukin_matang.tk_pot',
            't_tukin_matang.telat_tl',
            't_tukin_matang.psw',
            't_tukin_matang.total_kjk',
            't_tukin_matang.kjk_pot',
            't_tukin_matang.bulan',
            't_tukin_matang.tahun',
            't_tukin_matang.tot_potongan'

        )
        ->join('t_pegawai', 't_pegawai.nip','=','t_tukin_matang.nip')
        ->leftJoin('harga_jabatan', 't_pegawai.gradejabatan', '=', 'harga_jabatan.peringkat_jabatan')
        ->leftJoin('satker', 't_pegawai.satker_id', '=', 'satker.satker_id');

        if ($direktoratId) {
            $tukinMatangs->where(function ($query) use ($direktoratId) {
                $query->where('t_pegawai.direktorat_id', $direktoratId)->orWhere('t_pegawai.ppk_id', '=', DB::raw($direktoratId));
            });
        }
        if ($satkerId) {
            $tukinMatangs->where(function ($query) use ($satkerId) {
                $query->where('t_pegawai.satker_id', $satkerId)->orWhere('t_pegawai.ppk_id', '=', DB::raw($satkerId));
            });
            // $satkerName = DB::table('satker')->where('satker_id', $satkerId)->value('nama');
        }
        if ($selectedTahun) {
            $tukinMatangs->where('tahun', $selectedTahun);
        }

        if ($selectedBulan) {
            $tukinMatangs->where('bulan',$selectedBulan);
        }

        $tukinMatangs = $tukinMatangs
            ->orderBy('t_pegawai.satker_id')
            ->orderBy('t_pegawai.nama', 'asc')
            ->get();

        return view('admin.rekaptukin.filtered', compact('direktorats', 'years', 'tukinMatangs'));
    }
}
