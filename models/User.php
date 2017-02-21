<?php
namespace app\models;
use vnique\db\Model;
/**
 * model User
 * */
class User extends Model{
	 public $id;
	 public $deviceId;
	 public $userName;
	 public $createDate;
	 public $telephone;
	 public $enable;
	 public static function tableName(){
        return 'user';
    }
	
}
