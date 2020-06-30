<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormStep extends Model
{
    protected $table = 'form_step';

    function thisFormRegister()
    {
    	return $this->belongsTo('App\Models\FormRegister','id','form_register');
    }
}
