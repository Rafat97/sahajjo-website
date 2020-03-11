<?php
$main_path = json_decode(file_get_contents(dirname(dirname(dirname(__DIR__)))."/default.json"),true);
$_ENV =  $main_path ;
