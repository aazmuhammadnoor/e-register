<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Pengumuman extends Model
{
    use LogsActivity;
    protected $table = "pengumuman";
    protected $fillable = ['judul','isi','publish'];

    protected static $logAttributes = ['judul','isi','publish'];

}
