<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pegawai;
use App\AgendaKegiatan;
use App\Dokumen;
use App\DokumenKegiatan;

class PengaturanAgendaKegiatanController extends Controller
{
    //
    public function index()
    {
        $pegawai = Pegawai::where('deleted_at', NULL)->get();
        $dokumen = Dokumen::where('deleted_at', NULL)->get();
        $dokumenkegiatan = DokumenKegiatan::where('deleted_at', NULL)->get();
        $kegiatan = AgendaKegiatan::all();
        $kegiatan2 = AgendaKegiatan::onlyTrashed()->get();

        return view('pengaturan.pengaturan_kegiatan', ['dokumenkegiatan'=>$dokumenkegiatan, 'dokumen'=>$dokumen, 'kegiatan'=>$kegiatan, 'pegawai'=>$pegawai, 'kegiatan2'=>$kegiatan2]);
    }

    public function tambah(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        //dd($request->all());
        $kegiatan = AgendaKegiatan::where('deleted_at', NULL)->orderBy('kode_agenda', 'DESC')->first();
        $kegiatan_hapus = AgendaKegiatan::onlyTrashed()->orderBy('kode_agenda', 'DESC')->first();

        if($kegiatan == NULL && $kegiatan_hapus == NULL){
            $kode = "01";
            
            $validatedData = $request->validate([
                'kegiatan_baru' => 'required|string|max:100|min:3',
            ]);

            //Insert Data ke Table Agenda
            DB::table('agenda_kegiatans')->insert([
                'kode_agenda' => $kode,
                'nama_agenda' => $request->kegiatan_baru,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            //dd((int)$dokumen_hapus->kode_dokumen);
            if($kegiatan == NULL){
                $kode = $kegiatan_hapus->kode_agenda;
            } else if ($kegiatan_hapus == NULL){
                $kode = $kegiatan->kode_agenda;
            }else if(((int)$kegiatan->kode_agenda) > ((int)$kegiatan_hapus->kode_agenda)){
                $kode = $kegiatan->kode_agenda;
            } else {
                $kode = $kegiatan_hapus->kode_agenda;
            }

            $kode = (int)$kode + 1;
            if($kode < 9){
                $kode = "0".(string)$kode ;
            } else {
                $kode = (string)$kode;
            }

            //Insert Data ke Table Agenda
            DB::table('agenda_kegiatans')->insert([
                'kode_agenda' => $kode,
                'nama_agenda' => $request->kegiatan_baru,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect('/pengaturan/kegiatan')->withErrors([$kode]);
    }

    public function editdata(Request $request)
    {
        //dd($request->all());
        date_default_timezone_set('Asia/Jakarta');
        $kegiatan = AgendaKegiatan::where('kode_agenda', $request->kode_agenda_edit)->get();


        $validatedData = $request->validate([
            'nama_agenda_edit' => 'required|string|max:100|min:3',
        ]);

        //Update Data ke Table Pegawais
        DB::table('agenda_kegiatans')->where('kode_agenda',$request->kode_agenda_edit)->update([
            'nama_agenda' => $request->nama_agenda_edit,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
            
        //Cek Status
        if($request->status_akun[0] == 2){
            $agenda_hapus = AgendaKegiatan::where('kode_agenda', $request->kode_agenda_edit)->delete();
        }
        return redirect('/pengaturan/kegiatan');
    }

    public function restore (Request $request){
        //dd($request->all());
        if($request->status_akun[0] == 1){
            $agenda = AgendaKegiatan::onlyTrashed()->where('kode_agenda', $request->kode_agenda_edit)->restore();
        }
        
        return redirect('/pengaturan/kegiatan');
    }
}
