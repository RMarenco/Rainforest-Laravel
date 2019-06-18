<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Superadmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()){
            if(auth()->user()->isAdmin == 2){
                return $next($request);    
            }else if(auth()->user()->isAdmin == 1){
                return redirect('admin/index');
            }else if(auth()->user()->isAdmin == 0){
                return redirect('index');
            }     

        }
        return redirect('home')->with('error', 'you have not admin access');    
        
    }
}
