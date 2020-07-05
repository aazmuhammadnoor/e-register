<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table = 'register';

    function thisRegistant()
    {
    	return $this->belongsTo('App\Models\Registant','registant','id');
    }

    function thisFormRegister()
    {
    	return $this->belongsTo('App\Models\FormRegister','form_register','id');
    }

    function hasRegisterData()
    {
    	return $this->hasMany('App\Models\RegisterData','register','id');
    }
}
