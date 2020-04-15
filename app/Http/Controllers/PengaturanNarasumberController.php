<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Narasumber;
use App\Pegawai;

class PengaturanNarasumberController extends Controller
{
    //
    public function index()
    {
        $pegawai = Pegawai::where('deleted_at', NULL)->get();
        $narasumber = Narasumber::where('deleted_at', NULL)->get();

        return view('pengaturan.pengaturan_narasumber', ['narasumber'=>$narasumber, 'pegawai'=>$pegawai]);
    }
}
