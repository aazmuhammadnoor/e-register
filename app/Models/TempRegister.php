<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempRegister extends Model
{
    protected $table = 'temp_register';

    function hasFiles()
    {
        return $this->hasMany('App\Models\TempRegisterFiles','temp_register','id');
    }

    function thisFormRegister()
    {
        return $this->belongsTo('App\Models\FormRegister','form_register','id');
    }

    function hasData()
    {
    	return $this->hasMany('App\Models\TempRegisterData','temp_register','id');
    }
}
