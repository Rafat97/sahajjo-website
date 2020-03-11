<?php
session_start();
$value = json_decode(file_get_contents('../imp/info_config.json') , true);
$default_value =json_decode(file_get_contents($value['default_file_dir'].'../default.json') , true);
$db_info = $default_value['db_info'];
//require_once ('action.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Framework installation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron ">
        <H1>Framework installation</H1> 
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-3">
        <div class="jumbotron ">
        <a href="#main_content_database">
            <p> Database setting </p> 
        </a>
        <a href="../user">
            <p> User setting </p> 
        </a>
        <a href="../user?url=home">
            <p> Route setting </p> 
        </a>
        </div>
    </div>
    <div class="col-sm-9" >




    <div id="main_content_database">
    <?php if(isset($_SESSION['error_message_single']) ) { 
        echo '<div class="alert alert-success" id="error_message"> <button type="button" class="close" data-dismiss="alert">&times;</button>'.$_SESSION['error_message_single'].'</div>' ; 
    } 
    ?>
        <h3>Database Info</h3>
        <form action="action.php" method="post">

            <input name="form_type" id="" type="hidden" value="database_setting">
            <input name="form_type_requested_url" id="" type="hidden" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
            <div class="form-group">
                <label for="host_name">Host Name:</label>
                <input type="text"  class="form-control" id="host_name" name="host_name" value="<?php echo $db_info['host_name']; ?>">
            </div>
            <div class="form-group">
                <label for="user_name">Database User Name:</label>
                <input type="text" required class="form-control" id="user_name" name="user_name" value="<?php echo $db_info['user_name']; ?>">
            </div>
            <div class="form-group">
                <label for="password">Database password :</label>
                <input type="text"  class="form-control" id="password" name="password" value="<?php echo $db_info['password']; ?>">
            </div>
            <div class="form-group">
                <label for="database_name">Database Name:</label>
                <input type="text"  required  class="form-control" id="database_name" name="database_name" value="<?php echo $db_info['db_name']; ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
        



    </div>
  </div>
</div>



</body>
</html>

<?php
unset($_SESSION['error_message_single']);