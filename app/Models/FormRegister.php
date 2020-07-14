<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormRegister extends Model
{
    protected $table = 'form_register';

    function hasStep()
    {
    	return $this->hasMany('App\Models\FormStep','form_register','id');
    }

    function hasRegister()
    {
    	return $this->hasMany('App\Models\Register','form_register','id');
    }
}
