<?php

ob_start();
session_start();


require_once __DIR__ . '/vendor/autoload.php';


use Symfony\Component\Debug\Debug;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();
$request = new Request(
    $_GET,
    $_POST,
    [],
    $_COOKIE,
    $_FILES,
    $_SERVER
);
Debug::enable();
ErrorHandler::register();
ExceptionHandler::register();


// echo '<pre>';
// print_r($request);
// exit;

include_once $fmw_serv_resp;
// echo "<pre>";
// print_r($_POST);
// print_r($_SERVER);
// print_r($_ENV);
// print_r($_SESSION);

unset($_SESSION['error_message']);
unset($_SESSION['message']);
unset($_SESSION['old_input']);