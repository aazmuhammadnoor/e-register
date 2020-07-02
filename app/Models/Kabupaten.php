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

    function thisProvinsi()
    {
        return $this->belongsTo('App\Models\Provinsi','provinsi','id');
    }

    function hasKecamatan()
    {
        return $this->hasMany('App\Models\Kecamatan','kabupaten','id');
    }

    public static function detailKabupaten($id){
    	return Kabupaten::where("id",$id)->first();
    }
}
