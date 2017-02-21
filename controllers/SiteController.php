<?php
namespace app\controllers;

use vnique\web\Controller;
use app\models\User;

class SiteController extends Controller
{
    public function actionTest()
    {
		$user1 = new User();
		$user1->name = 'test1';
		$user1->age = 10;
		
		User::deleteAll(['name' => $user1->name,'age'=>$user1->age]);
		
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

