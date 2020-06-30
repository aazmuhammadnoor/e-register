<?php 

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PermohonanScopes implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if(\Auth::check()) {
            $bidang = auth()->user()->bidang;
            if(!is_null($bidang)){
    	        $builder->whereHas('getIzin', function($query){
    	        	$query->whereHas('getKategori',function($query2){
    	        		$query2->where('id', auth()->user()->bidang);
    	        	});
    	        });
            }
        }
    }
}