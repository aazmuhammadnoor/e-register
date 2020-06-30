<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Menu extends Model
{
    use LogsActivity;

    protected $table = "menu";
    protected $fillable = ['parent','label','url','icon','urutan'];

    protected static $logAttributes = ['parent','label','url','icon','urutan'];
    protected static $logOnlyDirty = true;

    function childMenu()
    {
    	return $this->hasMany('App\Models\Menu','parent','id');
    }

    function parentMenu()
    {
    	return $this->hasOne('App\Models\Menu','id','parent');
    }

	function roles()
	{
		return $this->belongsToMany('App\Models\Role');
	}
}
