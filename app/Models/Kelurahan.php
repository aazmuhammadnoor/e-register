<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Kelurahan extends Model
{
	use LogsActivity;

    protected $table = "kelurahan";
    protected $fillable = ['kecamatan','name','latitude','longitude','polygon','warna'];

    protected static $logAttributes = ['kecamatan','name','latitude','longitude','polygon','warna'];
    protected static $logOnlyDirty = true;

    function getKecamatan()
    {
    	return $this->hasOne('App\Models\Kecamatan','id','kecamatan');
    }

    public static function detailKelurahan($id){
    	return Kelurahan::where("id",$id)->first();
    }
}
