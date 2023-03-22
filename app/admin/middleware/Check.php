<?php

namespace app\admin\middleware;
use think\facade\Session;

class Check
{
    public function handle($request, \Closure $next)
    {
        //判断登录状态
        //如果session不存在 && login 不在pathinfo里
        if (!Session::has("Admin_Login") && !preg_match("/Login/", $request->pathinfo())) {
            return redirect((string)url("./Login"));
        }
        return $next($request);
    }
}