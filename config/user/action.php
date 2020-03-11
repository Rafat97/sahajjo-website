<?php
ob_start();
session_start();
require_once ('../classes/DB.php');
require_once ('../classes/func/imp_fun_conf.php');

global $db;

$default_value_config = json_decode(file_get_contents('../imp/info_config.json') , true);
$default_value = json_decode(file_get_contents($default_value_config['default_file_dir'].'../default.json') , true);

$database_user_name = $default_value['db_info']['user_name'];
$database_pass = $default_value['db_info']['password'];
$database_host = $default_value['db_info']['host_name'];
$database_db_name = $default_value['db_info']['db_name'];


$database = new Classes\DB();
$database->create($database_host , $database_user_name , $database_pass , $database_db_name );
$db = $database;
$db->connection_mysql();



if( !empty($_POST) ){   
    if($_POST['form_type'] == 'login_user'   ){
      
        //print_r($_REQUEST);
        $email = $_POST['email'];
        $pass = $_POST['pwd'];

        $sql = "SELECT * FROM `config_access` WHERE `email` = '$email' AND `password` = '$pass'  ";
        $val = $db->get_result($sql);

        if(count($val) >= 1 ){
            $_SESSION['CURRENT_USER'] = $val[0]['ID'];
        }

        header('Location: '.$_POST['form_type_requested_url']);
    }

    elseif ($_POST['form_type'] == 'creat_user'  ) {
        print_r($_REQUEST);
        $db_ins = array(
            "user_name" => $_POST['username'],
            "email" => $_POST['email'],
            "password" => $_POST['pwd'],
        );
        $db->insert('config_access' , $db_ins );
        header('Location: '.$_POST['form_type_requested_url']);
    }
    elseif ($_POST['form_type'] == 'add_new_url'  ) {
        
        $url = $_POST["url_route"];
        $return_val =  $db->get_result("SELECT * FROM `url_controller` WHERE `url` = '".$url ."' AND `status` = 'publish' ");
        
        if( count($return_val) >= 1 ){
            echo "Already have this url. Please check<br>";
            echo "Go to previous page , <a href='".$_POST['form_type_requested_url']."'>Here</a>";
            exit;
        }

 

        $db_ins = array(
            'U_ID'  => uniqid(),
            'title'  => $_POST['title'],
            'description'  => $_POST['description'],
            'url'  => $_POST['url_route'],
            'request_type' => $_POST['request_type'],
            'path_view' => $_POST['file_path'],
            'status'  => $_POST['status'],
        );
        $db->insert('url_controller' , $db_ins );
        header('Location: '.$_POST['form_type_requested_url']);
    }
    elseif ($_POST['form_type'] == 'delete_url'  ) {
        print_r($_REQUEST);
        //exit;
        $id = $_POST['url_deleted_id'];
        $sql = "DELETE FROM `url_controller` WHERE `url_controller`.`ID` = $id";
        $db->execute($sql);

        $db->execute("
        SET @num := 0; 
        UPDATE url_controller SET id = @num := (@num+1); 
        ALTER TABLE url_controller AUTO_INCREMENT = 1;
        ");


        header('Location: '.$_POST['form_type_requested_url']);
    }
}