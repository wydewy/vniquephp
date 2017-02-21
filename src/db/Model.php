<?php
namespace vnique\db;

use PDO;
use Vnique;

/**
 * Model is a base class of data model
 * */
class Model implements ModelInterface{
	/**
	 *  获得表名，静态方法（因为一个模型对应一张表，是该模型类的属性而非该模型某个具体对象的属性）
	 * */
	public static function tableName(){
		return get_called_class();
	}
	
	/**
	 *  主键
	 * */
    public static function primaryKey(){
		return ['id'];
	}
	
	/**
	 *  查询一个
	 * */
    public static function findOne($condition=null){
        $sql = 'select * from ' . static::tableName() . ' where ';
		list($where,$params) = static::buildWhere($condition);
         $stmt = static::getDb()->prepare($sql.$where);//前半句
         $rs = $stmt->execute($params);//传入查询参数，返回查询游标？
        if ($rs) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return static::array2Model($row);
        }
        // 默认返回null
        return null;
	}
	/**
	 *  查询所有
	 * */
    public static function findAll($condition=null){
		$models = [];
		 // 拼接默认的前半段sql语句
        $sql = 'select * from ' . static::tableName() . ' where ';
		list($where,$params) = static::buildWhere($condition);
         $stmt = static::getDb()->prepare($sql.$where);//前半句
         $rs = $stmt->execute($params);//传入查询参数，返回查询游标？
        if ($rs) {
            $rows= $stmt->fetchAll(PDO::FETCH_ASSOC);
            //print_r(sizeof($rows));
            foreach($rows as $row){
				$model = static::array2Model($row);
				array_push($models,$model);
			}
        }
        return $models;
	}
	/**
	 *  更新所有，参数$condition为条件,$attributes为设置的参数及值
	 *  UPDATE 表名称 SET 列名称 = 新值 WHERE 列名称 = 某值
	 * 	返回影响个数
	 * */
   public static function updateAll($condition, $attributes)
    {
        $sql = 'update ' . static::tableName();
        $params = [];

        if (!empty($attributes)) {
            $sql .= ' set '.static::buildAttributes($attributes);
        }
		//print_r($sql);
        list($where, $params) = static::buildWhere($condition);
        $sql .= ' where '.$where;
		print_r($sql);
		
        $stmt = static::getDb()->prepare($sql);
        $execResult = $stmt->execute($params);
        if ($execResult) {
            // 获取更新的行数
            $execResult = $stmt->rowCount();
        }
        return $execResult;
    }
	/**
	 *  删除所有
	 * DELETE FROM 表名称 WHERE 列名称 = 值
	 * */
    public static function deleteAll($condition){
		$sql = 'DELETE from ' . static::tableName() . ' where ';
		list($where,$params) = static::buildWhere($condition);
        $stmt = static::getDb()->prepare($sql.$where);//前半句
        $execResult = $stmt->execute($params);//传入查询参数，返回查询游标？
        if ($execResult) {
            // 获取更新的行数
            $execResult = $stmt->rowCount();
        }
        return $execResult;
	}


	//一下三个方法为具体对象的方法
    public function insert(){
		$sql = 'insert into ' . static::tableName();
        $params = [];
        $keys = [];
        foreach ($this as $key => $value) {
            array_push($keys, $key);
            array_push($params, $value);
        }
        // 构建由？组成的数组，其个数与参数相等数相同
        $holders = array_fill(0, count($keys), '?');
        $sql .= ' (' . implode(' , ', $keys) . ') values ( ' . implode(' , ', $holders) . ')';

        $stmt = static::getDb()->prepare($sql);
        $execResult = $stmt->execute($params);
        // 将一些自增值赋回Model中
        $primaryKeys = static::primaryKey();
        foreach ($primaryKeys as $name) {
            // Get the primary key
            $lastId = static::getDb()->lastInsertId($name);
            $this->$name = (int) $lastId;
        }
        return $execResult;
	}

    public function update(){
		 $primaryKeys = static::primaryKey();
        $condition = [];
        foreach ($primaryKeys as $name) {
            $condition[$name] = isset($this->$name) ? $this->$name : null;
        }

        $attributes = [];
        foreach ($this as $key => $value) {
            if (!in_array($key, $primaryKeys, true)) {
                $attributes[$key] = $value;
            }
        }

        return static::updateAll($condition, $attributes) !== false;
	}

    public function delete(){
		$primaryKeys = static::primaryKey();
        $condition = [];
        foreach ($primaryKeys as $name) {
            $condition[$name] = isset($this->$name) ? $this->$name : null;
        }

        return static::deleteAll($condition) !== false;
	}


//==============抽取一些可重用的方法========================begin

	public static function buildWhere($condition){
		 // 取出condition中value作为参数
         $params = [];
		 $rs=null;
		 $where = "";
        // 判空
        if (!empty($condition)) {
            $params = array_values($condition);
            $keys = [];
            foreach ($condition as $key => $value) {
                array_push($keys, "$key = ?");
            }
            $where .= implode(' and ', $keys);
			return [$where,$params];
        }
        return null;
	}
	
	public static function buildAttributes($attributes){
		 $attrs = "";
        // 判空
        if (!empty($attributes)) {
            foreach ($attributes as $key => $value) {
				$attrs .= $key."=".$value.",";
            }
			$attrs = substr($attrs, 0, -1);
        }
        return $attrs;
	}
	
	public static function array2Model($row){
		   if (!empty($row)) {
                // 创建相应model的实例
                $model = new static();
                foreach ($row as $rowKey => $rowValue) {
                    // 给model的属性赋值
                    $model->$rowKey = $rowValue;
                }
                return $model;
            }
	}


	/**
	 * 我们所有的model都要基于PDO，所以我们应该在model中有一个PDO的实例。所以我们需要在Model类中添加如下变量和方法。
	 * 下面采用了单例模式
	 * */


    /**
     * @var $pdo PDO instance
     */
    public static $pdo;

    /**
     * Get pdo instance
     * @return PDO
     */
    public static function getDb()
    {
        if (empty(static::$pdo)) {
            static::$pdo = Vnique::createObject('db')->getDB();;
            static::$pdo->exec("set names 'utf8'");
        }
        return static::$pdo;
    }

}

 

