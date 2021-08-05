<?php

namespace App\Http\Middleware;

use Closure;

class AuthAkademik
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
        $user = auth()->user();

        if(!$user->isAkademik()){
            return redirect()->back();
        }
        return $next($request);
    }
}
