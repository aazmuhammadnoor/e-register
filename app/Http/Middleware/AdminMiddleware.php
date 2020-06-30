<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if(!auth()->user()->is_admin){
        	abort('401');
        }
        return $next($request);
    }
}