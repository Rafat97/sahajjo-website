<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <?php include_once 'include/script.php';  ?>

</head>

<body>
    <br>
    <?php echo GetMessage('message') ?>
    <br>
    <form action="<?php echo base_url_route('/signup-post'); ?>" id="signUp" method="post">

        <div class="form-check">
            <div class="mdc-text-field mdc-text-field--outlined w-100">
                <input class="mdc-text-field__input" autocomplete="fname" name="fname" required maxlength=20>
                <div class="mdc-notched-outline">
                    <div class="mdc-notched-outline__leading"></div>
                    <div class="mdc-notched-outline__notch">
                        <label for="text-field-hero-input" class="mdc-floating-label">First Name</label>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                </div>
            </div>
        </div>
        <br>
        <?php echo GetError('fname') ?>
        <br>

        <div class="form-check">
            <div class="mdc-text-field mdc-text-field--outlined w-100">
                <input class="mdc-text-field__input" autocomplete="lname" name="lname" required maxlength=20>
                <div class="mdc-notched-outline">
                    <div class="mdc-notched-outline__leading "></div>
                    <div class="mdc-notched-outline__notch">
                        <label for="text-field-hero-input" class="mdc-floating-label">Last Name</label>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                </div>

            </div>
        </div>
        <br>
        <?php echo GetError('lname') ?>
        <br>
        <div class="form-check">
            <div class="mdc-text-field mdc-text-field--outlined w-100">
                <input type="email" class="mdc-text-field__input" autocomplete="email" name="email" required>
                <div class="mdc-notched-outline">
                    <div class="mdc-notched-outline__leading"></div>
                    <div class="mdc-notched-outline__notch">
                        <label for="text-field-hero-input" class="mdc-floating-label">Email</label>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                </div>
            </div>
        </div>
        <br>
        <?php echo GetError('email') ?>
        <br>

        <div class="form-check">
            <div class="mdc-text-field mdc-text-field--outlined w-100">
                <input type="password" class="mdc-text-field__input" autocomplete="new-password" name="password" required>
                <div class="mdc-notched-outline">
                    <div class="mdc-notched-outline__leading"></div>
                    <div class="mdc-notched-outline__notch">
                        <label for="text-field-hero-input" class="mdc-floating-label">Password</label>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                </div>
            </div>
        </div>
        <br>
        <?php echo GetError('password') ?>
        <br>
        <div class="form-check">
            <div class="mdc-text-field mdc-text-field--outlined w-100">
                <input type="password" class="mdc-text-field__input" autocomplete="new-password" name="confirm_password" required>
                <div class="mdc-notched-outline">
                    <div class="mdc-notched-outline__leading"></div>
                    <div class="mdc-notched-outline__notch">
                        <label for="text-field-hero-input" class="mdc-floating-label">Confirm Password</label>
                    </div>
                    <div class="mdc-notched-outline__trailing"></div>
                </div>
            </div>
        </div>
        <br>
        <?php echo GetError('confirm_password') ?>
        <br>
        <input type="hidden" name="from_submit_base_url" value="<?php echo base_url(); ?>">
        <input type="hidden" name="from_type" value="<?php echo"signup_form"; ?>">
        <input class="mdc-button mdc-button--outlined" type="submit" value="Submit">
    </form>


    <br>
    
</body>
<script>
    var x = document.querySelectorAll('.mdc-text-field');
    for (i = 0; i < x.length; i++) {
        var textField = new mdc.textField.MDCTextField(x[i]);
    }
    // jQuery.validator.setDefaults({
    //     debug: true,
    //     success: "valid"
    // });
    // $("#signUp").validate({
    //     rules: {
    //         fname: "required",
    //         email: {
    //             required: true,
    //             email: true
    //         }
    //     },
    //     messages: {
    //         fname: {
    //             required: "Please give first name with in 20 character",
    //         }
    //     },
    //     submitHandler: function(form) {
    //         console.log(form);
    //         alert("ok")
    //         // some other code
    //         // maybe disabling submit button
    //         // then:
    //         //$(form).submit();
    //     }
    // });
</script>

</html>