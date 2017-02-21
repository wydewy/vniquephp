<?php
namespace vnique\cache;

class FileCache implements CacheInterface{
	/**
	 * 缓存地址
	 * */
	public $cachePath;
	
	public function getFilePath($key){
		$key = $this->buildKey($key);
		return $this->cachePath.$key;
	}
	
	public function buildKey($key){
		if(!is_string($key)){
			$key = json_encode($key);
		}
		return md5($key);
	}
	
	/**
	 * 根据key获得缓存的文件中的值
	 * */
	public function get($key){
		//根据key获得缓存文件的路径
		$filePath = $this->getFilePath($key);
		if(@filemtime($filePath)>time()){//判断文件是否存在
			return @unserialize(@file_get_contents($filePath));
		}else{
			return false;
		}
	}
		
	public function mget($keys);
	public function set($key,$value,$duration=0);
	public function mset($items,$duration=0);
	public function exits($key);
	public function add($key,$vlaue,$duration=0);
	public function madd($items,$duration=0);
	public function delete($key);
	public function flush();
	
}
//其主要思想就是，每一个 key 都对应一个文件，缓存的内容序列化一下，存入到文件中，取出时再反序列化一下。剩下的基本都是相应的文件操作了。
