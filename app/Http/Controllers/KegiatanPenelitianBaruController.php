<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pegawai;
use App\Penelitian;
use App\PeranPenelitian;
use App\TimPenelitii;
use App\AgendaKegiatan;
use App\TimelinePenelitian;

class KegiatanPenelitianBaruController extends Controller
{
    public function index(){
        $pegawai = Pegawai::where('deleted_at', NULL)
                    ->orderBy('nama', 'asc')
                    ->get();
        $penelitian = Penelitian::where('deleted_at', NULL)->get();
        $peranPeneliti = PeranPenelitian::where('deleted_at', NULL)->get();
        $agendaKegiatan = AgendaKegiatan::where('deleted_at', NULL)->get();

        return view('kegiatan_penelitian_baru', ['pegawai'=>$pegawai, 'penelitian'=>$penelitian, 'peranPeneliti'=>$peranPeneliti, 'agendaKegiatan'=>$agendaKegiatan]);
    }

    public function tambah(Request $request){
        $startDate = date_create_from_format('m/d/Y', substr ($request->reservation, 0,10));
        $endDate = date_create_from_format('m/d/Y', substr ($request->reservation, -10));

        // //Validasi Data
        // $validatedData = $request->validate([
        //     'kode_penelitian' => 'required|unique:posts|max:255',
        //     'judul_penelitian' => 'required',
        //     'tgl_mulai' => 'required',
        //     'tgl_selesai' => 'required',
        // ]);
        
        //Insert Data ke Table Penelitian
        DB::table('penelitians')->insert([
            'kode_penelitian' => $request->kodePenelitian,
            'judul_penelitian' => $request->namaPenelitian,
            'tgl_mulai' => $startDate,
            'tgl_selesai' => $endDate
        ]);

        //Insert Data ke Table Tim Peneliti
        for ($i = 0; $i < count($request->namaTim); $i++) {
            DB::table('tim_penelitiis')->insert([
                'nip' => $request->namaTim[$i],
                'kode_penelitian' => $request->kodePenelitian,
                'id_peran' => $request->peranPegawai[$i]
            ]);
        }

        //Insert Data ke Table Kegiatan Penelitian
        $urutan=0;
        for ($i = 0; $i < count($request->namaAgenda); $i++) {
            $startDate = date_create_from_format('m/d/Y', substr ($request->reservation2[$i], 0,10));
            $endDate = date_create_from_format('m/d/Y', substr ($request->reservation2[$i], -10));
            $kodeAgenda = $request->kodePenelitian . "_" . $request->kodeKegiatan[$i];

            DB::table('timeline_penelitians')->insert([
                'kode_penelitian' => $request->kodePenelitian,
                'kode_agenda'=>$kodeAgenda,
                'agenda'=> $request->namaAgenda[$i],
                'urutan'=>$urutan++,
                'tgl_mulai' => $startDate,
                'tgl_selesai' => $endDate
            ]);
        }
        
        // alihkan halaman ke halaman pegawai
        return redirect('/kegiatan_penelitian');
    }
}
