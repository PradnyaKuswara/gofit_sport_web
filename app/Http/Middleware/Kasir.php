<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Kasir
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->accepts('text/html')){
            if(Auth::guard('pegawai')->user()->ROLE_PEGAWAI =='Kasir'){
                return $next($request);
            }
            return \redirect()->intended('dashboard/main')->with('error',"You don't have access");
        }
    }
}