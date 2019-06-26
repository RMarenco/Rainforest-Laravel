<<<<<<< HEAD
<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class User
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
            if(auth()->user()->isAdmin == 0){
                return $next($request);    
            }else if(auth()->user()->isAdmin == 1){
                return redirect('admin/index');
            }else if(auth()->user()->isAdmin == 2){
                return redirect('admin/index');
            }                  
        }
        return redirect('home')->with('error', 'you have not admin access');    
        
    }
}
=======
<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class User
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
            if(auth()->user()->isAdmin == 0){
                return $next($request);    
            }else if(auth()->user()->isAdmin == 1){
                return redirect('admin/index');
            }else if(auth()->user()->isAdmin == 2){
                return redirect('admin/index');
            }                  
        }
        return redirect('home')->with('error', 'you have not admin access');    
        
    }
}
>>>>>>> e9b1688eb66a870fc29e49895a1cba4c4c7bd269
