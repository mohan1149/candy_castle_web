<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $role = $request->session()->get('role');
        $locale = $request->session()->get('lang');
        app()->setLocale($locale);
        if($role !== null){
            return $next($request);
        }else{
            return redirect('/');
        }
    }
}
