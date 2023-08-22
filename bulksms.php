<?php 

require_once("include/dbconn.php");
require_once("include/functions.php");
session_start();
$UserId =  $_SESSION['user_id']; 

//Get Current date and time
date_default_timezone_set('Africa/Accra');
$currentTime = time();
$messageDate = date('Y-m-d H:i:s', $currentTime);

//Check if form is submitted 
if (isset($_POST['Send'])) {
    $PhoneNumbers = explode(',', $_POST['phone_numbers']); // Extract phone numbers from input
    $Message =  $_POST['message'];
    $Sender = "Salem Inc.";
    
    // SMS API Integration
    $endPoint = config('config','mnotify_sms_api_endpoint_quick');
    $apiKey = config('config','mnotify_sms_api_key');
    $endPoint = "$endPoint";
    $apiKey = "$apiKey";
    $phoneNumber = $PhoneNumber;
    $message = $Message;
    $sender = "Salem Inc.";
    $url = $endPoint . '?key=' . $apiKey;

    $smsData = [
        'recipient' => $PhoneNumbers,
        'sender' => 'mNotify',
        'message' => $Message,
        'is_schedule' => 'false',
        'schedule_date' => ''
    ];

    $ch = curl_init();
    $headers = array();
    $headers[] = "Content-Type: application/json";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($smsData));
    $result = curl_exec($ch);
    $result = json_decode($result, TRUE);
    curl_close($ch);

    $successCount = 0; // Count successful SMS sends

    foreach ($PhoneNumbers as $PhoneNumber) {
        // Insert into database for each recipient
        $status = isset($result['success']) && $result['success'] == true ? 'sent' : 'not sent';
        $sql = "INSERT INTO messages (reciever, sender, body, status, usrIdfk) 
                VALUES ('$PhoneNumber', '$Sender', '$Message', '$status', '$UserId')";
        mysqli_query($ConnStrx, $sql);

        if (isset($result['success']) && $result['success'] == true) {
            $successCount++;
        }
    }

    if ($successCount > 0) {
        echo '<script>alert("' . $successCount . ' messages sent successfully!");';
        echo 'window.location.href = "smspage.php";</script>';
    } else {
        echo '<script>alert("No messages sent!");';
        echo 'history.back();</script>';
    }
}

?>