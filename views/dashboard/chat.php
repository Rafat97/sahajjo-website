<?php

// $db->getReference('config/website')
//     ->set();

?>

<!DOCTYPE html>

<head>
    <title>Pusher Test</title>
    <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.1.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.5.0/firebase.js"></script>

    <script>
        // // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        // var pusher = new Pusher('728766bf1e65baae4875', {
        //   cluster: 'ap2',
        //   forceTLS: true
        // });

        // var channel = pusher.subscribe('my-channel');
        // channel.bind('my-event', function(data) {
        //   alert(JSON.stringify(data));
        // });
    </script>

    <script>
        // // Your web app's Firebase configuration
        // var firebaseConfig = {
        //     apiKey: "AIzaSyCdPgCRPJuJsG47XxUxafEG_bnSiZttX6I",
        //     authDomain: "mywebsite-e0ab4.firebaseapp.com",
        //     databaseURL: "https://mywebsite-e0ab4.firebaseio.com",
        //     projectId: "mywebsite-e0ab4",
        //     storageBucket: "mywebsite-e0ab4.appspot.com",
        //     messagingSenderId: "582729293020",
        //     appId: "1:582729293020:web:c404ecfa437830aa55a819"
        // };
        // // Initialize Firebase
        // firebase.initializeApp(firebaseConfig);
        // var database = firebase.database();

        // function writeUserData(userId, name, email, imageUrl) {
        //     firebase.database().ref('users/' + userId).set({
        //         username: name,
        //         email: email,
        //         profile_picture: imageUrl
        //     });
        // }
        // writeUserData('userId','name','email','imageUrl');
    </script>
    <?php include_once __DIR__ . '/../include/script.php';  ?>


    <script type="text/javascript" src='https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            max_chars: 2,
            selector: 'textarea#message',
            height: 400,
            mobile: {
                theme: 'mobile',
                toolbar: ['emoticons'],
            },
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'save table directionality emoticons template paste'
            ],
            menubar: false,
            toolbar: 'link image | emoticons',
            theme_advanced_toolbar_location: "top",
            theme_advanced_toolbar_align: "left",
            theme_advanced_statusbar_location: "bottom",
            theme_advanced_resizing: true,
            theme_advanced_toolbar_location: "bottom",
        });
    </script>
    <style>
        .tox-notifications-container {
            display: none;
        }
    </style>
</head>

<body>
    <h1>Pusher Test</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
    </p>

    <form action="javascript:void(0)" id="send_message" action="post">
        <div class="form-group">
            <label for="email">Message</label>
            <textarea id="message" name="message"></textarea>
        </div>
        <input type="hidden" name="from_submit_base_url" value="<?php echo base_url_route('chat'); ?>">
        <input type="hidden" name="from_type" value="<?php echo "send_message_form"; ?>">
        <input type="hidden" name="sender_id" value="<?php echo 1; ?>">
        <input type="hidden" name="reciver_id" value="<?php echo 2; ?>">
        <button type="submit" id="chatsubmitbutton" class="btn btn-primary">Submit</button>

    </form>


    <div class="overflow-auto" id="message_show" style="width:300px;height:100px">
    sadasdasdasdasdkmasdp;
    </div>



    <script>
        $(document).on('submit', '#send_message', function(event) {
            event.preventDefault();
            console.log($('#message').html().length);
            var postValue = $(this).serialize();
            $('#chatsubmitbutton').prop("disabled", true);
            console.log(postValue);
            $.ajax({
                type: 'post',
                url: "<?php echo base_url_route('chat-post'); ?>",
                data: postValue,
                success: function(result) {
                    console.log(result);
                    $('#chatsubmitbutton').prop("disabled", false);
                    $('#message').html("");
                   
                    tinyMCE.activeEditor.setContent('');
                }
            });
        });

        // var timer, delay = 3000;

        // timer = (function() {

            
        // })();


        (function update() {
            var postdata = {
                'from_submit_base_url': "<?php echo base_url_route('chat'); ?>",
                'from_type': 'see_chat_data',
                'sender_id': '1',
                'reciver_id': '2',
            };
            $.ajax({
                //async: false,
                type: 'POST',
                url: '<?php echo base_url_route('chat-post'); ?>',
                data: postdata,
                //cache: false,
                //contentType: false,
                //processData: false,
                success: function(data) {
                    $("#message_show").animate({ 
                        scrollTop: $("#message_show").offset().top
                        }, "slow");
                    console.log(data);
                    $("#message_show").html(data);
                    return;
                },
                error: function(error) {
                    console.log(error);
                },
            }).then(function() { // on completion, restart
                setTimeout(update, 3000); // function refers to itself
            });
        })();
    </script>
</body>