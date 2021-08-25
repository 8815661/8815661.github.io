<?php
include 'function.php';
$pass=@$_POST['pass'];
if($pass==PASSWORD){
    cookie('pass',md5($pass));
    echo 'success';
}