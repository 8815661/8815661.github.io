<?php
include 'function.php';
if(!checklogin()) exit('error');
$id=$_POST['id'];

$json=@file_get_contents('logo.png');
if($json){
	$data=json_decode($json,TRUE);
}
else{
	$data=array();
}
foreach($data as $key=>$val){
    if($val['id']==$id){
        unset($data[$key]);
    }
}

$json=json_encode($data);
file_put_contents('logo.png',$json);