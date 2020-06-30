<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable,HasRoles;
    use LogsActivity;

    protected $guard_name = 'web';
    
    protected $fillable = [
        'name', 'email', 'password', 'username', 'kategori_dinas', 'bidang_izin', 'seksi_izin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static $ignoreChangedAttributes = ['created_at', 'updated_at'];
    protected static $logAttributes = ['name', 'email', 'username', 'created_at', 'updated_at'];


    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }

    public function getKategoriDinas()
    {
        return $this->belongsTo('App\Models\KategoriDinas', 'kategori_dinas');
    }

    public function getBidangIzin()
    {
        return $this->belongsTo('App\Models\BidangIzin', 'bidang_izin');
    }

    public function getSeksiIzin()
    {
        return $this->belongsTo('App\Models\SeksiIzin', 'seksi_izin');
    }

}
