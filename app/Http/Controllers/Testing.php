<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workflow\Bssn;

class Testing extends Controller
{
    function TestingBSSN()
    {

        $pkcs = "percobaan-bssn.p12";
        $passphrase = "qwe1234.";

        $path = storage_path('app/tes/');
        $source = $path."skrd.pdf";
        $ttd_digital = new Bssn($source, $path, $pkcs, $passphrase);
        dd($ttd_digital);
    }
}
