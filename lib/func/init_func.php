<?php

include_once "imp_fun.php";

global $fmw_database ;
global $fmw_serv_resp ;
global $fmw_config_val ;
if(!isset($_SESSION['error_message']) || count($_SESSION['error_message']) == 0){
    $_SESSION['error_message'] = array();
}
if(!isset($_SESSION['message']) || count($_SESSION['message']) == 0){
    $_SESSION['message'] = array();
}
if(!isset($_SESSION['old_input']) || count($_SESSION['old_input']) == 0){
    $_SESSION['old_input'] = array();
}
if(!isset($_SESSION['user_visited_url'])){
    $_SESSION['user_visited_url'] = array();
}
$database_user_name = $_ENV['db_info']['user_name'];
$database_pass = $_ENV['db_info']['password'];
$database_host = $_ENV['db_info']['host_name'];
$database_db_name = $_ENV['db_info']['db_name'];

$default_val = new Lib\Classes\Default_val();

$fmw_config_val = $default_val;
// $fmw_database = $default_val->get_db_info();
$fmw_database = new Lib\Classes\DB();
$fmw_database->create($database_host , $database_user_name , $database_pass , $database_db_name );
if(!$fmw_database->isConnection()){
    echo "Please Connect Database first";
    exit;
}
// echo getCurrentUrl();
// exit;
$url_con = new Lib\Classes\Url(getCurrentUrl(), $fmw_database );
$fmw_serv_resp = $url_con->getUrlResp();

if(count($_SESSION['user_visited_url']) == 0 ){
    array_push($_SESSION['user_visited_url'], getCurrentUrl());
}
elseif($_SESSION['user_visited_url'][count($_SESSION['user_visited_url']) - 1] !=  getCurrentUrl()){
    array_push($_SESSION['user_visited_url'], getCurrentUrl());
}


/*
if(!$default_value['is_config'] && $url == "/"){
    $url =  $default_value['site_url'].$default_value['config_dir'];
    header('Location: '.$url);
}

$database->setHostName($default_value['db_info']['host_name']);
$database->setUserName($default_value['db_info']['user_name']);
$database->setPassWord($default_value['db_info']['password']);

if($database->isConnection()){

    $Config = new Lib\Classes\Init\Config($database);

}else{
    echo "Please Check Your Database Access Information";
    exit;
}
*/
