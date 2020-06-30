<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class KategoriScopes implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if(\Auth::check()) {
	        $bidang = auth()->user()->bidang;
	        if(!is_null($bidang)){
				$builder
					//->where('parent','<>', 1)
					->whereHas('getKategori', function($query){
	                $query->where('id', auth()->user()->bidang);
	            });
	        }
    	}
    }
}