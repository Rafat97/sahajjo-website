<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>About US</title>

	<?php include_once __DIR__ . '/include/script-head.php'; ?>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />
	<style>
		body{
		margin: 0px;
	}
		.about-bg{
				background: linear-gradient(90deg, #fff 50%, rgba(47,128,237,0.85) 50%);
			}
			.about-text{

				min-height: 100px;
				align-self: center;
				margin-bottom: 20px
			}
			.fa {
			    display: flex;
			    justify-content: center;
			    align-items: center;
			    font-size: 16px;
			    width: 40px;
			    height: 40px;
			    text-align: center;
			    text-decoration: none;
			    margin-right: 10px;
			    border-radius: 100%;
			}
			.fa-facebook, .fa-instagram, .fa-linkedin {
			    font-size: 0.9em;
			    color: #fff !important;
			}
			.fa-facebook {
			    background: #3B5998;
			    color: white;
			}
			.fa-linkedin {
			    background: #007bb5;
			    color: white;
			}
			.fa:hover{
				opacity: 0.7;
			}
			@media(max-width: 767px){
			.about-bg{
				background: rgba(47,128,237,1);
			}
			.abt-1{
				min-width: 220px;
				text-align: center;
				background:white;
				
				margin:auto;
			}
			.abt-2{
				min-width: 160px;
				background:black;
				color:white;
				text-align: center;
				margin:auto;
			}
			.text-xs-center{
				text-align: center;
			}
			.pb-mobile-0{
				padding-bottom: 0px !important;
			}
			.mt-mobile-20px{
				margin-top: 20px;
			}
			}

			@media(min-width: 768px){
				.about-img{
					position: relative;
					bottom:150px;
					margin-bottom: -150px;
				}
			}
	</style>

</head>

<body class="about-bg">



	<section class=" padding-80px-tb pb-mobile-0" style="min-height: 100vh" >
		<div class="row w-100 align-items-center m-0 mt-md-5 mt-4" style="height: fit-content;">
				<div class="col-md-6 col-12 d-flex justify-content-md-end align-items-start justify-content-center p-0">
					<h2 class="color3 text-uppercase abt-1 mb-0 mr-md-1">About </h2>
				</div>
				<div class="col-md-6 col-12 d-flex justify-content-md-start justify-content-center align-items-start">
					<h2 class="color1 text-uppercase abt-2 mb-0 "> Us</h2>
				</div>

			</div>
	

		<div class="row mx-0 w-100 padding-80px-tb pb-mobile-0 slideInLeft animated" >
	        <div class="col-md-9 col-lg-7 p-0 " style="background:rgba(47,128,237,1)" >
	           <!-- <div class="d-flex a">
	                    <img src="images/faraz.png" class="about-img" style="max-width: 250px;height: auto;">
	                    <div class="about-text">
	                        <h2 class="color1">Faraz Kabir</h2>
	                        <h4 class="color1">AUST, CSE</h4>
	                    </div>
	                    
	            </div> -->
	            <div class="row mx-0 ">
	            	<div class="col-md-6 d-flex justify-content-center justify-content-md-end">
	            		<img src="images/faraz.png" class="about-img" style="max-width: 280px;height: auto;">
	            	</div>
	            	<div class="col-md-6 d-flex justify-content-center justify-content-md-start ">
	            		 <div class="about-text mt-mobile-20px">
	            		 	
	                        <h2 class="color1 text-xs-center mt-xs-3">Faraz Kabir</h2>
	                        <h4 class="color1 text-xs-center">CSE,AUST</h4>
	                        <h4 class="color1 text-xs-center">Front End Developer, Sahajjo</h4>
	                        <div class="row align-items-center justify-content-center justify-content-md-start m-0 w-100" id="" >
								<a href="https://www.facebook.com/farazkabirkhan.shad" target="_blank" class="fa fa-facebook"></a>							
								<a href="https://www.linkedin.com/in/farazkabir" target="_blank" class="fa  fa-linkedin"></a>
							</div>
	                    </div>
	            	</div>
	            	
	            </div>
	        </div>
        <div class="col-md-3 col-lg-5">
            
        </div>

        
    </div>
    <div class="row mx-0 w-100 padding-80px-bottom pb-mobile-0 slideInRight animated" >
    	   <div class="col-md-3 col-lg-5">
            
        	</div>
	        <div class="col-md-9 col-lg-7 p-0 " style="background:rgba(0,0,0,0.9)" >
	           <!-- <div class="d-flex a">
	                    <img src="images/faraz.png" class="about-img" style="max-width: 250px;height: auto;">
	                    <div class="about-text">
	                        <h2 class="color1">Faraz Kabir</h2>
	                        <h4 class="color1">AUST, CSE</h4>
	                    </div>
	                    
	            </div> -->
	            <div class="row w-100 mx-0 margin-80px-top">
	            	
	            	<div class="col-md-6 d-flex justify-content-center justify-content-md-end ">
	            		 <div class="about-text">
	                        <h2 class="color1 text-xs-center">Rafat Haque</h2>
	                        <h4 class="color1 text-xs-center">CSE,AUST</h4>
	                        <h4 class="color1 text-xs-center">Back End Developer, Sahajjo</h4>
	                        <div class="row align-items-center justify-content-center justify-content-md-start m-0 w-100" id="" >
								<a href="http://bit.ly/Rafat_Faebook" target="_blank" class="fa fa-facebook"></a>							
								<a href="http://bit.ly/Rafat_Linkedin" target="_blank" class="fa  fa-linkedin"></a>
							</div>
	                    </div>
	            	</div>
	            	<div class="col-md-6 d-flex justify-content-center justify-content-md-start">
	            		<img src="images/rafat.png" class="about-img" style="max-width: 280px;height: auto;">
	            	</div>
	            	
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