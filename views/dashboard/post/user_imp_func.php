<?php

$default_user_image_val = "https://i.imgur.com/0RY16xR.png";
$user_all_value = array();

function get_user( $id , $database_connection )
{
    $sql = "SELECT * FROM `user` where `user`.`id` =  '$id'";
    $result = $database_connection->get_result($sql);
    return $result[0];
}

function get_user_meta($user_id , $key  ,$database_connection, $default_value="" )
{
    $tableName = "user_meta";
    $builder = new NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder();
    $query = $builder->select()->setTable($tableName)
        ->where()
        ->equals('user_id', "$user_id")
        ->equals('key_name', "$key")
        ->end();
    $sql = $builder->write($query);
    $values = $builder->getValues();
    $value = $database_connection->select_prepare($sql, $values);
    if (count($value) >= 1) {
       return empty($value[0]['value']) ? $default_value: $value[0]['value'];
    }else{
        $data = array(
            "user_id" => "$user_id",
            "key_name" => "$key",
            "value" => "",
        );
        $lastid = $database_connection->insert($tableName, $data);
        return get_user_meta($user_id , $key , $database_connection , $default_value);
    }
}
function update_user_meta($user_id , $key , $value ,$database_connection )
{
    $tableName = "user_meta";
    $builder = new NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder();
    $query = $builder->select()->setTable($tableName)
        ->where()
        ->equals('user_id', "$user_id")
        ->equals('key_name', "$key")
        ->end();
    $sql = $builder->write($query);
    $values = $builder->getValues();
    $getvalue = $database_connection->select_prepare($sql, $values);
    if (count($getvalue) >= 1) {
       $id = $getvalue[0]['id'];
       $query = $builder->update()
                ->setTable($tableName)
                ->setValues([
                    'value' => $value,
                ])
                ->where()
                ->equals('id',$id)
                ->end();
        $sql = $builder->writeFormatted($query);    
        $values = $builder->getValues();
        $update = $database_connection->select_prepare($sql, $values);
        //print_r($update);
    }else{
        $data = array(
            "user_id" => "$user_id",
            "key_name" => "$key",
            "value" => "$value",
        );
        $lastid = $database_connection->insert($tableName, $data);
        return 1 ;
    }
}