<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempRegisterFiles extends Model
{
     protected $table = 'temp_register_files';

     function thisTempRegister()
     {
        return $this->belongsTo('App\Models\TempRegister','form_register','id');
     }
}
