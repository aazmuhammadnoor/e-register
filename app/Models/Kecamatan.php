<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Kecamatan extends Model
{
	use LogsActivity;

    protected $table = "kecamatan";
    protected $fillable = ['name','latitude','longitude','polygon','warna'];

    protected static $logAttributes = ['name','latitude','longitude','polygon','warna'];
    protected static $logOnlyDirty = true;

    function getKelurahan()
    {
    	return $this->hasMany('App\Models\Kelurahan','kecamatan','id');
    }

    function thisKabupaten()
    {
        return $this->belongsTo('App\Models\Kabupaten','kabupaten','id');
    }

    function hasKelurahan()
    {
        return $this->hasMany('App\Models\Kelurahan','kelurahan','id');
    }

    public static function detailKecamatan($id){
    	return Kecamatan::where("id",$id)->first();
    }
}
