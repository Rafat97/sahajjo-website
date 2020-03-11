<nav class="color2-bg fixed-top" >
    <div class="row m-0">

        <div class="col-6 d-flex align-items-center">

            <a class="" href="<?php echo base_url_route('dashboard/home'); ?>">
                <img src="<?php echo base_url_route('images/sahajjo.png'); ?>" class="logo-100" alt="">

            </a>


        </div>
        <div class="col-6 pr-0">
            <div id="mySidebar" class="sidebar">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                <a href="<?php echo base_url_route('dashboard/home'); ?>">Home</a>
                <a href="<?php echo base_url_route('dashboard/view-profile?user='.custom_crypt($user_all_value['id'])); ?>">My Profile </a> 
                <a href="<?php echo base_url_route('dashboard/profile-edit'); ?>">Edit Profile</a>
                <a href="<?php echo base_url_route('dashboard/add-post'); ?>">Add Post</a>
                <a href="<?php echo base_url_route('dashboard/all-post'); ?>" class="color3 color3-hover">
                     All Posts
                </a>

                <!-- <a href="#">Notification</a>
                    <a href="#">Messages</a>
                    <a href="#">About</a>
-->
                <a href="<?php echo base_url_route('logout'); ?>">Log Out</a>
            </div>
            <div id="main " style="float: right;">
                <button class="openbtn" onclick="openNav()">☰ </button>

            </div>
        </div>


    </div>

    </div>

</nav>
<script>

    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
      //  document.getElementsByClassName("openbtn").style.display = "none";
       // document.getElementById("main").style.marginLeft = "0px";
    }

    function closeNav() {
        document.getElementById("mySidebar").style.width = "0px";
       // document.getElementById("main").style.marginLeft = "0px";
       // document.getElementsByClassName("openbtn").style.display = "block";
    }
    var mq = window.matchMedia( "(min-width: 1401px)" );
        if (mq.matches) {
           openNav();
        }
        else {
            // window width is greater than 570px
        }
    
</script>