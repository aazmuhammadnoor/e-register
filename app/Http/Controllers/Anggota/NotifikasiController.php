<?php

namespace App\Http\Controllers\Anggota;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NotifMember;

class NotifikasiController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:pendaftar');
    }

    /**
     * @method read
     */
    public function read(Request $r)
    {
    	$id_pendaftar = auth()->user()->id;
    	$notif = NotifMember::where('id', $r->id)->first();

    	if($notif->pendaftar != $id_pendaftar)
    	{
    		abort('404');
    	}else{
    		$notif->read_at = date('Y-m-d H:i:s');
			$notif->save();
		}
    }

    /**
     * @method index
     */
    function index()
    {
        $title = "Notifikasi";
        $id_pendaftar = auth()->user()->id;
        $rs = NotifMember::orderBy('created_at','desc')->paginate(10);
        $no = $rs->firstItem();
        return view('anggota.notifikasi',compact('title','rs','no'));
    }
}
