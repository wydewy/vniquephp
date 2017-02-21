<?php
namespace app\controllers;

use vnique\web\Controller;
use app\models\User;

class IndexController extends Controller
{
    public function actionIndex()
    {
		$user1 = new User();
		$deviceId = "324241234";
		$userName = "xxx";
		$createDate = "20170920";
		$telephone = "13632234322";
		$enable = "0";
		
		$user1->insert();
		
        $data = [
            'first' => 'awesome-php-zh_CN',
            'second' => 'simple-framework',
            'user' => $user1
        ];
        echo $this->toJson($data);
    }
    
    public function actionView()
    {
        $this->render('site/view',['body' => 'hi vnique ~']);
    }
}

