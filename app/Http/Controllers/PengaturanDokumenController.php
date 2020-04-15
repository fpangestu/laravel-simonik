<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Dokumen;
use App\Pegawai;

class PengaturanDokumenController extends Controller
{
    //
    public function index()
    {
        $pegawai = Pegawai::where('deleted_at', NULL)->get();
        $dokumen = Dokumen::all();
        $dokumen2 = Dokumen::onlyTrashed()->get();

        return view('pengaturan.pengaturan_dokumen', ['dokumen'=>$dokumen, 'pegawai'=>$pegawai, 'dokumen2'=>$dokumen2]);
    }

    public function tambah(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');

        //dd($request->all());
        $dokumen = Dokumen::where('deleted_at', NULL)->orderBy('kode_dokumen', 'DESC')->first();
        $dokumen_hapus = Dokumen::onlyTrashed()->orderBy('kode_dokumen', 'DESC')->first();

        if($dokumen == NULL && $dokumen_hapus == NULL){
            $kode = "01";
            
            $validatedData = $request->validate([
                'dokumen_baru' => 'required|string|max:100|min:3',
            ]);

            //Insert Data ke Table Penelitian
            DB::table('dokumens')->insert([
                'kode_dokumen' => $kode,
                'nama_dokumen' => $request->dokumen_baru,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            //dd((int)$dokumen_hapus->kode_dokumen);
            if($dokumen == NULL){
                $kode = $dokumen_hapus->kode_dokumen;
            } else if ($dokumen_hapus == NULL){
                $kode = $dokumen->kode_dokumen;
            }else if(((int)$dokumen->kode_dokumen) > ((int)$dokumen_hapus->kode_dokumen)){
                $kode = $dokumen->kode_dokumen;
            } else {
                $kode = $dokumen_hapus->kode_dokumen;
            }

            $kode = (int)$kode + 1;
            if($kode < 9){
                $kode = "0".(string)$kode ;
            } else {
                $kode = (string)$kode;
            }

            //Insert Data ke Table Penelitian
            DB::table('dokumens')->insert([
                'kode_dokumen' => $kode,
                'nama_dokumen' => $request->dokumen_baru,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }

        return redirect('/pengaturan/dokumen')->withErrors([$kode]);
    }

    public function editdata(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $dokumen = Dokumen::where('kode_dokumen', $request->kode_dokumen_edit)->get();


        $validatedData = $request->validate([
            'nama_dokumen_edit' => 'required|string|max:100|min:3',
        ]);

        //Update Data ke Table Pegawais
        DB::table('dokumens')->where('kode_dokumen',$request->kode_dokumen_edit)->update([
            'kode_dokumen' => $request->kode_dokumen_edit,
            'nama_dokumen' => $request->nama_dokumen_edit,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
            
        //Cek Status
        if($request->status_akun[0] == 2){
            $dokumen_hapus = Dokumen::where('kode_dokumen', $request->kode_dokumen_edit)->delete();
        }
        return redirect('/pengaturan/dokumen');
    }

    public function restore (Request $request){
        //dd($request->all());
        if($request->status_akun[0] == 1){
            $dokumen = Dokumen::onlyTrashed()->where('kode_dokumen', $request->kode_dokumen_edit)->restore();
        }
        
        return redirect('/pengaturan/dokumen');
    }
}
