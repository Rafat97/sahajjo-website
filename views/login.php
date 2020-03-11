<?php
UnsetSession('user_id');
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Login | Sahajjo</title>

	<?php include_once __DIR__.'/include/script-head.php'; ?>
<style>
    	body{
	    margin:0px;
	}
</style>

</head>

<body>


	<div class="container-home">
		<div class="row m-0 container-home color1-color3-bg " style="min-height: 100vh">
			<div class="row w-100 align-items-center m-0 mt-md-5 mt-4" style="height: fit-content;">
				<div class="col-md-6 col-12 d-flex justify-content-md-end align-items-start justify-content-center p-0">
					<img src="images/sahajjo.png" class="logo-200" alt="">
				</div>
				<div class="col-md-6 col-12 d-flex justify-content-md-start justify-content-center align-items-start">
					<h2 class="color1 text-uppercase login-text mb-0 ">Login</h2>
				</div>

			</div>
			<div class="row border-all shadow rad-30 color1-bg justify-content-center h-50 mx-auto form-box d-flex align-items-center justify-content-center mt-0">
				<br>
				<?php echo GetMessage('message') ?>
    			<br>
				<form class="w-100 p-4 p-md-5" action="<?php echo base_url_route('/login-post') ?>" id="Login" method="post">
					<div class="form-group border">
						<label class="border-bottom label-modify" for="exampleInputEmail1">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1" autocomplete="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
					</div>
					<div class="border form-group">
						<label class="border-bottom label-modify" for="exampleInputPassword1">Password</label>
						<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" autocomplete="new-password" name="password" required>
					</div>

					<input type="hidden" name="from_submit_base_url" value="<?php echo base_url_route('login'); ?>">
        			<input type="hidden" name="from_type" value="<?php echo"login_form"; ?>">
					<button type="submit" class="btn btn-primary color2-btn color2-btn-hover mt-4 mid-btn d-flex mx-auto justify-content-center">Submit</button>
					<h6 class="color2 text-center mt-5">Don't have an account? <a class="color3" href="<?php echo base_url_route('sign-up'); ?>">Sign Up</a></h6>
				</form>
			</div>



		</div>




	</div>


		<?php include_once __DIR__ . '/include/footer.php'; ?>



<?php include_once __DIR__.'/include/script-bottom.php'; ?>
	<script>
		function openNav() {
			document.getElementById("mySidebar").style.width = "250px";
			document.getElementsByClassName("openbtn").style.display = "none";
			document.getElementById("main").style.marginLeft = "0px";
		}

		function closeNav() {
			document.getElementById("mySidebar").style.width = "0px";
			document.getElementById("main").style.marginLeft = "0px";
			document.getElementsByClassName("openbtn").style.display = "block";
		}
	</script>

</body>

</html>