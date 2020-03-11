<?php
UnsetSession('user_id');
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Signup | Sahajjo</title>

	<?php include_once __DIR__.'/include/script-head.php'; ?>

<style>
    	body{
	    margin:0px;
	}
</style>
</head>

<body>

<!--
	<div class="container-home">
		<div class="row m-0 container-home color1-color3-bg " style="height: 100vh">
			<div class="row w-100 align-items-center mt-5" style="height: fit-content;">
				<div class="col-sm-6 col-12 d-flex justify-content-end align-items-start p-0">
					<img src="images/sahajjo.png" class="logo-200" alt="">
				</div>
				<div class="col-sm-6 col-12 d-flex justify-content-start align-items-start">
					<h2 class="mt-2 mb-0 ml-3 color1">Sign Up</h2>
				</div>

			</div>
			<div class="row border-all shadow rad-30 color1-bg justify-content-center h-50 mx-auto w-50 d-flex align-items-center justify-content-center mt-0">
				<?php echo GetMessage('message') ?>
				<br>
				<form action="<?php echo base_url_route('signup-post'); ?>" class="w-100 p-4" method="post">
					<div class="form-group">
						<label for="exampleInputFirstName">First Name</label>
						<input type="text" class="form-control" id="exampleInputFirstName" name="fname" placeholder="First Name" required>
						<small id="emailHelp" class="form-text text-muted"> <?php echo GetError('fname') ?></small>
					</div>
					<div class="form-group">
						<label for="exampleInputFirstName">Last Name</label>
						<input type="text" class="form-control" id="exampleInputFirstName" name="lname"  placeholder="Last Name" required>
						<small id="emailHelp" class="form-text text-muted"> <?php echo GetError('lname') ?></small>
					</div>
					<div class="form-group ">
						<label for="exampleInputEmail1">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
						<small id="emailHelp" class="form-text text-muted"> <?php echo GetError('email') ?></small>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
						<small id="emailHelp" class="form-text text-muted"> <?php echo GetError('password') ?></small>
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Confirm Password</label>
						<input type="password" class="form-control" id="exampleInputPassword1" name="confirm_password"  placeholder="Confirm Password" required>
						<small id="emailHelp" class="form-text text-muted"><?php echo GetError('confirm_password') ?> </small>
					</div>
					
					<input type="hidden" name="from_submit_base_url" value="<?php echo base_url_route('sign-up'); ?>">
					<input type="hidden" name="from_type" value="<?php echo"signup_form"; ?>">
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>



		</div>

	</div>

-->
	<div class="container-home">
		<div class="row m-0 container-home color1-color3-bg " style="min-height: 100vh">
			<div class="row w-100 align-items-center m-0 mt-md-5 mt-4 mb-4" style="height: fit-content;">
				<div class="col-md-6 col-12 d-flex justify-content-md-end align-items-start justify-content-center p-0">
					<img src="images/sahajjo.png" class="logo-200" alt="">
				</div>
				<div class="col-md-6 col-12 d-flex justify-content-md-start justify-content-center align-items-start">
					<h2 class="color1 text-uppercase login-text mb-0 ">Sign Up</h2>
				</div>

			</div>
			<div class="row border-all shadow rad-30 color1-bg justify-content-center h-50 mx-auto form-box d-flex align-items-center justify-content-center mt-0 mb-5">
				<?php echo GetMessage('message') ?>
				<br>
				<form action="<?php echo base_url_route('signup-post'); ?>" class="w-100 p-4 p-md-5" method="post">
					<div class="form-group border">
						<label class="border-bottom label-modify" for="exampleInputFirstName">First Name</label>
						<input type="text" class="form-control" id="exampleInputFirstName" name="fname" placeholder="First Name" required>
						<small id="emailHelp" class="form-text text-muted"> <?php echo GetError('fname') ?></small>
					</div>
					<div class="form-group border">
						<label class="border-bottom label-modify" for="exampleInputFirstName">Last Name</label>
						<input type="text" class="form-control" id="exampleInputFirstName" name="lname"  placeholder="Last Name" required>
						<small id="emailHelp" class="form-text text-muted"> <?php echo GetError('lname') ?></small>
					</div>
					<div class="form-group border">
						<label class="border-bottom label-modify" for="exampleInputEmail1">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
						<small id="emailHelp" class="form-text text-muted"> <?php echo GetError('email') ?></small>
					</div>
					<div class="form-group border">
						<label class="border-bottom label-modify" for="exampleInputPassword1">Password</label>
						<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password" required>
						<small id="emailHelp" class="form-text text-muted"> <?php echo GetError('password') ?></small>
					</div>
					<div class="form-group border">
						<label class="border-bottom label-modify" for="exampleInputPassword1">Confirm Password</label>
						<input type="password" class="form-control" id="exampleInputPassword1" name="confirm_password"  placeholder="Confirm Password" required>
						<small id="emailHelp" class="form-text text-muted"><?php echo GetError('confirm_password') ?> </small>
					</div>
					
					<input type="hidden" name="from_submit_base_url" value="<?php echo base_url_route('sign-up'); ?>">
					<input type="hidden" name="from_type" value="<?php echo"signup_form"; ?>">
					<button type="submit" class="btn btn-primary color2-btn color2-btn-hover mt-4 mid-btn d-flex mx-auto justify-content-center">Submit</button>
					<h6 class="color2 text-center mt-5">Already have an account? <a class="color3" href="<?php echo base_url_route('login'); ?>">Login</a></h6>
				</form>
			</div>



		</div>




	</div>

		<?php include_once __DIR__ . '/include/footer.php'; ?>


<?php include_once __DIR__.'/include/script-bottom.php'; ?>
<!--
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
	-->
</body>

</html>