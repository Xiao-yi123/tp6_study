<?php
declare (strict_types = 1);

namespace app;

use think\App;
use think\exception\ValidateException;
use think\Response;
use think\Validate;
use think\facade\View;

/**
 * 控制器基础类
 */
abstract class BaseController
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;

        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {}

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }

    //页面分配变量
    protected function assign($key,$value)
    {
        return View::assign($key,$value);
    }

    //页面渲染
    protected function fetch($template = '',$data = [])
    {
        return View::fetch($template,$data);
    }

    /**
     * @param $data array 要返回的数据
     * @param $type string 输出格式 json|html
     * @param $code int 响应码
     * @return Response
     */
    protected function RestJson($data = [], $type = "json", $code = 200)
    {
        return Response::create($data, $type, $code);
    }

    public function if_iframe(){
        if ($this->request->header('X-Requested-With') !== 'XMLHttpRequest' && strpos($this->request->header('Referer'), '127.0.0.1') === false) {
            return true;
        } else {
            // The request is not coming from an iframe
            return false;
        }
    }

}
