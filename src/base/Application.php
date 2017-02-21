<?php
namespace vnique\base;

use Exception;

/**
 * Application is the base class for all application classes.
 * 這個類做了一個工作。。。
 * @author wydewy <wydewy@126.com>
 */
abstract class Application
{
    /**
     * @var string the namespace that controller classes are located in.
     * This namespace will be used to load controller classes by prepending it to the controller class name.
     * The default namespace is `app\controllers`.
     */
    public $controllerNamespace = 'app\\controllers';

    /**
     * Runs the application.
     * This is the main entrance of an application.
     */
    public function run()
    {
        try {
            return $this->handleRequest();
        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Handles the specified request.
     */
    abstract public function handleRequest();
}

/*
它是一个抽象类，实现了一个简单的run方法，run方法就是去执行以下handleRequest方法。

它定义了一个抽象方法handleRequest，等待被继承，实现。

它定义了一个controllerNamespace属性，记录controller存放的namesapce，默认值是'app\controllers'。*
* /
