<?php

namespace Lib\Classes;

class Default_val
{
    public $path;
    public $json_value;

    function __construct()
    {
        $this->path = $this->getDefaultPath() ;
        $this->json_value = json_decode(file_get_contents($this->path) , true);
    }
    function get_db_info()
    {
        $database  = new DB();
        $database->setHostName($this->json_value['db_info']['host_name']);
        $database->setUserName($this->json_value['db_info']['user_name']);
        $database->setPassWord($this->json_value['db_info']['password']);
        $database->setDbName($this->json_value['db_info']['db_name']);
        $database->connection_mysql();
        return $database;
    }

    function get_all_info()
    {
       return $this->json_value;
    }
    function getDefaultPath()
    {
        // $val = explode("/",$_SERVER['SCRIPT_FILENAME']);
        // $val[count($val) - 1] = "default.json";
        // $val = implode("/",$val);
        $val = dirname(dirname(__DIR__))."/default.json";
        return $val;
    }
    function getRootPath()
    {
        $val = explode("/",$_SERVER['SCRIPT_FILENAME'],-1);
        $val = implode("/",$val);
        return $val;
    }
}
