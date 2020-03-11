<?php
include_once __DIR__.'/../dashboard/post/user_imp_func.php';


use Lib\Classes\SmtpMail;
use Rakit\Validation\Validator;

$form_type = $_POST['from_type'];
if ($form_type == "signup_form") {

    $url = $_POST['from_submit_base_url'];
    $tableName = 'user';
    $tableName_2 = 'user_meta';
    $validator = new Validator();

    $validation = $validator->make($_POST, [
        'fname'                 => 'required',
        'lname'                 => 'required',
        'email'                 => 'required|email',
        'password'              => 'required',
        'confirm_password'      => 'required|same:password',
    ]);
    $validation->setMessages([
        'fname:required' => 'The First Name is required ',
        'lname:required' => 'The Last Name is required ',
    ]);

    $validation->validate();
    if ($validation->fails()) {
        // handling errors
        $errors = $validation->errors();
        $variable = $errors->firstOfAll();
        foreach ($variable as $key => $value) {
            SetError($key, $value);
        }
        header("Location: $url ");
        exit;
    }
    //dd($_POST);
    $fName = $_POST['fname'];
    $lName = $_POST['lname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "select * from $tableName where user_email = ?";

    $value = $fmw_database->select_prepare($sql, array($email));

    if (count($value) >= 1) {
        SetMessage('message', "Already have this email id ");
        header("Location: $url");
        exit;
    }
    $data = array(
        "user_firstName" => $fName,
        "user_lastName" => $lName,
        "user_password" => $password,
        "user_email" => $email,
        "user_verification" => uniqid(),
        "user_status" => '0',
    );
    $lastid = $fmw_database->insert($tableName, $data);
    // $html = file_get_contents(dirname(__DIR__) . '/mail/signup_mail.php');
    // engine($html);
    // MailSend(
    //     $email,
    //     'For sign up new user',
    //     "<center><h1>Welcome</h1></center><br><br>Hi $fName ,<br><br> Thank yor for signup <br><br>From,<br>test@example.com",
    // );
    SetMessage('message', "Thank you for register . Please Login ");
    header("Location: $url");
    exit;
} elseif ($form_type == "login_form") {
    
    $email = $_POST['email'];
    $password = $_POST['password'];
    $url = $_POST['from_submit_base_url'];
    $tableName = 'user';
    $sql = "select * from $tableName where user_email = ? ";

    $value = $fmw_database->select_prepare($sql, array($email));
    if (count($value) >= 1) {
        $hash = $value[0]['user_password'];
        if (password_verify($password, $hash)) {
            $user_id = $value[0]['id'];

            SetSession('user_id', custom_crypt( $user_id ) );
            $meta_value = get_user_meta( $user_id , 'user_login_count', $fmw_database, 0);

            
            if ($meta_value == 0) {
                $url = base_url_route('dashboard/profile-edit');
                header("Location: $url");
                exit;
            }else {
                $url = base_url_route('dashboard/home');
                header("Location: $url");
                exit;
            }
          
        } else {
            SetMessage('message', 'Sorry ,You have entered an invalid email or password');
            header("Location: $url");
        }
    } else {
        SetMessage('message', 'Sorry , You have entered an invalid email or password');
        header("Location: $url");
    }
    exit;
} elseif ($form_type == "edit_profile_form") {

    
    $url = $_POST['from_submit_base_url'];
    $max_upload = $_ENV['max_upload_file_size'];
    $file_excepted = implode(',',$_ENV['upload_file_excepted_ext']) ;
    
    $validator = new Validator();

    $validation = $validator->make($_POST+$_FILES, [
        'fname'                 => 'required',
        'lname'                 => 'required',
        'email'                 => 'required|email',
        'catagoryperf'          => 'required',
        'avatar'                => "uploaded_file:0,$max_upload,$file_excepted",
    ]);
    $validation->setMessages([
        'fname:required' => 'The First Name is required ',
        'lname:required' => 'The Last Name is required ',
        'catagoryperf:required' => 'Please select at least one option',
    ]);
    echo "<pre>";
    $validation->validate();
    if ($validation->fails()) {
        // handling errors
        $errors = $validation->errors();
        $variable = $errors->firstOfAll();

        print_r($errors);
        print_r($variable);
        foreach ($variable as $key => $value) {
            SetError($key, $value);
        }
        header("Location: $url");
        exit;
    }
    
    $cat_prefarable = implode(',',$_POST['catagoryperf']);
    update_user_meta($_POST['user_id'], 'user_catagory_preferable',$cat_prefarable ,$fmw_database);
    $get_image_url = get_user_meta($_POST['user_id'], 'user_login_count', $fmw_database, 0);
    $get_image_url += 1;
    update_user_meta($_POST['user_id'], 'user_login_count', $get_image_url ,$fmw_database);
    print_r($_REQUEST);
    print_r($_GET);
    print_r($_POST);
    print_r($_FILES);
    $upload = upload_raw($_FILES['avatar']);
    if(!$upload['error']){
        print_r($upload);
        update_user_meta($_POST['user_id'], 'profile_pic', $upload['relative_path'] ,$fmw_database);
    }
    $fName = $_POST['fname'];
    $lName = $_POST['lname'];
    $email = $_POST['email'];
    update_user_meta($_POST['user_id'], 'user_display_name', $fName.' '.$lName ,$fmw_database);
    $sql = 'UPDATE user SET  user.user_firstName = ?, user.user_lastName = ?, user.user_email = ? WHERE (user.id = ?)';            
    $value = array($fName,$lName , $email , $_POST['user_id'] );
    $update = $fmw_database->select_prepare($sql, $value);     
   

    SetMessage('message', "Your profile is updated now");
    header("Location: $url");
    exit;
}
elseif ($form_type == "contact_us_form") {

    $url = $_POST['from_submit_base_url'];

    $validator = new Validator();

    $validation = $validator->make($_POST+$_FILES, [
        'fname'                 => 'required',
        'lname'                 => 'required',
        'email'                 => 'required|email',
        'description'           => 'required',
       
    ]);
    $validation->setMessages([
        'fname:required' => 'The First Name is required ',
        'lname:required' => 'The Last Name is required ',
    ]);
    $validation->validate();
    if ($validation->fails()) {
        // handling errors
        $errors = $validation->errors();
        $variable = $errors->firstOfAll();

        print_r($errors);
        print_r($variable);
        foreach ($variable as $key => $value) {
            SetError($key, $value);
        }
        header("Location: $url");
        exit;
    }
    $tableName = 'contact_us';
    $name = $_POST['fname'].' '.$_POST['lname'] ;
    $email = $_POST['email'] ;
    $data = array(
        "firstName" => input_validation( $_POST['fname'] ),
        "lastName" =>input_validation( $_POST['lname'] ),
        "email" => input_validation( $_POST['email'] ),
        "mobile" => input_validation( $_POST['mobile_number'] ),
        "message" => input_validation( $_POST['description'] ),
        
    );
    $lastid = $fmw_database->insert($tableName, $data);
    SetMessage('message', "Your for contact us");
    // MailSend(
    //     $email,
    //     'For sign up new user',
    //     "<center><h1>Welcome</h1></center><br><br>Hi $name ,<br><br> Thank yor for Contact us , <br><br>From,<br>test@example.com",
    // );
    header("Location: $url");
    exit;
}
