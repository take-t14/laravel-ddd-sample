<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PerformanceLog
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
        $memoryBef = memory_get_peak_usage() / (1024);
        $timeStart = microtime(true);

        $ret = $next($request);

        $time = (microtime(true) - $timeStart) * 1000;
        $memoryAft = memory_get_peak_usage() / (1024);
        $memory = $memoryAft - $memoryBef;
        $currentRouteAction = \Route::currentRouteAction();
        \Log::debug("{$currentRouteAction} メモリ {$memory}KB");
        \Log::debug("{$currentRouteAction} {$time}ミリ秒");
        return $ret;
    }
}
