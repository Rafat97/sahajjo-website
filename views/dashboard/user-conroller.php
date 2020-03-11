<?php

include_once __DIR__.'/post/user_imp_func.php';

$login_user_id = GetSession('user_id');
$url = base_url_route('login');

if (empty($login_user_id)) {
    UnsetSession('user_id');
    header("Location: $url");
    exit;
} else {
    $login_user_id = custom_crypt($login_user_id, 'd');
    
    $builder = new NilPortugues\Sql\QueryBuilder\Builder\GenericBuilder();
    $query = $builder->select()->setTable('user')
        ->where()
        ->equals('id', $login_user_id)
        ->end();
    $sql = $builder->write($query);
    $values = $builder->getValues();
    $value = $fmw_database->select_prepare($sql, $values);
    $user_all_value = $value[0];
    if (count($value) >= 1) {
       
    } else {
        UnsetSession('user_id');
        header("Location: $url");
        exit;
    }
}
$display_name = get_user_meta($login_user_id, 'user_display_name', $fmw_database, $user_all_value['user_firstName'].' '.$user_all_value['user_lastName']);
$catagory_all = $fmw_database->get_result("SELECT id FROM `category` ORDER BY `category`.`id` ASC");
$catagory = array();
foreach ($catagory_all as  $value) {
    array_push($catagory , $value['id']);
    break;
}
$catagory = implode(',',$catagory);
$get_user_login = get_user_meta($login_user_id, 'user_login_count', $fmw_database, 0);
$get_image_url = get_user_meta($login_user_id, 'profile_pic', $fmw_database, '');
$catagory_preferable = get_user_meta($login_user_id, 'user_catagory_preferable', $fmw_database, "$catagory");

$user_all_value['profile_pic'] = (empty($get_image_url)) ? $default_user_image_val : base_url_route( $get_image_url );
$user_all_value['catagory_preferable'] = $catagory_preferable;