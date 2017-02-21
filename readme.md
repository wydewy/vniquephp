#1.保證路由正確，需要配置nginx：選擇一種配置方式：
（1）try_files $uri $uri/ index.php?$args;根目錄在vniquephp/public下；
（2）try_files $uri $uri/ index.php?$args;根目錄在vniquephp/下；