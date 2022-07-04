<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $pengunjung = User::count();
        $asn = User::where('pekerjaan', '=', 1)->count();
        $mahasiswa= User::where('pekerjaan', '=', 2)->count();
        $dosen = User::where('pekerjaan', '=', 3)->count();
        return view('dashboard', compact('pengunjung','asn','mahasiswa','dosen'));
    }
}
