<?php
include_once('function.php');
$json=@file_get_contents('logo.png');
if($json){
	$data=json_decode($json,TRUE);
}
else{
	$data=array();
}
echo count($data);