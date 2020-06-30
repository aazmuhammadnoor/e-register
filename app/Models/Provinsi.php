<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Provinsi extends Model
{
	use LogsActivity;

    protected $table = "provinsi";
    protected $fillable = ['name','kode_prov'];

    protected static $logAttributes = ['name','kode_prov'];
    protected static $logOnlyDirty = true;

    function getKabupaten()
    {
    	return $this->hasMany('App\Models\Kabupaten','provinsi','id');
    }

    public static function detailProvinsi($id){
    	return Provinsi::where("id",$id)->first();
    }
}
