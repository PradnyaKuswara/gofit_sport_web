<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @return string $role
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->accepts('text/html')) {
            if(Auth::guard('pegawai')->check() && Auth::guard('pegawai')->user()->ROLE_PEGAWAI =='Manajer Operasional' ||Auth::guard('pegawai')->check() && Auth::guard('pegawai')->user()->ROLE_PEGAWAI =='Kasir' || Auth::guard('pegawai')->check() && Auth::guard('pegawai')->user()->ROLE_PEGAWAI =='Admin' ){
                return $next($request);
            }
            return \redirect()->intended('/')->with('error',"You don't have access. Please login first");
        }else {
            if(Auth::guard('pegawai')->check() && Auth::guard('pegawai')->user()->ROLE_PEGAWAI =='Manajer Operasional' ||Auth::guard('pegawai')->check() && Auth::guard('pegawai')->user()->ROLE_PEGAWAI =='Kasir' || Auth::guard('pegawai')->check() && Auth::guard('pegawai')->user()->ROLE_PEGAWAI =='Admin' ){
                return $next($request);
            }
            abort(404);
        }
        // $user = Auth::guard('pegawai')->user();
        // if($user->ROLE_PEGAWAI == 'Manajer Operasional'){
        //     
        // }
        // return view('login')-with('error',"Anda tidak memiliki akses");
        
    }
}