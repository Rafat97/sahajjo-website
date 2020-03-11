<?php
session_start();
require_once ('../classes/DB.php');
require_once ('../classes/func/imp_fun_conf.php');



$value = json_decode(file_get_contents('../imp/info_config.json') , true);
$default_value =json_decode(file_get_contents($value['default_file_dir'].'../default.json') , true);
$db_info = $default_value['db_info'];



if( !empty($_POST) ){
        
    if($_POST['form_type'] == 'database_setting'   ){
            
        $database_user_name = $_POST['user_name'];
        $database_pass = $_POST['password'];
        $database_host = $_POST['host_name'];
        $database_db_name = $_POST['database_name'];

        $database = new Classes\DB();
        $database->create($database_host , $database_user_name , $database_pass , $database_db_name );

        if( $database->isConnection() ){
            $default_value['db_info']['host_name'] = $database_host;
            $default_value['db_info']['user_name'] = $database_user_name;
            $default_value['db_info']['password'] = $database_pass;
            $default_value['db_info']['db_name'] = $database_db_name;
            $default_value['is_config'] = true;

            $newJsonString = json_encode($default_value,JSON_PRETTY_PRINT);
            file_put_contents($value['default_file_dir'].'../default.json', $newJsonString);

            $value['is_config'] = true;
            $value['is_config_database'] = true;
            $value['is_install'] = true;
            $newJsonString = json_encode($value,JSON_PRETTY_PRINT);
           
            file_put_contents('../imp/info_config.json', $newJsonString);

            $sql = "CREATE TABLE `url_controller` (
                `ID` int(11) NOT NULL AUTO_INCREMENT,
                `U_ID` text NOT NULL,
                `title` text,
                `description` text,
                `url` text,
                `request_type` text ,
                `path_view` text,
                `status` text,
                `is_trash` tinyint(1) NOT NULL DEFAULT '0',
                `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`ID`)
               ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

            $sql_2 = "CREATE TABLE `config_access` (
                `ID` int(11) NOT NULL AUTO_INCREMENT,
                `user_name` text NOT NULL,
                `email` text NOT NULL,
                `password` text NOT NULL,
                `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`ID`)
               ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

            $sql_3 = "CREATE TABLE `url_content_view` (
                `ID` int(11) NOT NULL AUTO_INCREMENT,
                `url_controller_id` text NOT NULL,
                `content` longtext ,
                `position` int(11) NULL,
                `status` int(11) NULL,
                `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`ID`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

            $user_name = $default_value['admin_user_info']['user_name'];   
            $user_pass = $default_value['admin_user_info']['password'];  
            $user_email = $default_value['admin_user_info']['email'];  

            if(   $database->is_execute($sql)  &&  $database->is_execute($sql_2) && $database->is_execute($sql_3)){
                $db_ins=array(
                    'U_ID'  => uniqid(),
                    'title'  => 'This is Title',
                    'description'  => 'This is description',
                    'url'  => "/",
                    'request_type' => 'get',
                    'path_view' => 'main.php',
                    'status'  => 'publish',
                );

                $val = $database->insert('url_controller',$db_ins);
                $db_ins=array(
                    'U_ID'  => uniqid(),
                    'title'  => 'This is Title 404 ',
                    'description'  => 'This is description 404',
                    'url'  => "/404",
                    'request_type' => 'get',
                    'path_view' => '404.php',
                    'status'  => 'publish',
                );

                $val = $database->insert('url_controller',$db_ins);

                $db_ins=array(
                    'user_name'  => $default_value['admin_user_info']['user_name'],
                    'email'  => $default_value['admin_user_info']['email'],
                    'password'  => $default_value['admin_user_info']['password'],
                );

                $val = $database->insert('config_access',$db_ins);

                $_SESSION['error_message_single'] = 'Successfully Add';
            }else{

               
                $_SESSION['error_message_single'] = "Already have database Connection ";
            }
        }else{
            $_SESSION['error_message_single'] = $database->connection_mysql(); 
        }
      
        header('Location: '.$_POST['form_type_requested_url']);
    }


}
