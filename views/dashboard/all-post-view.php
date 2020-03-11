<?php
include_once __DIR__ . '/user-conroller.php';
$all_catagory = $fmw_database->get_result("SELECT * FROM `category` ORDER BY `category`.`id` ASC");
$catagory_serial = array();
foreach ($all_catagory as  $value) {
	array_push($catagory_serial, $value['id']);
}
$catagory_serial = implode(',', $catagory_serial);
$search_qur = "";


if (!empty($_GET['s_q'])) {
	$search_qur = input_validation($_GET['s_q']);
}
if (!empty($_GET['cat'])) {
	$catagory_serial = implode(',', $_GET['cat']);
}
$sql = "SELECT 
		`post`.`id`,`post`.`user_id`,`post`.`title`,`post`.`content`,`post`.`short_content`,`post`.`slug` ,
		`category`.`title` as `cat_title`,
		`user`.`user_firstName`,`user`.`user_lastName` 
		FROM `post` 
		inner join `user` on `post`.`user_id` = `user`.`id`
		inner join `category` on `post`.`catagory_id` = `category`.`id`
		WHERE 
		`post`.`catagory_id` in ($catagory_serial) 
		and `post`.`status` = 'publish' 
		and  (`post`.`tags` like '%$search_qur%'  
				or `post`.`title` like '%$search_qur%' 
				or `post`.`short_content` like '%$search_qur%' 
				or `post`.`content` like '%$search_qur%'
			)
		order by `post`.`id` DESC
		";
//print_r($sql);
$all_post_home = $fmw_database->get_result($sql);

//print_r($all_post_home);
//print_r($_GET);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>All Post | Sahajjo</title>

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
		 padding: 10px;
		 min-width: 200px;
		} 
		.filter-text{
		color:#2F80ED !important;
		 border:2px solid #2F80ED;
		 padding: 10px;
		 min-width: 200px;
		}
		input[type=checkbox]:checked + .filter-text:before{
		 content: "🗹 "
		}
	</style>
</head>

<body>
	<?php include_once __DIR__ . '/include/nav-bar.php'; ?>


	<div class="container-home">
		<div class="row m-0 container-home">

			<div class="col-md-3 col-12 navbar-bg">
				<div class="d-flex mx-5">

					<div class="mt-5">
						
						<form action="" class="mx-1 mt-4" type="get">
							<div class="form-group">
								<label for="exampleInputFirstName" style="font-size: 1.6em; " class="color1">Search</label>
								<input type="text" class="form-control " id="exampleInputFirstName" name="s_q" placeholder="Type Here..." value="<?php echo $search_qur; ?>">
								<small id="emailHelp" class="form-text text-muted"> <?php echo GetError('fname') ?></small>
								<h5 class="color1  w-100 my-4"><span class="">Filter</span> By:</h5>
							</div>
							<div class="form-group">
								
								<div class="mt-1">
									<?php foreach ($all_catagory as $value) :
										?>
										<p class="margin-35px-bottom ">
											<label>
												<input type="checkbox" name="cat[]" value="<?php echo  $value['id'] ?>" class="filter-box" />
												<span class="color2 filter-text"><?php echo  $value['title'] ?></span>
											</label>
										</p>
									<?php
									endforeach; ?>

								</div>
								<small id="avatarHelp" class="form-text text-muted"> <?php echo GetError('catagoryperf') ?></small>
							</div>
							<button type="submit" class="color1-btn color1-btn-hover web-btn big-btn mb-5">Search</button>
						</form>
					</div>
				</div>




			</div>
			<div class="col-md-6">

				<div class="">

					<?php
					if (count($all_post_home) >= 1) :
						foreach ($all_post_home as $key => $value) :
							?>
							<div class="  d-flex justify-content-center align-items-center bg-center bg-no-repeat bg-cover" style="background-image: url(images/dp-1.jpeg);">
								<?php
									$profile_pic = get_user_meta($value['user_id'], 'profile_pic', $fmw_database, "");
									$profile_pic = (empty($profile_pic)) ? $default_user_image_val : base_url_route($profile_pic);
								
									?>
								<img src="<?php echo $profile_pic; ?>" class="post-img obj-cover">
							</div>
							<div class="card d-grid align-items-center mx-auto mb-5" style="">
								<div class="card-body mx-3">
									<a href="<?php echo base_url_route('dashboard/view-profile?user='.custom_crypt($value['user_id'])); ?>">
										<h4 class="card-title text-center bold-text margin-40px-top color3"><?php echo $value['user_firstName'] . ' ' . $value['user_lastName'] ?></h4>
									</a>
									<p class="card-text text-justify post-text "><?php echo $value['title'] ?></p>
									<!--
								<p class=""><?php echo $value['cat_title'] ?></p>
							-->
									<p class="card-text text-justify post-text "><?php echo htmlspecialchars_decode($value['short_content']) ?></p>
									<?php $url = 'dashboard/single-post?post_slug=' . $value['slug'] ?>
									<!--<p class="color3 text-center"><a href="<?php echo base_url_route($url); ?>" class="color3 color3-hover">See Full Post</a></p> -->

								</div>
								<div class="w-100 color3-bg margin-15px-top"><p class="color1 mb-0 p-2 text-center"><a href="<?php echo base_url_route($url); ?>" class="color1 color1-hover ">See Full Post</a></p></div>
							</div>
					<?php
						endforeach;
					else :
						echo "No Post found";
					endif;
					?>
				</div>
				<!--
				<div class="">
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

		var checkPref = [<?php echo $catagory_serial; ?>];
		$.each(checkPref, function(i, val) {
			$("input[name='cat[]'][value='" + val + "']").prop('checked', true);
		});
	</script>


</body>

</html>