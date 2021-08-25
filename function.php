<?php
include 'config.php';


if (!function_exists("array_column")) {
    function array_column(array &$rows, $column_key, $index_key = null) {
      $data = array();
      if (empty($index_key)) {
        foreach ($rows as $row) {
          $data[] = $row[$column_key];
        }
      } else {
        foreach ($rows as $row) {
          $data[$row[$index_key]] = $row[$column_key];
        }
      }
      return $data;
    }
}

function get_ip() {
  if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
      $ip = getenv('HTTP_CLIENT_IP');
  } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
      $ip = getenv('HTTP_X_FORWARDED_FOR');
  } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
      $ip = getenv('REMOTE_ADDR');
  } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
      $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

function cookie($name,$val=FALSE){
    if($val){
      setcookie($name,$val,0);
    }else{
      return @$_COOKIE[$name];
    }
}

function redir($uri){
    header('Location:'.$uri);
    exit;
}

function checklogin(){
    $pass=cookie('pass');
    if($pass==MD5(PASSWORD)){
      return true;
    }
    else{
      return false;
    }
}