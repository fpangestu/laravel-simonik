<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Penelitian;
use App\KegiatanPenelitian;
use App\TimPenelitii;
use App\TimelinePenelitian;

class KegiatanPenelitianController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::where('deleted_at', NULL)->get();
        $penelitian = Penelitian::where('deleted_at', NULL)->get();
        $kegiatanPenelitian = KegiatanPenelitian::where('deleted_at', NULL)->get();
        $timPenelitian = TimPenelitii::where('deleted_at', NULL)->get();
        $timelinePenelitian = TimelinePenelitian::where('deleted_at', NULL)->get();

        return view('kegiatan_penelitian', ['timelinePenelitian'=>$timelinePenelitian, 'timPenelitian'=>$timPenelitian, 'kegiatanPenelitian'=>$kegiatanPenelitian, 'pegawai'=>$pegawai, 'penelitian'=>$penelitian]);
    }
}
