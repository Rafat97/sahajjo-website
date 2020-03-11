<?php
session_start();
session_destroy();
$url = explode("/" ,$_SERVER['REQUEST_URI']);
unset($url[count($url) - 1]);
$url = implode("/",$url);
header('Location: '.$url);
