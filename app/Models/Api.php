<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    protected $table = "api";
    protected $fillable = ['api_name','token'];
}
