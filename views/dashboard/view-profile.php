<?php
include_once __DIR__ . '/user-conroller.php';

if (empty($_GET['user'])) {
	$url = base_url_route('dashboard/home');
	header("Location: $url");
	exit;
} else {
	$user_id = custom_crypt($_GET['user'], 'd');
	$sql = "select * from `user` where `id` = '$user_id'";
	$user_all = $fmw_database->get_result($sql);
	if (count($user_all) <= 0) {
		$url = base_url_route('dashboard/home');
		header("Location: $url");
		exit;
	}
	$user_all = $user_all[0];
}
$sql = "SELECT 
		`post`.`id`,`post`.`user_id`,`post`.`title`,`post`.`content`,`post`.`short_content`,`post`.`slug` ,
		`category`.`title` as `cat_title`,
		`user`.`user_firstName`,`user`.`user_lastName` 
		FROM `post` 
		inner join `user` on `post`.`user_id` = `user`.`id`
		inner join `category` on `post`.`catagory_id` = `category`.`id`
		WHERE `post`.`user_id` = $user_id and `post`.`status` = 'publish' 
		order by `post`.`id` DESC";
$user_all_post = $fmw_database->get_result($sql);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Home | Sahajjo</title>

	<?php include_once __DIR__ . '/../include/script-head.php'; ?>
	<style >
		@media(min-width: 992px){

			.left-side{
				min-height: 100vh;
				max-width: 300px;
				overflow: hidden;
				height: 100%;
			}

		}
		@media(max-width: 991px){
			.left-side{
				min-height: 30vh;
				max-width: 100%;
				overflow: hidden;
			}
		}
	</style>>
</head>

<body>

	<?php include_once __DIR__ . '/include/nav-bar.php'; ?>

	<div class="container-home">
		<div class="row m-0 container-home">

			<div class="col-lg-3 col-12 pl-sm-0 p-0">
				<div class="bg-cover bg-no-repeat profile-cover mr-auto left-side " style="">
					<?php
					$profile_pic = get_user_meta($user_all['id'], 'profile_pic', $fmw_database, "");
					$profile_pic = (empty($profile_pic)) ? $default_user_image_val : base_url_route($profile_pic);
					?>
					<div class=" color1-border rad-30 border-4 bg-cover bg-no-repeat bg-center p-4 mt-5 mx-auto" style="background-image: url(<?php echo $profile_pic; ?>);max-width: 250px;height:250px">


					</div>
					<h3 class="color1 text-center mt-4"><?php echo $user_all['user_firstName'] . " " . $user_all['user_lastName']; ?></h3>
					<h5 class="color1 text-center mt-1"> <?php echo $user_all['user_email']; ?></h5>

				</div>


			</div>
			<div class="col-lg-6" style="min-height: 75vh">

					<?php
					if (count($user_all_post) >= 1) :
						foreach ($user_all_post as $key => $value) :
							?>
							<div class=" d-flex justify-content-center align-items-center bg-center bg-no-repeat bg-cover" style="background-image: url(images/dp-1.jpeg);">
								<?php
									$profile_pic = get_user_meta($value['user_id'], 'profile_pic', $fmw_database, "");
									$profile_pic = (empty($profile_pic)) ? $default_user_image_val : base_url_route($profile_pic);
								
									?>
								<img src="<?php echo $profile_pic; ?>" class="post-img obj-cover">
							</div>
							<div class="card d-grid align-items-center mx-auto mb-5" style="">
								<div class="card-body mx-3">
									<h4 class="card-title text-center bold-text margin-40px-top color3"><?php echo $value['user_firstName'] . ' ' . $value['user_lastName'] ?></h4>
									<p class="card-text text-justify post-text "><?php echo $value['title'] ?></p>
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
					else :
						echo "No Post found";
					endif;
					?>

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

	<?php include_once __DIR__ . '/../include/script-bottom.php'; ?>

</body>

</html>