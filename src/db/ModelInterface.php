<?php
namespace vnique\db;
/**
 * model interface：all model will implement this interface by extends a base class Model that implement ModelInterface.
 * @author wydewy <wydewy@126.com>
 * */
 
interface ModelInterface{
	/**
	 *  获得表名，静态方法（因为一个模型对应一张表，是该模型类的属性而非该模型某个具体对象的属性）
	 * */
	public static function tableName();
	/**
	 *  主键
	 * */
    public static function primaryKey();
	/**
	 *  查询一个
	 * */
    public static function findOne($condition);
	/**
	 *  查询所有
	 * */
    public static function findAll($condition);
	/**
	 *  更新所有，参数为条件
	 * */
    public static function updateAll($condition, $attributes);
	/**
	 *  删除所有
	 * */
    public static function deleteAll($condition);


	//一下三个方法为具体对象的方法
    public function insert();

    public function update();

    public function delete();
}
