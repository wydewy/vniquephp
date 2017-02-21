<?php
/**
 * Vnique 是一个帮助类，根据相应的配置文件来创建相应的类并给其属性赋值
 * @author wydewy<wydewy@126.com>
 */
class Vnique
{
    /**
     * Creates a new object using the given configuration.
     * You may view this method as an enhanced version of the `new` operator.
     * @param string $name the object name
     */
    public static function createObject($name)
    {
        $config = require(VNIQUE_PATH . "/configs/$name.php");
        print_r($name);
        // create instance
        $instance = new $config['class']();
        unset($config['class']);
        // add attributes
        foreach ($config as $key => $value) {
            $instance->$key = $value;
        }
        return $instance;
    }
    
     public static function test($name){
		 print_r($name);
	 }
}
