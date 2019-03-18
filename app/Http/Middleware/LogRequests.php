<?php

namespace App\Http\Middleware;

use Closure;
use Monolog\Logger;
use Zwijn\Monolog\Handler\LogdnaHandler;

class LogRequests
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
        if(env('APP_ENV') === 'prod' || env('APP_ENV') === 'heroku' || env('APP_ENV') === 'debug'){
            $logger = new Logger('api');
            $logdnaHandler = new LogdnaHandler(env('LOG_DNA_KEY'), env('LOG_DNA_SOURCE'), Logger::API);
            $logger->pushHandler($logdnaHandler);
            $logger->info($request->getUri(), array_merge($request->except(['password', 'pin']), [
                'token'=> $request->bearerToken(),
                'method'=> $request->getMethod()
            ]));
        }
        return $next($request);
    }
}
