<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $pengunjung = User::count();
        return view('dashboard', compact('pengunjung'));
    }
}
