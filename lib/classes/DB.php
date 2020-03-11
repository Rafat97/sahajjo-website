<?php

namespace Lib\Classes;

use PDO;

class DB 
{
    private $host_name = "";
    private $user_name = "";
    private $password = "";
    private $db_name = "";
    private $connection;

    function __construct()
    {
    }

   
    function setHostName($value){
        $this->host_name = $value;
    }
    function getHostName(){
        echo $this->host_name;
    }
    function setUserName($value){
        $this->user_name = $value;
    }
    function getUserName(){
        echo $this->user_name;
    }
    function setPassWord($value){
        $this->password = $value;
    }
    function getPassWord(){
        echo $this->password;
    }
    function setDbName($value){
        $this->db_name = $value;
    }
    function getDbName(){
        echo $this->db_name;
    }
    function isConnection(){
        try {
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->connection = new PDO("mysql:host=$this->host_name;dbname=$this->db_name", $this->user_name , $this->password , $options);
            return true;
        }catch(\Exception $e){
            return false;
        }
    }
    function create($host,$user,$password,$db_name)
    {
        $this->setHostName($host);
        $this->setUserName($user);
        $this->setPassWord($password);
        $this->setDbName($db_name);
        $this->isConnection();
        return $this->connection;
    }
    public function connection_mysql() {
        try {
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $this->connection = new PDO("mysql:host=$this->host_name;dbname=$this->db_name", $this->user_name , $this->password , $options);
            return "Connected successfully"; 
        }catch(\Exception $e){
            return "Connection failed: " . $e->getMessage();
        }
           
    }

    function input_validation_database($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data =  $this->connection->quote($data);
        return $data;
    }
    public function is_execute($sql) {
        try {
            
            $conn = $this->connection;
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec($sql);
            return true;
        }catch(\Exception $e){
            return false;
        }
           
    }
    public function execute($sql) {
        try {
            
            $conn = $this->connection;
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec($sql);
            return "Execute successfully ".$conn->exec($sql);
        }catch(\Exception $e){
            return "Execute failed because" . $e->getMessage();
        }
    }
    public function insert($tableName , $data = array() ) {
        try {
            $fields = array();
            $info = array();
            $bindParamfields = array();
            foreach($data as $key => $value ){
                array_push($fields,$key); 
                array_push($bindParamfields,"?"); 
                array_push($info,$value); 
            }
            $fields_value = implode(", ",$fields);
            $info_value = implode(", ",$info);

            $bindParamfields = implode(",",$bindParamfields);

            $conn = $this->connection;
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO $tableName (".$fields_value.") 
            VALUES (".$bindParamfields.")";

            $stmt = $conn->prepare($sql , array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

            $stmt->execute($info);
            return $conn->lastInsertId();
        }catch(\Exception $e){
            return "Execute failed because" . $e->getMessage();
        }
    }


    public function select_table($table) {
        try {
            $conn = $this->connection;
            $stmt = $conn->prepare("SELECT * FROM $table"); 
            $stmt->execute();
        
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
            return $stmt->fetchAll();

        }catch(\Exception $e){
            return "Execute failed because" . $e->getMessage();
        }
           
    }

    public function select_prepare($sql, $value = array()) {
        try {
            $conn = $this->connection;
            $stmt = $conn->prepare($sql); 
            $stmt->execute($value);
        
            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
            
            return $stmt->fetchAll();
            
        }catch(\Exception $e){
            return "Execute failed because" . $e->getMessage();
        }
           
    }

    public function get_result($sql , $return_type="ARRAY") {
        try {
            if($return_type == "ARRAY"){
                $conn = $this->connection;
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                return $stmt->fetchAll();
            }
            elseif($return_type="JSON"){
                $conn = $this->connection;
                $stmt = $conn->prepare($sql); 
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                $val = $stmt->fetchAll();
                return json_encode($val);
            }
            
        }catch(\Exception $e){
            return array();
            //return $e;
        }
           
    }


    public function TableExist( $var = null )
    {
        try {
            $conn = $this->connection;
            $val = $conn->query('select 1 from `'.$var.'` LIMIT 1');
            return true;
        }    
        catch(\Exception $e){
            return false;
        }
    }
    
}
