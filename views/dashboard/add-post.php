<?php
include_once __DIR__ . '/user-conroller.php';
$all_catagory = $fmw_database->get_result("SELECT * FROM `category` ");

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Add Post | Sahajjo</title>

    <?php include_once __DIR__ . '/../include/script-head.php'; ?>
    <script type="text/javascript" src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://www.jqueryscript.net/demo/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.css">

</head>
<script>
    tinymce.init({
        selector: 'textarea#description',
        height: 400,
        mobile: {
            theme: 'mobile'
        },
        plugins: [
            'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'save table directionality emoticons template paste'
        ],

        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample |link image | print preview media fullpage | forecolor backcolor emoticons'
    });
</script>
<style>
    .tox-notifications-container {
        display: none !important;
    }
    .tox-statusbar__branding{
        display: none !important;
    }
    .tox-statusbar{
          display: none !important;
          opacity: 0 !important
    }
    .bootstrap-tagsinput{
        border:none;
    }
    @media(min-width: 768px){
        .max-width-pc-60{
            max-width: 60%;
        }
    }
</style>

<body>

    <?php include_once __DIR__ . '/include/nav-bar.php'; ?>

    <div class="container-fluid">
        <div class="mx-auto max-width-pc-60" style=" ">
            <br>
            <?php echo GetMessage('message') ?>
            <br>
            <form action="<?php echo base_url_route('/dashboard/post-request') ?>" id="AddPost" method="post">
                <!-- 
                <div class="form-check">
                    <div class="mdc-text-field mdc-text-field--outlined w-100">
                        <input type="text" class="mdc-text-field__input" autocomplete="title" name="title" required>
                        <div class="mdc-notched-outline">
                            <div class="mdc-notched-outline__leading"></div>
                            <div class="mdc-notched-outline__notch">
                                <label for="text-field-hero-input" class="mdc-floating-label">Title</label>
                            </div>
                            <div class="mdc-notched-outline__trailing"></div>
                        </div>
                    </div>
                </div>
                -->
                <div class="form-group border">
                    <label for="exampleInputFirstName" class="border-bottom label-modify">Post Title*</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Title" required value="<?php echo GetOldInput('title') ?>">
                    <small id="emailHelp" class="form-text text-muted"><?php echo GetError('title') ?></small>
                </div>
                <div class="form-group border">
                    <label for="exampleInputFirstName" class="border-bottom label-modify">Short description*</label>
                    <h6 class="pull-right p-3 border-bottom" id="count_message">100 remaining</h6>
                    <input type="text" class="form-control" id="short_content" name="short_content" maxlength="100" placeholder="Short description" required value="<?php echo GetOldInput('title') ?>">
                    <small id="emailHelp" class="form-text text-muted"><?php echo GetError('short_content') ?></small>
                </div>

                <div class="form-group border">
                    <label for="exampleInputFirstName " class="border-bottom label-modify">Content or Description*</label>
                    <textarea id="description" name="content" require><?php echo GetOldInput('content') ?></textarea>
                    <small id="emailHelp" class="form-text text-muted m-0"><?php echo GetError('content') ?></small>
                </div>

                <div class="form-group border" style="min-height: 70px">
                    <label for="exampleInputFirstName" class="border-bottom label-modify">Catagory*</label>
                    <select class="form-control" style="min-height: 70px" name='catagory_id' id="catagory_id" require>
                        <?php
                        foreach ($all_catagory as $key => $value) :
                            echo "<option value='" . $value['id'] . "'>" . $value['title'] . "</option>";
                        endforeach;
                        ?>
                    </select>
                </div>

                <div class="form-group border">
                    <label for="city_tag" class="border-bottom label-modify">Please write a sub catagory</label>
                    <input type="text" value="" name="sub_cat" name="sub_cat" data-role="tagsinput" class="form-control" />
                </div>
                <div class="form-group border">
                    <label for="city_tag" class="border-bottom label-modify">Please write a Tags</label>
                    <input type="text" value="" name="tags" name="tags" data-role="tagsinput" class="form-control" />
                </div>

                <div class="form-group border" >
                    <label for="exampleInputFirstName" class="border-bottom label-modify">Status*</label>
                    <select class="form-control" style="min-height: 70px" name='status'>
                        <option value="publish">Publish</option>
                        <option value="unpublish">Unpublish</option>
                    </select>
                </div>

                <input type="hidden" name="user_id" value="<?php echo GetSession('user_id'); ?>">
                <input type="hidden" name="from_submit_base_url" value="<?php echo base_url_route('/dashboard/add-post'); ?>">
                <input type="hidden" name="from_type" value="<?php echo "dashboard_user_add_post_form"; ?>">


                <input  type="submit" value="Submit" class="color2-btn d-flex justify-content-center mx-auto web-btn color2-btn-hover big-btn">
            </form>
        </div>
    </div>

    <br>
    <?php include_once __DIR__ . '/../include/footer.php'; ?>


    <?php include_once __DIR__ . '/../include/script-bottom.php'; ?>

    <script src="https://www.jqueryscript.net/demo/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


</body>

<script>
    var x = document.querySelectorAll('.mdc-text-field');
    for (i = 0; i < x.length; i++) {
        var textField = new mdc.textField.MDCTextField(x[i]);
    }
    var text_max = 100;
    $('#short_content').keyup(function() {

        var text_length = $('#short_content').val().length;
        var text_remaining = text_max - text_length;
        $('#count_message').html(text_remaining + ' remaining');

    });
    // $(document).ready(function() {

    //     jQuery("#AddPost").validate({
    //         debug: true,
    //         rules: {

    //             title: {
    //                 required: true,
    //             },
    //             description: {
    //                 required: true,
    //             }
    //         },
    //         submitHandler: function(form) {
    //             var postData = $("#AddPost").serialize();
    //             $.ajax({
    //                 async: false,
    //                 type: 'post',
    //                 url: "<?php echo base_url_route('/dashboard/post-request') ?>",
    //                 data: postData,
    //                 success: function(result) {
    //                     console.log(result);
    //                 },
    //                 error: function(result) {
    //                     console.log(result);
    //                 },
    //             });
    //         },
    //     });


    // });
</script>

</html>