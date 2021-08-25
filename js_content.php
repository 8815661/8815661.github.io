<?php
include_once('function.php');
$json=@file_get_contents('logo.png');
if($json){
	$data=json_decode($json,TRUE);
	array_multisort(array_column($data,'addtime'),SORT_DESC,$data);
}
else{
	$data=array();
}

$offset=$_POST['offset'];

if($offset<0) $offset=$offset+PAGESIZE;
if($offset>count($data)-1) $offset=$offset-PAGESIZE;

$data=array_slice($data,$offset,PAGESIZE);

//$data['offset']=$offset;

echo json_encode($data);


