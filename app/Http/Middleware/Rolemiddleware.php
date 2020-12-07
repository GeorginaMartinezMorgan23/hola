<?php

namespace App\Http\Middleware;

use Closure;

class Rolemiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {

        foreach($roles as $role){
            if(auth()->user()->hasRole($role)){
                return $next($request);
            }
        }
        //$roles=array_slice(func_get_args(),2);
        
       abort(404);
    }

    
}
