<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;

class LogController extends Controller
{
	public function __construct() {
        $this->middleware(['auth', 'isAdmin']);
    }

    function HomeDefault()
    {
    	$title = "Log Aktifitas";
    	$log = Activity::orderBy('id','desc')->paginate(10);
    	$no = $log->firstItem();
    	$user = \App\Models\User::all();
    	$r = request();
    	return view('page.log.index',compact('title','log','no','user','r'));
    }

    function DetailLog(Activity $log)
    {
    	$causer = (is_null($log->causer_id)) ? "System" : $log->causer->name;
        return view('page.log.view',compact('log','causer'));
    }

    function DeleteLog(Activity $log)
    {
    	$log->delete();
    	flash('Log Berhasil dihapus')->success();
    	return redirect()->back();
    }

    function PencarianLog(Request $r)
    {
    	if($r->has('dari') && $r->has('sampai'))
    	{
    		
    		$dari = $r->dari." 00:00:01";
    		$sampai = $r->sampai." 12:00:00";

    		if(!empty($r->user) && $r->user !=""){
    			$log = Activity::where('causer_id', $r->user)
    				->whereBetween('created_at',[$dari, $sampai])
    				->orderBy('id','desc')->paginate(10);
    		}else{
    			$log = Activity::whereBetween('created_at',[$dari, $sampai])
    				->orderBy('id','desc')
    				->paginate(10);
    		}
    	}else{
    		if(!empty($r->user) && $r->user !=""){
    			$log = Activity::where('causer_id', $r->user)
    				->orderBy('id','desc')->paginate(10);
    		}else{
    			$log = Activity::orderBy('id','desc')->paginate(10);
    		}
    		
    	}

    	$no = $log->firstItem();
    	$user = \App\Models\User::all();
    	$title = "Filter Log Aktifitas";

    	return view('page.log.index',compact('title','log','no','user','r'));
    }

    function TruncateLog()
    {
    	Activity::truncate();
    	flash('Log Berhasil dikosongkan')->success();
    	return redirect()->back();
    }
}
