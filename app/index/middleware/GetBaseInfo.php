<?php
declare (strict_types = 1);

namespace app\index\middleware;

use app\index\model\WebConfig;

class GetBaseInfo
{
    /**
     * 获取基本信息
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        //
        $request->WebConfig = WebConfig::where("id",1)->find();

        return $next($request);
    }
}
