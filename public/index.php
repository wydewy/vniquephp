<?php
define('VNIQUE_PATH', dirname(__DIR__));

error_reporting(E_ALL);
ini_set('display_errors', '1');
//将出错信息输出到一个文本文件
ini_set('error_log', VNIQUE_PATH.'/storage/logs/error.log');
require_once(VNIQUE_PATH . '/vendor/autoload.php');//自動加載類的框架
require_once(VNIQUE_PATH . '/src/Vnique.php');

$application = new vnique\web\Application();//auto load framework start_class
$application->run();//start framework

