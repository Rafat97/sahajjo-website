<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

$value = json_decode(file_get_contents(__DIR__.'/imp/info_config.json') , true);
$default_value = json_decode(file_get_contents($value['default_file_dir'].'default.json') , true);
//print_r($value);



if(!$value['is_install']){
    $url =  $default_value['site_url'].$default_value['config_dir']."/install";

    header('Location: '.$url);
    exit;
}else{
    $url =  $default_value['site_url'].$default_value['config_dir']."/user";
   
    header('Location: '.$url);
    exit;
}
?>


