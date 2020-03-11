<?php
ob_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\Dotenv\Dotenv;

$main_path = json_decode(file_get_contents(dirname(dirname(__DIR__)) . "/default.json"), true);
$root_dir = str_replace('\\','/',dirname(dirname(__DIR__)));
if ($root_dir != $main_path['site_dir']) {
    
    $main_path['site_dir'] = $root_dir;
    $json = json_encode($main_path,JSON_PRETTY_PRINT);
    file_put_contents(dirname(dirname(__DIR__)) . "/default.json",$json);
    $main_path = json_decode(file_get_contents(dirname(dirname(__DIR__)) . "/default.json"), true);
}
$_ENV =  $main_path;
// echo "<pre>";
// print_r($_SERVER);
// exit;
// function dd($var)
// {
//     dump($var);
//     die();
// }

function base_url()
{
    $current_url = getCurrentUrl();
    $SCRIPT_NAME = explode('/', $_SERVER['SCRIPT_NAME']);
    array_pop($SCRIPT_NAME);
    $SCRIPT_NAME = implode('/', $SCRIPT_NAME);
    $base_url = $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$SCRIPT_NAME}";
    if ($current_url != "/") {
        $base_url = str_replace($current_url, "", $base_url) . "/";
        return $base_url;
    }
    else{
        return $base_url.'/';
    }
    
}
// echo "<pre>";
// print_r(base_url());
// exit;
function base_url_route($route)
{
    $url = $route;
    $firstCharacter = $route[0];
    if ($firstCharacter == '/' || $firstCharacter == '\\') {
        $url = substr($url, 1);
    }
    $current_url = base_url() . $url;
    return $current_url;
}
function pd($var)
{
    echo "<pre>";
    print_r($var);
    echo "<pre>";
    die;
}
function RootPath()
{
    $default_val = new Lib\Classes\Default_val();
    return $default_val->getRootPath() . "/";
}
function GetStorePath()
{
    return RootPath() . "stroage";
}
function defaultVal()
{
    $default_val = new Lib\Classes\Default_val();
    return $default_val->get_all_info();
}
function urlFinder()
{
    if (!empty($_SERVER['PATH_INFO'])) {
        return  $_SERVER['PATH_INFO'];
    }
    if (empty($_SERVER['REDIRECT_URL'])) {
        return  '';
    }
    $SCRIPT_NAME = $_SERVER['SCRIPT_NAME'];
    $REDIRECT_URL = explode('/', $_SERVER['REDIRECT_URL']);
    $url = "";
    foreach ($REDIRECT_URL as $value) {
        $ext = pathinfo($value, PATHINFO_EXTENSION);
        if ($ext != "") {
            $url = "/404";
            break;
        }
    }
    if (empty($url)) {
        $SCRIPT_NAME = explode('/', $SCRIPT_NAME);
        array_pop($SCRIPT_NAME);
        $SCRIPT_NAME = implode('/', $SCRIPT_NAME);
        $url = str_replace($SCRIPT_NAME, "", $_SERVER['REDIRECT_URL']);
    }
    return $url;
}

function getCurrentUrl()
{

    $url = urlFinder();
    // if (isset($_GET['url'])) {
    //     $url = "/" . $_GET['url'];
    // } else {
    //     $url = "/";
    // }
    if (!empty($url)) {
        $url = $url;
    } else {
        $url = "/";
    }
    return $url;
}

function GetMessage($key)
{
    $value = "";
    if (isset($_SESSION['message'][$key])) {
        $value = $_SESSION['message'][$key];
    }
    return $value;
}
function SetMessage($key, $value)
{
    return $_SESSION['message'][$key] = $value;
}
function GetError($key)
{
    $value = "";
    if (isset($_SESSION['error_message'][$key])) {
        $value = $_SESSION['error_message'][$key];
    }
    return $value;
}

function SetError($key, $value)
{
    return $_SESSION['error_message'][$key] = $value;
}
function GetOldInput($key)
{
    $value = "";
    if (isset($_SESSION['old_input'][$key])) {
        $value = $_SESSION['old_input'][$key];
    }
    return $value;
}
function SetOldInput($key, $value)
{
    return $_SESSION['old_input'][$key] = $value;
}
function SetSession($key, $value)
{
    return $_SESSION[$key] = $value;
}
function GetSession($key, $default = "")
{
    $value = $default;
    if (isset($_SESSION[$key])) {
        $value = $_SESSION[$key];
    }
    return $value;
}
function UnsetSession($key)
{
    unset($_SESSION[$key]);
}

function GetCookie($key)
{
    $value = "";
    if (isset($_COOKIE[$key])) {
        $value = $_COOKIE[$key];
    }
    return $value;
}
function UnsetCookie($key)
{
    return;
}
function ENV($key, $default = "")
{
    $value = $default;
    if (isset($_ENV[$key])) {
        $value = $_ENV[$key];
    }
    return $value;
}

