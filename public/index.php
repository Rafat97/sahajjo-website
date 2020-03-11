<?php

ob_start();
session_start();


require_once __DIR__ . '/../vendor/autoload.php';

// $dotenv = new Dotenv();
// $dotenv->load('.env');

include_once __DIR__ . "/../$fmw_serv_resp";
// echo "<pre>";
// print_r($_POST);
// print_r($_SERVER);
// print_r($_ENV);
// print_r($_SESSION);

unset($_SESSION['error_message']);
unset($_SESSION['message']);