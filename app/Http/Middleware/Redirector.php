<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

class Redirector
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
        if(env('APP_ENV') === 'heroku' || env('APP_ENV') === 'prod'){
            Request::setTrustedProxies([$request->getClientIp()]);
            if (!$request->isSecure()) {
                return redirect()->secure($request->getRequestUri());
            }
        }
        return $next($request);
    }
}
