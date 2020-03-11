<?php
require_once ('action.php');
$value = "";
$user_ID = "";

if(isset($_SESSION['CURRENT_USER'])){
    $user_ID = $_SESSION['CURRENT_USER'] ;
    //header('Location: '.$_SERVER['REQUEST_URI']."main/");
}
$value = $db->get_result("SELECT * FROM `config_access` " );


if ( ! $db->TableExist('config_access')) {
  echo "Install First <a href='../install'>here</a>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv=“Pragma” content=”no-cache”>
  <meta http-equiv=“Expires” content=”-1″>
  <meta http-equiv=“CACHE-CONTROL” content=”NO-CACHE”>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" ></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script>


 <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css"/>

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
 <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>
 
  
 
</head>
<body>

<?php 

if(!isset($_SESSION['CURRENT_USER'])):
    if(count($value) >= 1) :
?>
<div class="container">
  <h2>Login form</h2>
  <form action="" method="post">
    <input name="form_type"  type="hidden" value="login_user">
    <input name="form_type_requested_url"  type="hidden" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
  
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<?php endif;?>

<?php if(count($value) <= 0) :?>
<div class="container">
  <h2>Creat New User </h2>
  <form action="" method="post">
    <input name="form_type"  type="hidden" value="creat_user">
    <input name="form_type_requested_url"  type="hidden" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
    <div class="form-group">
      <label for="username">User Name:</label>
      <input type="text" required class="form-control" id="username" placeholder="Enter email" name="username">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" required class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" required class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
    <?php endif;?>


    <?php else :
          if(isset($_GET['url']) && !empty($_GET['url'])){
            if($_GET['url'] == "home"){
              
              include_once("include/main-nav.php");
              include_once("include/home.php");
              include_once("include/main-foot.php");
              exit;
            }
            if($_GET['url'] == "file_edit"){
              $id = $_GET['id'];
              $path = $_GET['path_val'];
              $path = base64_encode($default_value_config['default_file_dir'].$path) ;
              //echo $path ;

              header('Location: file_edit?file='.$path.'&type=edit');
              exit;
            }
            else{
              include_once("include/main-nav.php");
              include_once("include/404.php");
              include_once("include/main-foot.php");
              exit;
            }
            
          }else{
              header('Location: '.$_SERVER['REQUEST_URI']."?url=home");
          }
            
      ?>
      
<?php endif;?>
</body>
</html>
