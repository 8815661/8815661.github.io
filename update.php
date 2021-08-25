<?php 
include 'function.php';
$json=@file_get_contents('logo.png');
if($json){
    $data=json_decode($json,TRUE);
    foreach($data as $key=>$val){
        if(!isset($val['id'])){
            $data[$key]['id']=md5($time.$ip.rand(10000,99999));
        }
    }
    $json=json_encode($data);
    file_put_contents('logo.png',$json);
    echo '数据升级完毕';
}
else{
     echo '没有找到logo.png文件，不用升级';
}