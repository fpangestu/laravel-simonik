<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pegawai;

class PengaturanPegawaiController extends Controller
{
    //
    public function index()
    {
        $pegawai = Pegawai::all();
        $pegawai2 = Pegawai::onlyTrashed()->get();

        return view('pengaturan.pengaturan_pegawai', ['pegawai'=>$pegawai, 'pegawai2'=>$pegawai2]);
    }

    public function tambah(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $pegawai = Pegawai::where('nip', $request->nip_baru)->get();
        $pegawai_hapus = Pegawai::onlyTrashed('nip', $request->nip_baru)->get();
        $pegawai2 = Pegawai::where('nip', $request->email_baru)->get();
        $pegawai2_hapus = Pegawai::onlyTrashed('nip', $request->email_baru)->get();


         // Validasi NIP
        if(count($pegawai)>0 || count($pegawai_hapus)>0){
            return redirect('/pengaturan/pegawai')->withErrors(['NIP Sudah Terdaftar']);
        } else if(count($pegawai2)>0 || count($pegawai2_hapus)>0){
            return redirect('/pengaturan/pegawai')->withErrors(['Email Sudah Terdaftar']);
        }

        $validatedData = $request->validate([
            'nip_baru' => 'required|numeric|digits:18',
            'nama_baru' => 'required|string|max:100',
            'email_baru' => 'required|email|max:255',
            'no_tlp_baru' => 'numeric|digits_between:6,13',
            'jabatan_baru' => 'required|string|max:100',
        ]);

        //Insert Data ke Table Penelitian
        DB::table('pegawais')->insert([
            'nip' => $request->nip_baru,
            'nama' => $request->nama_baru,
            'email' => $request->email_baru,
            'no_tlp' => $request->no_tlp_baru,
            'jabatan' => $request->jabatan_baru,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        
        //return view('pengaturan.pengaturan_pegawai', ['pegawai'=>$pegawai, 'data'=>$request]);
        return redirect('/pengaturan/pegawai');
    }

    public function editdata(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $pegawai = Pegawai::where('nip', $request->nip_edit)->get();
        $pegawai2 = Pegawai::where('email', $request->email_edit)->get();

        //dd($request->all());
        
        if($request->nip_lama == $request->nip_edit){
            
            if($request->email_lama == $request->email_edit){

            } else if(count($pegawai2)>0){
                return redirect('/pengaturan/pegawai')->withErrors(['Email Sudah Terdaftar']);
            }
        } else if (count($pegawai)>0){
            return redirect('/pengaturan/pegawai')->withErrors(['NIP Sudah Terdaftar']);
        }   
        
        $validatedData = $request->validate([
            'nip_edit' => 'required|numeric|digits:18',
            'nama_edit' => 'required|string|max:100',
            'email_edit' => 'required|email|max:255',
            'no_tlp_edit' => 'numeric|digits_between:6,13',
            'jabatan_edit' => 'required|string|max:100',
        ]);

        //Update Data ke Table Pegawais
        DB::table('pegawais')->where('nip',$request->nip_lama)->update([
            'nip' => $request->nip_edit,
            'nama' => $request->nama_edit,
            'email' => $request->email_edit,
            'no_tlp' => $request->no_tlp_edit,
            'jabatan' => $request->jabatan_edit,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
            
        //Cek Status
        if($request->status_akun[0] == 2){
            $pegawai_hapus = Pegawai::where('nip', $request->nip_edit)->delete();
        }
        // foreach($pegawai as $p){
        //     if($p->deleted_at != NULL && $request->status_akun[0] == 1){
        //         $pegawai3 = Pegawai::onlyTrashed()->where('nip', $request->nip_edit)->restore();
        //     }else if ($p->deleted_at == NULL && $request->status_akun[0] == 2){
        //         $pegawai_hapus = Pegawai::where('nip', $request->nip_edit)->delete();
        //     }

        // }
        //return view('pengaturan.pengaturan_pegawai', ['pegawai'=>$pegawai, 'data'=>$request]);
        return redirect('/pengaturan/pegawai');
    }

    public function restore (Request $request){
        //dd($request->all());
        if($request->status_akun[0] == 1){
            $pegawai = Pegawai::onlyTrashed()->where('nip', $request->nip_edit)->restore();
        }
        
        return redirect('/pengaturan/pegawai');
    }
}
