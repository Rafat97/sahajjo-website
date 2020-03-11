<?php
include_once __DIR__ . '/user-conroller.php';
if (empty($_GET['post_slug'])) {
	$url = base_url_route('dashboard/all-post');
	header("Location: $url");
	exit;
}
$slug = $_GET['post_slug'];
$sql = "SELECT 
		`post`.`id`,`post`.`user_id`,`post`.`title`,`post`.`content`,`post`.`short_content`,`post`.`slug` ,
		`category`.`title` as `cat_title`,
		`user`.`user_firstName`,`user`.`user_lastName` 
		FROM `post` 
		inner join `user` on `post`.`user_id` = `user`.`id`
		inner join `category` on `post`.`catagory_id` = `category`.`id`
		WHERE 
		`post`.`slug` = '$slug' 
		and `post`.`status` = 'publish' 
		";
$single_post = $fmw_database->get_result($sql);
if (count($single_post) <= 0) {
	$url = base_url_route('dashboard/all-post');
	header("Location: $url");
	exit;
}
$single_post = $single_post[0];
$post_id = $single_post['id'];
$sql_2 = "SELECT
		`comment`.`id`,`comment`.`user_id`,`comment`.`post_id`,`comment`.`comment_content`,`comment`.`created_at`,
		`user`.`user_firstName`,`user`.`user_lastName` 
 		from `comment` 
		inner join `user` on `comment`.`user_id` = `user`.`id`
		where `comment`.`post_id` = '$post_id'";
$get_allcomment = $fmw_database->get_result($sql_2);
//print_r($get_allcomment);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Single post | Sahajjo</title>

	<?php include_once __DIR__ . '/../include/script-head.php'; ?>
	<style >

		.container-home ::-webkit-scrollbar {
		    width: 10px;  /* Remove scrollbar space */
		    background: transparent;  /* Optional: just make scrollbar invisible */
		}
		/* Optional: show position indicator in red */
		.container-home ::-webkit-scrollbar-thumb {
		    background: transparent;
		}
		.card-body{
		padding-left: 0px !important;
		padding-right: 0px !important;
		}
		.com-img{
			height: 70px;
			width: 70px;
			border: 3px solid #2F80ED;
			border-radius: 10px;


		}
		.border-right, .border{
			border-color:rgba(47,128,237,0.2) !important;
		}
	</style>
</head>

<body>

	<?php include_once __DIR__ . '/include/nav-bar.php'; ?>

	<div class="container-home">
		<div class="row m-0 container-home">

			<div class="col-md-2 col-12 navbar-bg ">
				<!--
			<div class="d-flex align-items-center justify-content-center" style="min-height: 100vh">
				<div>
					<p class="color1">Category: <span class="border-bottom color1">Technology</span> </p>
					<p class="color1">Posted On: <span class="border-bottom color1">12 am,october,2019</span> </p>
					<p class="color1">Total Comments: <span class="border-bottom color1">3</span> </p>
				</div>
			</div>
-->

			</div>
			<div class="col-md-1">

			</div>
			<div class="col-md-6">


				<div class="">
					<div class=" d-flex justify-content-center align-items-center bg-center bg-no-repeat bg-cover" >
						<?php
									$profile_pic = get_user_meta($single_post['user_id'], 'profile_pic', $fmw_database, "");
									$profile_pic = (empty($profile_pic)) ? $default_user_image_val : base_url_route($profile_pic);
								
									?>
						<img src="<?php echo $profile_pic; ?>" class="post-img obj-cover">
					</div>
					<div class="card d-grid align-items-center mx-auto" style="">

						<div class="card-body mx-3">
							<h4 class="card-title text-center bold-text margin-40px-top color3 text-uppercase"><?php echo $single_post['user_firstName'] . ' ' . $single_post['user_lastName'] ?></h4>

							<!--<p class="card-text text-justify ">Short Description : </p><br> -->
							<p class="text-center" style="width: 96%; margin: auto; "><?php echo htmlspecialchars_decode($single_post['short_content']) ?></p>
							<p class="card-text text-justify d-none">Description</p>
							<p class=""><?php echo htmlspecialchars_decode($single_post['content']) ?></p><br>
							<!--	<h4 class="card-title text-center bold-text color3">Images</h4> -->

						</div>
						<!--
						<div class="owl-carousel owl-theme">
							<div class="item">

								<img style="max-width: 100%;height:350px;object-fit: contain;" src="images/dp-1.jpeg">
							</div>
							<div class="item">
								<img style="max-width: 100%;height:350px;object-fit: contain;" src="images/cover.jpg">
							</div>
							<div class="item">

								<img style="max-width: 100%;height:350px;object-fit: contain;" src="images/dp-1.jpeg">
							</div>
							<div class="item">
								<img style="max-width: 100%;height:350px;object-fit: contain;" src="images/cover.jpg">
							</div>
							<div class="item">

								<img style="max-width: 100%;height:350px;object-fit: contain;" src="images/dp-1.jpeg">
							</div>
							<div class="item">
								<img style="max-width: 100%;height:350px;object-fit: contain;" src="images/cover.jpg">
							</div>
							<div class="item">

								<img style="max-width: 100%;height:350px;object-fit: contain;" src="images/dp-1.jpeg">
							</div>
							<div class="item">
								<img style="max-width: 100%;height:350px;object-fit: contain;" src="images/cover.jpg">
							</div>
						</div>
