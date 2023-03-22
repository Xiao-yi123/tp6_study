<?php

namespace app\index\middleware;

class Check
{
    public function handle($request, \Closure $next)
    {
        return $next($request);
    }
}