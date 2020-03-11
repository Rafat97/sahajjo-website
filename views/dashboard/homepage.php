<?php include_once __DIR__ . '/user-conroller.php';

$cat_prf = $user_all_value['catagory_preferable'];
$sql = "SELECT 
		`post`.`id`,`post`.`user_id`,`post`.`title`,`post`.`content`,`post`.`short_content`,`post`.`slug` ,
		`category`.`title` as `cat_title`,
		`user`.`user_firstName`,`user`.`user_lastName` 
		FROM `post` 
		inner join `user` on `post`.`user_id` = `user`.`id`
		inner join `category` on `post`.`catagory_id` = `category`.`id`
		WHERE `post`.`catagory_id` in ($cat_prf) and `post`.`status` = 'publish' 
		order by `post`.`id` DESC";
$all_post_home = $fmw_database->get_result($sql);
//print_r($all_post_home);
//print_r(get_user($all_post_home[0]['user_id']  ,$fmw_database  ));
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Home | Sahajjo</title>

	<?php include_once __DIR__ . '/../include/script-head.php'; ?>
	<style>
		.container-home {
		    -ms-overflow-style: none !important;  // IE 10+
		    scrollbar-width: none !important;  // Firefox
		}
		.container-home::-webkit-scrollbar { 
		    display: none !important;  // Safari and Chrome
		}
		html {
		    overflow: scroll;
		    overflow-x: hidden;
		}
		::-webkit-scrollbar {
		    width: 0px;  /* Remove scrollbar space */
		    background: transparent;  /* Optional: just make scrollbar invisible */
		}
		/* Optional: show position indicator in red */
		::-webkit-scrollbar-thumb {
		    background: #FF0000;
		}
		.scroll-middle{
			height: 100vh;
			overflow-y: auto;
			overflow-x: hidden;
		}
		@media(min-width: 992px){

			.left-side{
				height: 100vh;
				max-width: 300px;
				overflow: hidden;
				height: 100%;
			}

		}
		@media(max-width: 991px){
			.left-side{
				min-height: 25vh;
				max-width: 100%;
				overflow: hidden;
			}
		}
	</style>

</head>

