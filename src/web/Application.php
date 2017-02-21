<?php
namespace vnique\web;
/**
 * Application is the base class for all application classes.
 * @author wydewy <wydewy@126.com>
 */
class Application extends \vnique\base\Application
{
    /**
     * Handles the specified request.
     * @return Response the resulting response
     */
    public function handleRequest()
    {
        $router = new Route();
        $ucController = ucfirst($router->ctr);//首字母大寫
        $controllerNameStr = $this->controllerNamespace . '\\' . $ucController . 'Controller';
        $controller = new $controllerNameStr();
        $controller->id = $router->ctr;
        $controller->action = $router->action;
        return call_user_func([$controller, 'action'. ucfirst($router->action)]);
        //cal_user_func这个函数可传入两个参数，类型均为数组：第一个数组的第一个元素是函数的所属对象，第二是是函数名，若由第二个数组，则是函数的参数。
    }
}
/*
*将之前放在index.php中的内容放到Application的handleRequest方法里了。
*程序的入口 
*/ 
