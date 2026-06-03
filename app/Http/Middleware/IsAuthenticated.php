<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(Auth::check() && Auth::user()->is_admin == 1){
                return redirect()->route('admin.dashboard');
        }else if(Auth::check() && Auth::user()->is_admin == 0){
               return redirect()->route('front.dashboard');
        }
        
       
        return $next($request);
    }
}
