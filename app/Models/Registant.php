<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Registant extends Authenticatable
{
	use Notifiable;

    protected $table = 'registant';

    function hasRegister()
    {
    	return $this->hasMany('App\Models\Register','register','id');
    }

}
