<?php
namespace vnique\cache;
/**
 * 
buildKey：构建真正的 key，避免特殊字符影响实现
get：根据 key 获取缓存的值
mget：根据 keys 数组获取多个缓存值
set：根据 key 设置缓存的值
mset：根据数组设置多个缓存值
exists：判断 key 是否存在
add：如果 key 不存在就设置缓存值，否则返回false
madd：根据数组，判断相应的 key 不存在就设置缓存值
delete：根据 key 删除一个缓存
flush：删除所有的缓存
* */
interface CacheInterface{
	public function buildKey($key);
	public function get($key);
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
