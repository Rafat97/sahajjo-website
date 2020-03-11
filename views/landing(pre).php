<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Home | Sahajjo</title>

	<?php include_once __DIR__ . '/include/script-head.php'; ?>

	<style>
	body{
	    margin:0px;
	}
	.rounded-top {
		    border-top-left-radius: 3.25rem!important;
		    border-top-right-radius: 3.25rem!important;
		}
		.rounded-bottom {
		    border-bottom-right-radius: 1.25rem!important;
		    border-bottom-left-radius: 1.25rem!important;
		}
		.bottom-text{
			margin-top: 100px;
		    font-weight: 600;
		    opacity: 0.85;
		}
		.line-1 {
			width: 300px;

			border-right: 2px solid rgba(255, 255, 255, .75);
			font-size: 180%;
			text-align: center;
			white-space: nowrap;
			overflow: hidden;
		}

		/* Animation */
		.anim-typewriter {
			animation: typewriter 4s steps(44) 1s 1 normal both,
				blinkTextCursor 500ms steps(44) infinite normal;
		}
		.logo-txt{
				font-size:  38px;
			}
		@media(min-width: 768px){
		.line-1 {
			width: 670px;
			font-size: 48px ;
		}
		
		.anim-typewriter {
			animation: typewriterB 4s steps(44) 1s 1 normal both,
				blinkTextCursor 500ms steps(44) infinite normal;
		}
		}
		@keyframes typewriter {
			from {
				width: 0;
			}

			to {
				width: 300px;
			}
		}
		@keyframes typewriterB {
			from {
				width: 0;
			}

			to {
				width: 670px;
			}
		}

		@keyframes blinkTextCursor {
			from {
				border-right-color: rgba(255, 255, 255, .75);
			}

			to {
				border-right-color: transparent;
			}
		}

		@media(max-width: 767px) {
			.font-small {
				font-size: 1.4em;
			}
			.logo-txt{
				font-size:  1.5em;
			}
			.logo-200{
				width: 160px;
			}
			.font-xs-36{
				font-size:36px;
			}
		}
	</style>

</head>

