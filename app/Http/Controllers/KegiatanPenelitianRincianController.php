<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Penelitian;
use App\Pegawai;
use App\TimelinePenelitian;
use App\KegiatanPenelitian;

class KegiatanPenelitianRincianController extends Controller
{
    public function index(Request $request){
        //-----WAJIB
        $pegawai = Pegawai::where('deleted_at', NULL)->get();
        //WAJIB-----

        $penelitian = Penelitian::where('kode_penelitian', '=', $request->id)
                                ->where(function ($query) {
                                    $query->whereNull('deleted_at');
                                })
                                ->get();
        $timelinePenelitian = TimelinePenelitian::where('deleted_at', NULL)->get();

        $KegiatanPenelitianAll = KegiatanPenelitian::join('timeline_penelitians', 'kegiatan_penelitians.kode_agenda', '=', 'timeline_penelitians.kode_agenda')
                                ->select('kegiatan_penelitians.*')
                                ->where('timeline_penelitians.kode_penelitian', '=', $request->id)
                                ->where(function ($query) {
                                    $query->whereNull('kegiatan_penelitians.deleted_at');
                                })
                                ->get();

        return view('kegiatan_penelitian_rincian', ['timelinePenelitian'=>$timelinePenelitian, 'pegawai'=>$pegawai, 'penelitian'=>$penelitian]);
    }
}