<body>

	<?php include_once __DIR__ . '/include/nav-bar.php'; ?>

	<div class="container-home">
		<div class="row m-0 container-home">
			
			<div class="col-lg-3 col-12 color3-bg" >
				<div class=" d-flex align-items-center justify-content-center mt-lg-0 mt-5 mx-auto flex-wrap left-side" style="">
					<div class="border-all p-5 d-flex justify-content-around flex-wrap mb-5 mb-lg-0 color1-bg" style="max-width: 300px; border-radius: 10px">
						<h4 class="color3 text-center m-3">Want Help?</h4>
						<a href="<?php echo base_url_route('dashboard/add-post'); ?>">
							<button type="button" class="post-button m-3 web-btn big-btn color3-btn color3-btn-hover" data-toggle="modal" data-target="">
								Add Post <br>+
							</button>
						</a>
					</div>

				<!-- Modal -->
			<!--	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								...
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
							</div>
						</div>
					</div>
				</div> -->

			</div>
			<!--	<h2 class="w-100 text-center m-3  d-md-none color2-bg p-3 color1"> Get Connected </h2>
				<div class="d-flex justify-content-center flex-wrap connect-row">
					<h2 class="w-100 text-center m-3 d-none d-md-block color2-bg p-3 color1"> Get Connected </h2>
					<div class="flip-card m-3">
						<div class="flip-card-inner">
							<div class="flip-card-front d-flex align-items-end" style="background-image: url(images/dp-1.jpeg); ">
								<h5 class="text-center color1-bg-opacity5 color1 w-100 m-0 p-2">
									J Brown
								</h5>
							</div>
							<div class="flip-card-back color3-bg p-2 d-flex flex-wrap" style="justify-content: space-between;flex-direction: column;">
								<h1 class="text-center">John Doe</h1>
								<p class="text-left mt-4">Architect & Engineer</p>
								<p class="text-left mt-1">Rating :4/5</p>

								<button class="web-btn color2-btn color2-btn-hover" style="justify-content:  flex-end;">
									Connect
								</button>
							</div>
						</div>
					</div>
					<div class="flip-card m-3">
						<div class="flip-card-inner">
							<div class="flip-card-front d-flex align-items-end" style="background-image: url(images/dp-1.jpeg); ">
								<h5 class="text-center color1-bg-opacity5 color1 w-100 m-0 p-2">
									J Brown
								</h5>
							</div>
							<div class="flip-card-back color3-bg p-2 d-flex flex-wrap" style="justify-content: space-between;flex-direction: column;">
								<h1 class="text-center">John Doe</h1>
								<p class="text-left mt-4">Architect & Engineer</p>
								<p class="text-left mt-1">Rating :4/5</p>

								<button class="web-btn color2-btn color2-btn-hover" style="justify-content:  flex-end;">
									Connect
								</button>
							</div>
						</div>
					</div>
					<div class="flip-card m-3">
						<div class="flip-card-inner">
							<div class="flip-card-front d-flex align-items-end" style="background-image: url(images/dp-1.jpeg); ">
								<h5 class="text-center color1-bg-opacity5 color1 w-100 m-0 p-2">
									J Brown
								</h5>
							</div>
							<div class="flip-card-back color3-bg p-2 d-flex flex-wrap" style="justify-content: space-between;flex-direction: column;">
								<h1 class="text-center">John Doe</h1>
								<p class="text-left mt-4">Architect & Engineer</p>
								<p class="text-left mt-1">Rating :4/5</p>

								<button class="web-btn color2-btn color2-btn-hover" style="justify-content:  flex-end;">
									Connect
								</button>
							</div>
						</div>
					</div>
					<div class="flip-card m-3">
						<div class="flip-card-inner">
							<div class="flip-card-front d-flex align-items-end" style="background-image: url(images/dp-1.jpeg); ">
								<h5 class="text-center color1-bg-opacity5 color1 w-100 m-0 p-2">
									J Brown
								</h5>
							</div>
							<div class="flip-card-back color3-bg p-2 d-flex flex-wrap" style="justify-content: space-between;flex-direction: column;">
								<h1 class="text-center">John Doe</h1>
								<p class="text-left mt-4">Architect & Engineer</p>
								<p class="text-left mt-1">Rating :4/5</p>

								<button class="web-btn color2-btn color2-btn-hover" style="justify-content:  flex-end;">
									Connect
								</button>
							</div>
						</div>
					</div>
					<div class="flip-card m-3">
						<div class="flip-card-inner">
							<div class="flip-card-front d-flex align-items-end" style="background-image: url(images/dp-1.jpeg); ">
								<h5 class="text-center color1-bg-opacity5 color1 w-100 m-0 p-2">
									J Brown
								</h5>
							</div>
							<div class="flip-card-back color3-bg p-2 d-flex flex-wrap" style="justify-content: space-between;flex-direction: column;">
								<h1 class="text-center">John Doe</h1>
								<p class="text-left mt-4">Architect & Engineer</p>
								<p class="text-left mt-1">Rating :4/5</p>

								<button class="web-btn color2-btn color2-btn-hover" style="justify-content:  flex-end;">
									Connect
								</button>
							</div>
						</div>
					</div>

				</div> -->




		</div>
		<div class="col-lg-7 ">
			
			<div class="scroll-middle">

				<?php
				if (count($all_post_home) >= 1) :
					foreach ($all_post_home as $key => $value) :
						?>
						<div class="  d-flex justify-content-center align-items-center " style="">
							<?php
									$profile_pic = get_user_meta($value['user_id'], 'profile_pic', $fmw_database, "");
									$profile_pic = (empty($profile_pic)) ? $default_user_image_val : base_url_route($profile_pic);
								
									?>
							<img src="<?php echo $profile_pic; ?>" class="post-img obj-cover">
						</div>
						<div class="card d-grid align-items-center mx-auto" style="">
							<div class="card-body mx-3">
								<a href="<?php echo base_url_route('dashboard/view-profile?user='.custom_crypt($value['user_id'])); ?>">
									<h4 class="card-title text-center bold-text margin-40px-top color3"><?php echo $value['user_firstName'] . ' ' . $value['user_lastName'] ?></h4>
								</a>
								<p class="card-text text-center post-text mb-3"><strong>Title :</strong> <?php echo $value['title'] ?></p> 
								<!--
								<p class=""><?php echo $value['cat_title'] ?></p>
							-->
								<p class="card-text text-justify post-text "><?php echo htmlspecialchars_decode($value['short_content']) ?></p>
								<?php $url = 'dashboard/single-post?post_slug=' . $value['slug'] ?>
							<!--	<p class="color3 text-center"><a href="<?php echo base_url_route($url); ?>" class="color3 color3-hover">See Full Post</a></p> -->

							</div>
							<div class="w-100 color3-bg margin-15px-top"><p class="color1 mb-0 p-2 text-center"><a href="<?php echo base_url_route($url); ?>" class="color1 color1-hover ">See Full Post</a></p></div>
						</div>
				<?php
					endforeach;
				else:
					echo "No Post found";
				endif;
				?>


			</div>
			<!--<a href="<?php echo base_url_route('dashboard/all-post'); ?>" class="color3 color3-hover">
				<button class="btn btn-primary">View All Post</button>
			</a> -->
			<br>
			<!-- <div class="">
				<div class=" post-img d-flex justify-content-center align-items-center bg-center bg-no-repeat bg-cover" style="background-image: url(images/dp-1.jpeg);">
					<img src="">
				</div>
				<div class="card d-grid align-items-center mx-auto" style="">

					<div class="card-body mx-3">
						<h4 class="card-title text-center bold-text margin-40px-top color3">John Doe </h4>
						<p class="card-text text-justify post-text ">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.... </p>
						<p class="color3 text-center"><a href="#" class="color3 color3-hover">See Full Post</a></p>

					</div>


				</div>

			</div>
			
			<div class="mb-5">
				<div class=" post-img d-flex justify-content-center align-items-center bg-center bg-no-repeat bg-cover" style="background-image: url(images/dp-1.jpeg);">
					<img src="">
				</div>
				<div class="card d-grid align-items-center mx-auto" style="">

					<div class="card-body mx-3">
						<h4 class="card-title text-center bold-text margin-40px-top color3">John Doe </h4>
						<p class="card-text text-justify post-text ">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.... </p>
						<p class="color3 text-center"><a href="#" class="color3 color3-hover">See Full Post</a></p>

					</div>


				</div>
			
			</div>
		
			-->

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
	</script>



</body>

</html>