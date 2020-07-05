<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterData extends Model
{
    protected $table = 'register_data';

    function thisRegister()
    {
    	return $this->belongsTo('App\Models\Register','register','id');
    }

    function thisFormStep()
    {
    	return $this->belongsTo('App\Models\FormStep','form_step','id');
    }
}