<body>



	<section class=" bg-cover bg-center-bg-no-repeat d-flex align-items-center parallax " id="landing-top" style="background-image: url(<?php echo base_url_route('images/cover.jpg'); ?>);">
		<div class="opacity-full color2-bg relative">
		<div class="container d-flex align-items-center justify-content-around flex-wrap p-0" style="min-height:95vh;flex-direction: column;">
			<div class="row w-100  m-0 row-mobile-80 justify-content-center align-items-center">
					<img src="images/sahajjo.png" class="logo-200" alt="">
					<div class="" style="height: 70px;width: 3px;margin-left:7px;margin-right:12px; background: rgba(47,128,237,0.5)">

					</div>
					<h2 class="color1 ls-2 mb-0 logo-txt text-uppercase" >Sahajjo</h2>
			</div>

			<div class="row w-100  m-0">
				<!--<div class="col-12 col-md-6  d-flex justify-content-center justify-content-md-end align-items-center mt-2" style="margin-left: -10px">


					

				</div> -->

				<div class="col-12  d-flex justify-content-center  align-items-center   ">


					<h2 class="line-1 anim-typewriter color1 m-0 font-small ls-3 ls-xs-1">Ask For <span class="color3">Help | </span>Get <span class="color3">Helped </span>.</h2>

				</div>
				<!--<div class="col-12 my-5">
					<h4 class="color1 text-center mx-auto mt-4 animated  fadeIn delay-5s font-small" style="max-width: 860px;line-height: 36px">
						Sahajjo is a platform where one can write blog or posts about any help he/she needs.People wishing to help in that side can comment and express their wish to help.They can communicate later if the help job has to be paid.
					</h4>


				</div> -->
				</div>
				<div class="row m-0">
					<div class="col-12">
						<?php $login_user_id = GetSession('user_id');
						if (empty($login_user_id)) :
							?>
							<div class="row m-0 w-100 align-items-center animated fadeIn delay-5s mb-3">

								<div class="col-md-6 d-flex justify-content-center justify-content-md-end mt-2">
									<a href="<?php echo base_url_route('sign-up'); ?>">
										<button class="web-btn color3-btn color3-btn-hover big-btn">Sign Up</button>
									</a>
								</div>
								<div class="col-md-6 d-flex justify-content-center justify-content-md-start mt-2">
									<a href="<?php echo base_url_route('login'); ?>">
										<button class="web-btn color3-btn color3-btn-hover big-btn">Log in</button>
									</a>
								</div>
							</div>
						<?php
						else :
							?>
							<div class="row m-0 w-100 align-items-center animated fadeIn delay-5s mb-3">

								<div class="col-md-6 d-flex justify-content-center justify-content-md-end mt-2">
									<a href="<?php echo base_url_route('dashboard/home'); ?>">
										<button class="web-btn color3-btn color3-btn-hover big-btn">Dashboard</button>
									</a>
								</div>
								<div class="col-md-6 d-flex justify-content-center justify-content-md-start mt-2">
									<a href="<?php echo base_url_route('logout'); ?>">
										<button class="web-btn color3-btn color3-btn-hover big-btn">Logout</button>
									</a>
								</div>
							</div>
						<?php
						endif;
						?>

					</div>
				</div>	

			

		</div>


	</section>
	<section class="color3-bg padding-80px-tb">
		<div class="container">
			<h2 class="color1 my-4 text-center ls-3 font-xs-36 font-48" style="font-weight: 700"> How it Works</h2>
			<div class="row m-0">

				<div class="col-md-4 py-4">
					<div class="color1-bg rounded-top" style="height: 50px">
						
					</div>
					<div class="color1-bg border rounded-bottom">
						<div class="d-flex flex-wrap justify-content-center padding-30px-all" style="min-height: 380px">
							<h3 class="color2 mb-4 text-nowrap">Open Account</h3>
							<img src="<?php echo base_url_route('images/register.jpg'); ?>" class="img-resp mb-4"  style="height: 200px">
						</div>
						
					</div>
				</div>
				<div class="col-md-4 py-4">
					<div class="color1-bg rounded-top" style="height: 50px">
						
					</div>
					<div class="color1-bg border rounded-bottom">
						<div class="d-flex flex-wrap justify-content-center padding-30px-all" style="min-height: 380px">
							<h3 class="color2 mb-4 text-nowrap">Add Post</h3>
							<img src="<?php echo base_url_route('images/write-blog.jpg'); ?>" class="img-resp mb-4"  style="height: 200px">
						</div>
						
					</div>
				</div>
				<div class="col-md-4 py-4">
					<div class="color1-bg rounded-top" style="height: 50px">
						
					</div>
					<div class="color1-bg border rounded-bottom">
						<div class="d-flex flex-wrap justify-content-center padding-30px-all" style="min-height: 380px">
							<h3 class="color2 mb-4 text-nowrap">Get Helped</h3>
							<img src="<?php echo base_url_route('images/helped.jpg'); ?>" class="img-resp mb-4"  style="height: 200px">
						</div>
						
					</div>
				</div>


				
			</div>
			
		</div>
	</section>
	<section class="bg-cover bg-center bg-no-repeat d-flex align-items-center" style="background-image: url(<?php echo base_url_route('images/1.jpg'); ?>);position: relative;min-height: 100vh" >
		<div class="opacity-medium color2-bg">
			
		</div>
		<div class="container " style="">
			
			<div class="row align-items-center" >
				<div class="col-12">
					<h2 class="color1 text-center bottom-text font-48 font-xs-36 ls-2">So, <span class="color3">What</span> Are You <span class="color3">Waiting</span> For?</h2>
					
				</div>
				
				
				</div>
			
			<div class="row align-items-center" >
			
				
				<div class="col-12 d-flex justify-content-center mt-2 my-5" >
									<a href="#landing-top">
										<button class="web-btn color3-btn color3-btn-hover big-btn">Get Started</button>
									</a>
				</div>
			</div>
		</div>
	</section>


	<?php include_once __DIR__ . '/include/footer.php'; ?>





	<?php include_once __DIR__ . '/include/script-bottom.php'; ?>
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