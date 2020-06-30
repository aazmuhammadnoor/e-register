<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:pendaftar');
    }

    public function index()
    {
        $title = "Halaman Anggota";
        return view('anggota.home',compact('title'));
    }

}
