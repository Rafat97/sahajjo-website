<?php
include_once __DIR__ . '/user-conroller.php';
$all_catagory = $fmw_database->get_result("SELECT * FROM `category`  ORDER BY `category`.`id` ASC");

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Profile Edit | Sahajjo</title>

	<?php include_once __DIR__ . '/../include/script-head.php'; ?>
	<style>
		.custom-file-label::after{
			background:#2F80ED;
			color: white;
			z-index: 0;
			border:none;
			outline: 0;
		}
		.filter-box{
			display: none;
		}
		input[type=checkbox]:checked + span {
		 color:#fff !important;
		 background:#2F80ED;
		 padding: 15px;
		 min-width: 200px;
		} 
		.filter-text{
		 color:#2F80ED !important;
		 border:2px solid #2F80ED;
		 padding: 15px;
		 min-width: 200px;
		 display: inline-block;
    	text-align: center;
		}
		input[type=checkbox]:checked + .filter-text:before{
		 content: "🗹 "
		}
		.form-control:disabled, .form-control[readonly] {
		    background-color: inherit !important;
		    opacity: 1;
		}
		@media(min-width: 992px){

			.left-side{
				min-height: 100vh;
				max-width: 300px;
				overflow: hidden;
				height: 100%;
			}

		}
		@media(min-width: 768px){
			.left-side{
				min-height: 100vh;
				
			}
		}
		@media(max-width: 767px){
			.left-side{
				min-height: 30vh;
				
			}
		}
		@media(max-width: 991px){
			.left-side{
				
				max-width: 100%;
				overflow: hidden;
			}
		}
	</style>
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
</head>

<body>

	<?php include_once __DIR__ . '/include/nav-bar.php'; ?>

	<div class="">

		<div class="row m-0 container-home">


			<div class="col-lg-3 col-12 pl-sm-0 p-0">
				<div class="bg-cover bg-no-repeat profile-cover mr-auto left-side " style="">
					<div class=" color1-border rad-30 border-4 bg-cover bg-no-repeat bg-center p-4 mt-5 mx-auto" style="background-image: url(<?php echo $user_all_value['profile_pic']; ?>);max-width: 253px;height:250px">

					</div>
					<h3 class="color1 text-center mt-4"><?php echo $user_all_value['user_firstName'] . " " . $user_all_value['user_lastName']; ?></h3>
					<h5 class="color1 text-center mt-1 mb-4"> <?php echo $user_all_value['user_email']; ?></h5>

				</div>


			</div>
			<div class="col-lg-6 p-lg-0" style="min-height: 75vh">
				<?php echo GetMessage('message') ?>
				<h2 class="w-100 color3 mt-5 text-xs-center" style="font-size: 2.6em;">Set Up <span class="color2">Profile</span></h2>
				<br>
				<form action="<?php echo base_url_route('signup-post'); ?>" class="w-100 p-lg-0" method="post" enctype="multipart/form-data">
					<div class="form-group border">
						<label for="exampleInputFirstName" class="border-bottom label-modify">First Name</label>
						<input type="text" class="form-control" id="exampleInputFirstName" name="fname" placeholder="First Name" required value="<?php echo $user_all_value['user_firstName']; ?>">
						<small id="emailHelp" class="form-text text-muted"> <?php echo GetError('fname') ?></small>
					</div>
					<div class="form-group border">
						<label for="exampleInputFirstName"  class="border-bottom label-modify">Last Name</label>
						<input type="text" class="form-control" id="exampleInputFirstName" name="lname" placeholder="Last Name" required value="<?php echo $user_all_value['user_lastName']; ?>">
						<small id="emailHelp" class="form-text text-muted"> <?php echo GetError('lname') ?></small>
					</div>
					<div class="form-group border ">
						<label for="exampleInputEmail1"  class="border-bottom label-modify">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1" readonly name="email" aria-describedby="emailHelp" placeholder="Enter email" required value="<?php echo $user_all_value['user_email']; ?>">
						<small id="emailHelp" class="form-text text-muted"> <?php echo GetError('email') ?></small>
					</div>
					<div class="form-group  ">
						<label for="customFile"  class=" label-modify">Upload profile picture</label>
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="customFile" name="avatar">
							<label class="custom-file-label" for="customFile">Choose file</label>
						</div>
						<small id="avatarHelp" class="form-text text-muted"> <?php echo GetError('avatar') ?></small>
					</div>

					<div class="form-group">
						<label for="customFile" class="margin-50px-tb w-100 text-center " style="font-size: 1.75em">Choose your preferable catagory</label>
						<div class="mt-1">
							<div class="row">
							<?php 
							$i = 0;
							foreach ($all_catagory as $value) :
								
								?>
								
									<?php if ($i%2 == 0) : ?>
									<div class="col-md-6">
										<p class="margin-35px-bottom text-xs-center text-md-right">
											<label>
												<input type="checkbox" name="catagoryperf[]" value="<?php echo  $value['id'] ?>" class="filter-box" />
												<span class="color2 filter-text"><?php echo  $value['title'] ?></span>
											</label>
										</p>
										
									</div>
									<?php else:  ?>
									<div class="col-md-6">
										<p class="margin-35px-bottom text-xs-center">
											<label>
												<input type="checkbox" name="catagoryperf[]" value="<?php echo  $value['id'] ?>" class="filter-box" />
												<span class="color2 filter-text"><?php echo  $value['title'] ?></span>
											</label>
										</p>
									</div>
								<?php 
							endif;

								 $i++; ?>

							
								
							<?php
							endforeach; ?>
						</div>
						</div>
						<small id="avatarHelp" class="form-text text-muted"> <?php echo GetError('catagoryperf') ?></small>
					</div>
						<input type="hidden" name="user_id" value="<?php echo $login_user_id; ?>">
						<input type="hidden" name="from_submit_base_url" value="<?php echo base_url_route('dashboard/profile-edit'); ?>">
						<input type="hidden" name="from_type" value="<?php echo "edit_profile_form"; ?>">
						<button type="submit" class="d-flex mx-auto justify-content-center web-btn color2-btn color2-btn-hover margin-30px-bottom">Submit</button>
				</form>
			</div>

		</div>




	</div>


	<?php include_once __DIR__ . '/../include/footer.php'; ?>






	<?php include_once __DIR__ . '/../include/script-bottom.php'; ?>
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
		var checkPref = [<?php echo $user_all_value['catagory_preferable']; ?>];
		$.each(checkPref, function(i, val){
			$("input[name='catagoryperf[]'][value='" + val + "']").prop('checked', true);
		});
	</script>


</body>

</html>