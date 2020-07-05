<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registant extends Model
{
    protected $table = 'registant';

    function hasRegister()
    {
    	return $this->hasMany('App\Models\Register','register','id');
    }
}
