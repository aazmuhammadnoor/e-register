<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DownloadController extends Controller
{
	public function __construct()
	{
        $this->middleware('auth:pendaftar');
    }

    function DownloadFilePersyaratan($base64)
    {
        $file = storage_path("app/".base64_decode($base64));
        return response()->file($file);
    }
    
    function DownloadFileFormulir($base64)
    {
       $file = storage_path("app/".base64_decode($base64));
        return response()->file($file);
    }

}
