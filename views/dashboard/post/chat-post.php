<?php


use Kreait\Firebase\Factory;
$firebase = (new Factory)
->withServiceAccount(__DIR__ . '/../mywebsite-e0ab4-firebase-adminsdk-e2ovw-2e190e55bd.json')
->withDatabaseUri('https://mywebsite-e0ab4.firebaseio.com/')
->create();
function add_chat($conn,$var,$sender="",$reciver="")
{
    $db = $conn->getDatabase();
    $char_id = $sender."_".$reciver;
    $val = $db->getReference("chat/$char_id")->push()->set($var);
    $char_id = $reciver."_".$sender;
    $val = $db->getReference("chat/$char_id")->push()->set($var);
    
}
$form_type = $_POST['from_type'];
if ($form_type == 'send_message_form') {

   
    $db = $firebase->getDatabase();
    $sender_id = $_POST['sender_id'];
    $reciver_id = $_POST['reciver_id'];
    $postData = [
        'message' => input_validation($_POST['message']),
        'sender_id' => input_validation($_POST['sender_id']),
        'reciver_id' => input_validation($_POST['reciver_id']),
        'time'      => date('Y-M-d H:i:s',strtotime('now')),
        'send_time' =>strtotime('now'),
        'exp_time'      => strtotime('+1 week'),
    ];
    
    add_chat($firebase,$postData,$sender_id,$reciver_id);

}
elseif ($form_type == 'see_chat_data') {

    $sender_id = input_validation($_POST['sender_id']);
    $reciver_id = input_validation($_POST['reciver_id']);
    $view_chatrf = $sender_id."_".$reciver_id;
    $db = $firebase->getDatabase();
    $reference = $db->getReference("chat/$view_chatrf");
    $snapshot = $reference->getSnapshot();
    $values = $snapshot->getValue();

    foreach ($values as $key => $value) {
       echo htmlspecialchars_decode($value['message']);
    }
    
    echo "snapshot";
}

//  pusher code
// $options = array(
//     'cluster' => 'ap2',
//     'useTLS' => true
//   );
//   $pusher = new Pusher\Pusher(
//     '728766bf1e65baae4875',
//     '5cfc0c08215fc17739b9',
//     '875599',
//     $options
//   );

//   $data['message'] = 'hello world';
//   $pusher->trigger('my-channel', 'my-event', $data);