-->
					</div>

					<h4 class="text-center mt-5">Comments</h4>
					<div class="w-100  border-all color3-bg ">
						<form action="<?php echo base_url_route('dashboard/post-request'); ?>" class="w-100 p-4" method="post">

							<div class="form-group">
								<h6 class="color1" id="comment_count_message">100 letters remaining</h6>
								<input type="text" class="form-control border" id="comment" name="comment" placeholder="Comment"  maxlength="100" style= "border: 1px solid #dee2e6!important;" required value="<?php echo GetOldInput('Comment') ?>">
								<small id="emailHelp" class="form-text text-muted"><?php echo GetError('comment') ?></small>
							</div>

							<input type="hidden" name="current_user_id" value="<?php echo $login_user_id; ?>">
							<input type="hidden" name="posted_user_id" value="<?php echo  $single_post['user_id']; ?>">
							<input type="hidden" name="post_id" value="<?php echo $single_post['id']; ?>">
							<input type="hidden" name="from_submit_base_url" value="<?php echo base_url_route("dashboard/single-post?post_slug=$slug"); ?>">
							<input type="hidden" name="from_type" value="<?php echo "user_comment_send_form"; ?>">
							<button type="submit" class="d-flex justify-content-center mx-auto color2-btn color2-btn-hover web-btn big-btn">Submit</button>
						</form>
					</div>
					<div class="w-100  p-3 text-center mt-5 mb-5">
						<?php
						if (count($get_allcomment) >= 1) :
							foreach ($get_allcomment as $key => $value) :

								?>
								<div class="row border my-4 mx-0 ">
									<div class="col-sm-3 col-4 border-right">
										<div class="mt-2">
											<?php
											$profile_pic = get_user_meta($value['user_id'], 'profile_pic', $fmw_database, "");
											$profile_pic = (empty($profile_pic)) ? $default_user_image_val : base_url_route($profile_pic);
										
											?>
											<img src="<?php echo $profile_pic; ?>"  class="com-img obj-cover my-3">
										</div>
										<p class="color2 text-center"><?php echo $value['user_firstName'] . ' ' . $value['user_lastName'] ?></p>

									</div>
									<div class="col-sm-9 col-8 d-flex justify-content-around " style="flex-direction:column;overflow-y: auto;word-break: break-all;min-height: 150px;">
										<h5 style="overflow-y: auto;word-break: break-all;" class="text-lg-left text-center mt-3"><?php echo htmlspecialchars_decode($value['comment_content']) ?></h5>
										<p class="mx-0 mt-4 text-lg-left text-center">Posted On: <?php echo $value['created_at'] ?></p>

									</div>


								</div>
						<?php
							endforeach;
						else :
							echo "No Comment yet";
						endif;
						?>


					</div>

				</div>






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
		var text_max = 100;
		$('#comment').keyup(function() {

			var text_length = $('#comment').val().length;
			var text_remaining = text_max - text_length;
			$('#comment_count_message').html(text_remaining + ' remaining');

		});
	</script>
	<!--
	<script src="jquery.min.js"></script>
	<script src="owlcarousel/owl.carousel.min.js"></script>
	<script type="text/javascript">
		// Or with jQuery
	
		// $('').owlCarousel({
		// 	stagePadding: 50,
		// 	loop: true,
		// 	margin: 10,
		// 	nav: true,
		// 	responsive: {
		// 		0: {
		// 			items: 1
		// 		},
		// 		600: {
		// 			items: 3
		// 		},
		// 		1000: {
		// 			items: 5
		// 		}
		// 	}
		// })
		// $('.owl-carousel').owlCarousel({
		// 	animateOut: 'slideOutDown',
		// 	animateIn: 'flipInX',
		// 	items: 1,
		// 	margin: 30,
		// 	stagePadding: 30,
		// 	smartSpeed: 450
		// });
	</script>
	-->
</body>

</html>