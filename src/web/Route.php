<?php
namespace vnique\web;
/**
*路由類
*
*請求~/xxx/yyy等於請求~/index.php?$args
*
*路由的過程：
*1.隱藏index.php   在location中添加：try_files $uri $uri/ /index.php?$args;
*2.獲取參數部分
*3.如果沒有添加過此類則添加
*/
class Route{
    public $ctr;
    public $action;
    public function __construct(){
        //p('route ok');
        //p($_SERVER);
		
		//加載配置：
//		$conf = config::get("route");
//		if(is_file($conf)){
//			require_once $conf;
//
//		}

        if(isset($_SERVER['REQUEST_URI'])&&$_SERVER['REQUEST_URI']!='/'){
            $path = $_SERVER['REQUEST_URI'];
            $patharr = explode('/',trim($path,'/'));
			$count = count($patharr);
			
			if(isset($patharr[0])){
				$this->ctr = $patharr[0];
			}else{
				 $this->ctr = 'index';
			}
			
			if(isset($patharr[1])){
				 $this->action = $patharr[1];
			}else{
				  $this->action = 'index';
			}
			//把參數放入$_GET中
			$i=2;
			
			//p($count);
			
			while($i<$count){
				if(isset($patharr[$i+1])){
					$_GET[$patharr[$i]]=$patharr[$i+1];
				}
				$i+=2;
			}
        }else{
            $this->ctr = 'index';
            $this->action = 'index';
        }	
    }

}

?>
