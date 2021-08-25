<?php
include_once('function.php');
session_start();
$content=@$_POST['content'];
$content=strip_tags($content);
$content=nl2br($content);
$scode=@$_POST['scode'];

if($scode!=$_SESSION['scode'] && VCODE==1){
	echo 'scode';
	exit;
}


$json=@file_get_contents('logo.png');
if($json){
	$data=json_decode($json,TRUE);
}
else{
	$data=array();
}
$time=time();
$ip=get_ip();
$id=md5($time.$ip.rand(10000,99999));
$data[]=array('id'=>$id,'content'=>$content,'addtime'=>$time,'ip'=>$ip);
$json=json_encode($data);
file_put_contents('logo.png',$json);
echo 'success';