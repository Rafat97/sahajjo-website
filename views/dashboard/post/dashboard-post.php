<?php

include_once __DIR__.'/user_imp_func.php';


$from_type ="";
$from_get_url ="";
$get_previous_url = GetUserPreviousVisitedUrl();
if (empty($_POST['from_type']) && empty( $_POST['from_submit_base_url'])) {
    header("Location: $get_previous_url");
    exit;
}
$from_type = $_POST['from_type'];
$from_get_url = $_POST['from_submit_base_url'];


if ($from_type == 'dashboard_user_add_post_form') {

    $url = $_POST['from_submit_base_url'];
    $validator = new \Rakit\Validation\Validator();

    $validation = $validator->make($_POST, [
        'title'                     => 'required',
        'content'                   => 'required',
        'status'                    => 'required',
        'short_content'             => 'required',
        'catagory_id'               => 'required',
    ]);
    $validation->setMessages([
        'content:required' => 'Please give a description',
        'catagory_id:required' => 'Please select one catagory option',
        'short_content:required' => 'Please give a short description with in 100 character',
    ]);

    $validation->validate();
    if ($validation->fails()) {
        // handling errors
        $errors = $validation->errors();
        $variable = $errors->firstOfAll();
        foreach ($variable as $key => $value) {
            SetError($key, $value);
        }
        foreach ($_POST as $key => $value) {
            SetOldInput($key,$value);
        }
        header("Location: $url ");
        exit;
    }else {
        $user_id = custom_crypt( $_POST['user_id'] , 'd');
        $title = input_validation( $_POST['title'] );
        $slug = slugify($title);
        $count = count($fmw_database->get_result("SELECT * FROM `post` where `slug`like'%$slug%'"));
        if($count >= 1){
            $slug .='-'.$count; 
        }
        
        $content = input_validation( $_POST['content'] );
        $status = input_validation( $_POST['status'] );
        $tags = input_validation( $_POST['tags'] );
        $cat_id = input_validation( $_POST['catagory_id'] );
        $sub_cat = input_validation( $_POST['sub_cat'] );
        $short_content = input_validation( $_POST['short_content'] );
        $data = array(
            "user_id"           => $user_id,
            "catagory_id"       => $cat_id,
            "title"             => $title,
            "slug"              => $slug,
            'short_content'     => $short_content,
            "content"           => $content ,
            "status"            => $status,
            "tags"              => $tags,
        );
        $lastid = $fmw_database->insert('post', $data);
        $data = array(
            "post_id"           => $lastid,
            "key_name"          => 'sub_catagory',
            "value"             => $sub_cat,
        );
        $lastid = $fmw_database->insert('post_meta', $data);
        SetMessage('message', "Thank you for adding new post");
        header("Location: $url");
        exit;
    }
}
else if ($from_type == 'user_comment_send_form') {
    $url = $_POST['from_submit_base_url'];
    $validator = new \Rakit\Validation\Validator();

    $validation = $validator->make($_POST, [
        'comment'                     => 'required',
    ]);
    // $validation->setMessages([
    //     'comment:required' => 'Please give a description',
    // ]);

    $validation->validate();
    if ($validation->fails()) {
        // handling errors
        $errors = $validation->errors();
        $variable = $errors->firstOfAll();
        foreach ($variable as $key => $value) {
            SetError($key, $value);
        }
        foreach ($_POST as $key => $value) {
            SetOldInput($key,$value);
        }
        header("Location: $url ");
        exit;
    }else {
        print_r($_POST);
        $comment = input_validation( $_POST['comment'] );
        $current_user_info =  get_user($_POST['current_user_id'],$fmw_database);
        $posted_user_info = get_user( $_POST['posted_user_id'] , $fmw_database );
        $current_post_id = input_validation( $_POST['post_id'] );
        $data = array(
            "user_id"           => $current_user_info['id'],
            "post_id"           => $current_post_id,
            "comment_content"   => $comment	,
        );
        $lastid = $fmw_database->insert('comment', $data);
        $name = $current_user_info['user_firstName'].' '.$current_user_info['user_lastName'];
        $notification = input_validation("<a href='$url'> $name comment your post. </a>");
        $data = array(
            "user_id"               => $posted_user_info['id'],
            "notification_message"  => "$notification",
        );
        $lastid = $fmw_database->insert('notification', $data);
        //SetMessage('message', "Thank you for adding new post");
        header("Location: $url");
        exit;
    }
}