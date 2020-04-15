<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Penelitian;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pegawai = Pegawai::where('deleted_at', NULL)->get();
        $penelitian = Penelitian::where('deleted_at', NULL)->get();

        return view('kegiatan_penelitian', ['pegawai'=>$pegawai, 'penelitian'=>$penelitian]);
    }
}
