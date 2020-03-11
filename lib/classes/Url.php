<?php

namespace Lib\Classes;



class Url
{
    public $url ;
    public $database;
    public $tableName ;
    function __construct($val , $db)
    {
        $this->url = $val;
        $this->database = $db;
        $this->tableName = "url_controller";
        $this->getUrlResp();
    }
    function getUrlResp()
    {


        try {
        
        $req_url_val = $this->database->input_validation_database($this->url);
        $return_val = $this->database->get_result("SELECT * FROM $this->tableName WHERE url = $req_url_val AND status = 'publish' ");
        $return_html = "";
        $default_val = new Default_val();
        $root =  "views/";
        
        
        if( count($return_val) >= 1 ){

           
            $REQUEST_METHOD =strtolower ( $_SERVER['REQUEST_METHOD'] );
            $path = $root.$return_val[0]['path_view'];
            $req_method = explode(",",$return_val[0]['request_type']);

            if(!in_array($REQUEST_METHOD , $req_method)){
                echo " Request type is incorrect !"; 
                exit;
            }

            $return_html = $path;
            // if(file_exists($path)){
            //     //$return_html =  file_get_contents($path);
            //     $return_html = $path;
            // }else{

            //     $return_val = $this->database->get_result("SELECT * FROM $this->tableName WHERE url = '/404' AND status = 'publish' ");
            //     $path = $root.$return_val[0]['path_view'];
            //     $return_html = $path;

            //     //$content = file_get_contents($root."views/404.php");
            //     //$return_html =  eval($content);
                
            // }
            
        }
        else{
           
            $return_val = $this->database->get_result("SELECT * FROM $this->tableName WHERE url = '/404' AND status = 'publish' ");
            $path = $root.$return_val[0]['path_view'];
            $return_html = $path;


        }
        return $return_html;

    }catch (Exception $ex) {
        return $ex;
    }
    }
}
