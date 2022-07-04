<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TamuController extends Controller
{
    public function index() {     
        $data = User::all();
        $pekerjaan = Pekerjaan::all();
        return view('Admin.Tamu.index', compact('data','pekerjaan'));
    }

    public function formTambah() {
        $pekerjaan = Pekerjaan::all();
        return view('Admin.Tamu.formTambah', compact('pekerjaan'));
    }

    public function simpanData(Request $request){
        $nama = $request->nama;
        $telepon = $request->telepon;
        $alamat = $request->alamat;
        $email = $request->email;
        $pekerjaan = $request->pekerjaan;

        $data = new User();
        $data->nama = $nama;
        $data->tlp = $telepon;
        $data->alamat = $alamat;
        $data->email = $email;
        $data->pekerjaan = $pekerjaan;
        $data->password = Hash::make('rahasia');
        $data->save();

        return redirect('admin/tamu')->with('status', 'Data Tamu Berhasil Disimpan');
    }

    public function formEdit($id){
        $data = User::find($id);
        $pekerjaan = Pekerjaan::all();
        return view('Admin.Tamu.formEdit', compact('data','pekerjaan'));
    }

    public function updateTamu(Request $request,$id){
        $data=User::with('jpekerjaan')->find($id);
        $data->nama=$request->nama;
        $data->tlp=$request->telepon;
        $data->alamat=$request->alamat;
        $data->email=$request->email;
        $data->pekerjaan=$request->pekerjaan;
        $data->save();

        return redirect('admin/tamu')->with('status', 'Data Tamu Berhasil Diupdate');
    }

    public function hapusTamu(Request $request){
        $id = $request->id;
        $data = User::find($id);
        $data->delete();
        return redirect('admin/tamu')->with('status', 'Data Tamu Berhasil Dihapus');
    }
}
