<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Kabupaten extends Model
{
	use LogsActivity;

    protected $table = "kabupaten";
    protected $fillable = ['provinsi','kode_kab','nama_kabupaten'];

    protected static $logAttributes = ['provinsi','kode_kab','nama_kabupaten'];
    protected static $logOnlyDirty = true;

    function getProvinsi()
    {
    	return $this->hasOne('App\Models\Provinsi','id','provinsi');
    }

    public static function detailKabupaten($id){
    	return Kabupaten::where("id",$id)->first();
    }
}
