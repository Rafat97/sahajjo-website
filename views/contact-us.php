<html>

<head>


    <title>Contact Us</title>

  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


   <?php include_once __DIR__ . '/include/script-head.php'; ?>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        body{
            margin-top: 0px;
        }

        .dark-overlay-bg {

            background:
                /* top, transparent red, faked with gradient */
                linear-gradient(rgba(0, 0, 0, 0.85),
                    rgba(0, 0, 0, 0.85)),
                /* bottom, image */
                url(images/contact.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }

        .btn-primary {
            color: #fff !important;
            background-color: forestgreen !important;
            border-color: forestgreen !important;
        }

        .btn-primary:hover {
            color: forestgreen !important;
            background-color: transparent !important;
            border-color: forestgreen !important;
        }

        .height-full {
            height: 100%;
        }

        .btn-modify {
            min-width: 140px;
            min-height: 30px;

        }

        .form-control {
            border: none !important;
            padding: 1.275rem .75rem !important;
            height: 3rem;

        }

        .label-modify {
            padding: 1.275rem .75rem !important;
            width: 100%;
            height: 3rem;
            display: flex;
            ;
            align-items: center;
            margin-bottom: 0px !important;
        }

        .white {
            color: white;
        }

        .big-font {
            font-size: 24px;
        }

        .fa::before {
            padding-right: 10px;
        }

        .info a {
           
            text-decoration: none;
            cursor: pointer;
        }

        .info p {
            font-size: 18px;
        }

        .info {
            opacity: 0.9;
            max-width: 450px;
        }
        .form-box{
                width: 86%;
                background: white;
                border-radius: 30px;
                margin: auto;
                padding: 50px;
        }
        ::-webkit-input-placeholder {
            /* Chrome/Opera/Safari */
            opacity: 0.7 !important;
        }

        ::-moz-placeholder {
            /* Firefox 19+ */
            opacity: 0.7 !important;
        }

        :-ms-input-placeholder {
            /* IE 10+ */
            opacity: 0.7 !important;
        }

        :-moz-placeholder {
            /* Firefox 18- */
            opacity: 0.7 !important;
        }
    </style>
</head>

<body>
    <div class="row mx-0 height-full">

        <div class="col-lg-6 dark-overlay-bg bg-center d-flex justify-content-center align-items-center p-5">
            <div class="info">
                <div>
                    <i class="fa fa-map-marker color3 big-font" aria-hidden="true">Address</i>
                    <p class="white my-4 ml-4" style="font-weight: 100">Ahsanullah University of Science & Technology

                        141 & 142, Love Road, Tejgaon Industrial Area, Dhaka-1208.</p>
                </div>
                <div>
                    <i class="fa fa-phone color3 big-font" aria-hidden="true">Call</i>
                    <p class="white my-4 ml-4"><a href="tel:1-562-867-5309"  class="color1">123-456-7890</a></p>
                </div>
                <div>
                    <i class="fa fa-envelope-o color3 big-font" aria-hidden="true">General Support</i>
                    <p class="white my-4 ml-4"><a href="mailto:sahajjo@email.com" class="color1">sahajjo@email.com</a></p>

                </div>
            </div>
        </div>
        <div class="col-lg-6 d-flex align-items-center justify-content-center color3-bg">

            <div class="form-box my-5">
                <form method="post" action="<?php echo base_url_route('login-post'); ?>" class="px-5" style="width:100%">

                    <h2 class="text-center mb-5">Contact Us</h2>
                    <br>
                    <?php echo GetMessage('message') ?>
                    <br>
                    <div class="form-group border">
                        <label class="border-bottom label-modify " for="name">Tell Us Your First Name*</label>
                        <input type="text" class="form-control" placeholder="First Name" id="fname" name="fname" required>
                        <small id="emailHelp" class="form-text text-muted"> <?php echo GetError('fname') ?></small>
                    </div>
                    <div class="form-group border">
                        <label class="border-bottom label-modify " for="name">Tell Us Your Last Name*</label>
                        <input type="text" class="form-control" placeholder="Last Name" id="lname" name="lname" required>
                        <small id="emailHelp" class="form-text text-muted"> <?php echo GetError('lname') ?></small>
                    </div>
                    <div class="form-group border">
                        <label class="border-bottom label-modify " for="email">Enter Your Email*</label>
                        <input type="email" name="email" class="form-control" placeholder="Email address" id="email" required>
                        <small id="emailHelp" class="form-text text-muted"> <?php echo GetError('email') ?></small>
                    </div>
                    <div class="form-group border">
                        <label class="border-bottom label-modify " for="email">Enter Your Mobile no</label>
                        <input type="text" name="mobile_number" class="form-control" placeholder="Mobile Number" id="mobile_number">
                    </div>
                    <div class="form-group border ">
                        <label class="border-bottom label-modify" for="pwd">Description</label>
                        <textarea id="pwd" class="w-100" style="border:none;" placeholder="Write here.." name="description" required></textarea>
                        <small id="emailHelp" class="form-text text-muted m-0"> <?php echo GetError('description') ?></small>
                    </div>
                    <input type="hidden" name="from_submit_base_url" value="<?php echo base_url_route('contact-us'); ?>">
                    <input type="hidden" name="from_type" value="<?php echo "contact_us_form"; ?>">
                    <button type="submit" class="color2-btn web-btn color2-btn-hover big-btn d-flex m-auto  btn-modify d-flex align-items-center justify-content-center">Submit</button>


                </form>

            </div>
        </div>

        <?php include_once __DIR__ . '/include/footer.php'; ?>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>


</body>

</html>