function GetUserCurrentVisitedUrl()
{
    $count =  count($_SESSION['user_visited_url']);
    return base_url_route($_SESSION['user_visited_url'][$count - 1]);
}
function GetUserPreviousVisitedRoute()
{
    $count =  count($_SESSION['user_visited_url']);
    return $_SESSION['user_visited_url'][$count - 1];
}
function GetUserPreviousVisitedUrl()
{
    $count =  count($_SESSION['user_visited_url']);
    return base_url_route($_SESSION['user_visited_url'][$count - 2]);
}
function engine($code, $varirble = array())
{
    $loader = new \Twig\Loader\ArrayLoader([
        'index' => $code,
    ]);
    $twig = new \Twig\Environment($loader);
    return $twig->render('index', $varirble);
}
function viewPath($path)
{
    $url = $path;
    $firstCharacter = $path[0];
    if ($firstCharacter != '/') {
        $url = '/'.$path;
    }
    $current_url =  $_ENV['site_dir'].$_ENV['view_dir'].$url;
    return $current_url;
}
function MailSend($ToEmail, $subject, $body, $FromEmail = "test@example.com")
{
    $mail = new PHPMailer(true);
    $mail_sent_info = ENV('mail_setup');
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = $mail_sent_info['host_name'];                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = $mail_sent_info['user_name'];                     // SMTP username
        $mail->Password   = $mail_sent_info['password'];                               // SMTP password
        $mail->SMTPSecure =  $mail_sent_info['SMTPSecure'];         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = $mail_sent_info['port'];                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($FromEmail, '');
        $mail->addAddress($ToEmail, '');     // Add a recipient
        //$mail->addAddress('ellen@example.com');               // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function custom_crypt( $string, $action = 'e' ) {
    $secret_key = 'secret_key';
    $secret_iv = 'secret_iv';
 
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
 
    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }
 
    return $output;
}
function input_validation($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function mime2ext($mime){
    $all_mimes = '{"png":["image\/png","image\/x-png"],"bmp":["image\/bmp","image\/x-bmp","image\/x-bitmap","image\/x-xbitmap","image\/x-win-bitmap","image\/x-windows-bmp","image\/ms-bmp","image\/x-ms-bmp","application\/bmp","application\/x-bmp","application\/x-win-bitmap"],"gif":["image\/gif"],"jpeg":["image\/jpeg","image\/pjpeg"],"xspf":["application\/xspf+xml"],"vlc":["application\/videolan"],"wmv":["video\/x-ms-wmv","video\/x-ms-asf"],"au":["audio\/x-au"],"ac3":["audio\/ac3"],"flac":["audio\/x-flac"],"ogg":["audio\/ogg","video\/ogg","application\/ogg"],"kmz":["application\/vnd.google-earth.kmz"],"kml":["application\/vnd.google-earth.kml+xml"],"rtx":["text\/richtext"],"rtf":["text\/rtf"],"jar":["application\/java-archive","application\/x-java-application","application\/x-jar"],"zip":["application\/x-zip","application\/zip","application\/x-zip-compressed","application\/s-compressed","multipart\/x-zip"],"7zip":["application\/x-compressed"],"xml":["application\/xml","text\/xml"],"svg":["image\/svg+xml"],"3g2":["video\/3gpp2"],"3gp":["video\/3gp","video\/3gpp"],"mp4":["video\/mp4"],"m4a":["audio\/x-m4a"],"f4v":["video\/x-f4v"],"flv":["video\/x-flv"],"webm":["video\/webm"],"aac":["audio\/x-acc"],"m4u":["application\/vnd.mpegurl"],"pdf":["application\/pdf","application\/octet-stream"],"pptx":["application\/vnd.openxmlformats-officedocument.presentationml.presentation"],"ppt":["application\/powerpoint","application\/vnd.ms-powerpoint","application\/vnd.ms-office","application\/msword"],"docx":["application\/vnd.openxmlformats-officedocument.wordprocessingml.document"],"xlsx":["application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application\/vnd.ms-excel"],"xl":["application\/excel"],"xls":["application\/msexcel","application\/x-msexcel","application\/x-ms-excel","application\/x-excel","application\/x-dos_ms_excel","application\/xls","application\/x-xls"],"xsl":["text\/xsl"],"mpeg":["video\/mpeg"],"mov":["video\/quicktime"],"avi":["video\/x-msvideo","video\/msvideo","video\/avi","application\/x-troff-msvideo"],"movie":["video\/x-sgi-movie"],"log":["text\/x-log"],"txt":["text\/plain"],"css":["text\/css"],"html":["text\/html"],"wav":["audio\/x-wav","audio\/wave","audio\/wav"],"xhtml":["application\/xhtml+xml"],"tar":["application\/x-tar"],"tgz":["application\/x-gzip-compressed"],"psd":["application\/x-photoshop","image\/vnd.adobe.photoshop"],"exe":["application\/x-msdownload"],"js":["application\/x-javascript"],"mp3":["audio\/mpeg","audio\/mpg","audio\/mpeg3","audio\/mp3"],"rar":["application\/x-rar","application\/rar","application\/x-rar-compressed"],"gzip":["application\/x-gzip"],"hqx":["application\/mac-binhex40","application\/mac-binhex","application\/x-binhex40","application\/x-mac-binhex40"],"cpt":["application\/mac-compactpro"],"bin":["application\/macbinary","application\/mac-binary","application\/x-binary","application\/x-macbinary"],"oda":["application\/oda"],"ai":["application\/postscript"],"smil":["application\/smil"],"mif":["application\/vnd.mif"],"wbxml":["application\/wbxml"],"wmlc":["application\/wmlc"],"dcr":["application\/x-director"],"dvi":["application\/x-dvi"],"gtar":["application\/x-gtar"],"php":["application\/x-httpd-php","application\/php","application\/x-php","text\/php","text\/x-php","application\/x-httpd-php-source"],"swf":["application\/x-shockwave-flash"],"sit":["application\/x-stuffit"],"z":["application\/x-compress"],"mid":["audio\/midi"],"aif":["audio\/x-aiff","audio\/aiff"],"ram":["audio\/x-pn-realaudio"],"rpm":["audio\/x-pn-realaudio-plugin"],"ra":["audio\/x-realaudio"],"rv":["video\/vnd.rn-realvideo"],"jp2":["image\/jp2","video\/mj2","image\/jpx","image\/jpm"],"tiff":["image\/tiff"],"eml":["message\/rfc822"],"pem":["application\/x-x509-user-cert","application\/x-pem-file"],"p10":["application\/x-pkcs10","application\/pkcs10"],"p12":["application\/x-pkcs12"],"p7a":["application\/x-pkcs7-signature"],"p7c":["application\/pkcs7-mime","application\/x-pkcs7-mime"],"p7r":["application\/x-pkcs7-certreqresp"],"p7s":["application\/pkcs7-signature"],"crt":["application\/x-x509-ca-cert","application\/pkix-cert"],"crl":["application\/pkix-crl","application\/pkcs-crl"],"pgp":["application\/pgp"],"gpg":["application\/gpg-keys"],"rsa":["application\/x-pkcs7"],"ics":["text\/calendar"],"zsh":["text\/x-scriptzsh"],"cdr":["application\/cdr","application\/coreldraw","application\/x-cdr","application\/x-coreldraw","image\/cdr","image\/x-cdr","zz-application\/zz-winassoc-cdr"],"wma":["audio\/x-ms-wma"],"vcf":["text\/x-vcard"],"srt":["text\/srt"],"vtt":["text\/vtt"],"ico":["image\/x-icon","image\/x-ico","image\/vnd.microsoft.icon"],"csv":["text\/x-comma-separated-values","text\/comma-separated-values","application\/vnd.msexcel"],"json":["application\/json","text\/json"]}';
    $all_mimes = json_decode($all_mimes,true);
    foreach ($all_mimes as $key => $value) {
      if(array_search($mime,$value) !== false) return $key;
    }
    return false;
  }
function slugify($text)
{
  
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  $text = preg_replace('~[^-\w]+~', '', $text);

  $text = trim($text, '-');

  $text = preg_replace('~-+~', '-', $text);

  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}
function upload_libary($binary_file)
{
    $store_path = $_ENV['site_dir'].$_ENV['stroage_path'];
    $validator = new FileUpload\Validator\Simple($_ENV['max_upload_file_size'] , $_ENV['upload_file_excepted']);

    $pathresolver = new FileUpload\PathResolver\Simple($store_path);

    $slugGenerator = new FileUpload\FileNameGenerator\Slug();
  
    $filesystem = new FileUpload\FileSystem\Simple();

    $fileupload = new FileUpload\FileUpload($binary_file, $_SERVER);
  
    $fileupload->setFileNameGenerator($slugGenerator);
    $fileupload->setPathResolver($pathresolver);
    $fileupload->setFileSystem($filesystem);
    $fileupload->addValidator($validator);
    
    // Doing the deed
    list($files, $headers) = $fileupload->processAll();
    $result = json_decode(json_encode(['files' => $files]),true);
    $result = $result['files'];
    $i = 0;
    foreach($files as $file){
        //Remeber to check if the upload was completed
        if ($file->completed) {
             $result[$i]['file_name'] = $file->getFilename();
             $result[$i]['real_path'] =  $file->getRealPath();
             $result[$i]['stored_path'] =  $file->getPath();
             $result[$i]['stored_relative'] =  $_ENV['stroage_path'];
             $result[$i]['file_extension'] = $file->getExtension();
        }
        $i++;
    }
    return $result;
}
function upload_raw($binary_file){
    $target_dir = $_ENV['site_dir'].$_ENV['stroage_path'];
    
    $file_name = basename($binary_file["name"]);
    
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uniq = uniqid();
    $target_file = $target_dir.'/'.$uniq.".$imageFileType";
    $relative_path = $_ENV['stroage_path'].'/'.$uniq.".$imageFileType";
    if (move_uploaded_file($binary_file["tmp_name"], $target_file)) {
        return array(
            'error'         => 0,
            "base_path"     => $target_file,
            'relative_path' => $relative_path ,
        );
      
    } else {
        return array(
            'error'         => 1,
            "base_path"     => '',
            'relative_path' => '' ,
        );
    }
}