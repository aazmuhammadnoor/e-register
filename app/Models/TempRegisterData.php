<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempRegisterData extends Model
{
     protected $table = 'temp_register_data';

     function thisTempRegister()
     {
        return $this->belongsTo('App\Models\TempRegister','form_register','id');
     }

     function thisFormStep()
     {
        return $this->belongsTo('App\Models\FormStep','form_step','id');
     }
}
