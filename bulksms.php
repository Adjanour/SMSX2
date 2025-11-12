<?php
global $ConnStrx;
require_once("include/dbconn.php");
require_once("include/functions.php");
session_start();
$UserId =  $_SESSION['user_id']; 

//Get Current date and time
date_default_timezone_set('Africa/Accra');
$currentTime = time();
$messageDate = date('Y-m-d H:i:s', $currentTime);

if (isset($_POST['Send'])) {
    $PhoneNumbers = explode(',', $_POST['phone_numbers']); // Extract phone numbers from input
    $Message =  $_POST['message'];
    $Sender = "Salem Inc.";

  
$successCount = 0; // Count successful SMS sends

foreach ($PhoneNumbers as $PhoneNumber) {
  echo $PhoneNumber;
  $endPoint = config('config','mnotify_sms_api_endpoint');
  $apiKey = config('config','mnotify_sms_api_key');
  $endPoint = "$endPoint";
  $apiKey = "$apiKey";
  $phoneNumber = $PhoneNumber;
  $message = $formattedMessage;
  $sender = "Salem Inc.";
  
  $queryParameters = array(
      "key" => $apiKey,
      "to" => $phoneNumber,
      "msg" => $message,
      "sender_id" => $sender
  );
  
  $queryString = http_build_query($queryParameters);
  
  $url = "$endPoint?$queryString";
  
  // Initialize cURL session
  $curl = curl_init($url);
  
  // Set cURL options
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  
  // Execute cURL request and get the response
  $response = curl_exec($curl);
  
  // Check for cURL errors
 if (curl_errno($curl)) {
    // Handle specific error codes
    $errorCode = curl_errno($curl);
    $errorMessage = curl_error($curl);
    echo 'cURL error (' . $errorCode . '): ' . $errorMessage;
}

  
  // Close cURL session
  curl_close($curl);
  
        
  // Insert into database for each recipient
       
    $status = isset($result['success']) && $result['success'] == true ? 'sent' : 'not sent';
    $sql = "INSERT INTO messages (reciever, sender, body, status, usrIdfk) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($ConnStrx, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $PhoneNumber, $Sender, $Message, $status, $UserId);
    mysqli_stmt_execute($stmt);

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

