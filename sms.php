<?php
require_once("include/dbconn.php");
require_once("include/functions.php");
session_start();
$UserId =  $_SESSION['user_id']; 

//Get Current date and time
date_default_timezone_set('Africa/Accra');
$currentTime = time();
$messageDate = date('Y-m-d H:i:s', $currentTime);

//Check is form is submited 
if (isset($_POST['Send'])) {
    $PhoneNumber = ($_POST['phone_number']);
    $Message =  $_POST['message'];
    $Sender = "Salem Inc.";
    $Name = $_POST['phone_number_selected'];
    $CountryCode = $_POST['country_code'];

    if ($Name != null){
      $selectedObject = json_decode($Name);
      // Replace placeholders in the message template
      $formattedMessage = str_replace("{NAME}", $selectedObject->name, $Message);
    }
    else{
      $formattedMessage = $Message;
    }
    $NewNumber = preg_replace('/0/', '', $PhoneNumber, 1);

    $FormattedPhoneNumber = $CountryCode . $NewNumber;

}

$sql = 'CALL update_message_counts(?)';
$stmt = mysqli_prepare($ConnStrx, $sql);
mysqli_stmt_bind_param($stmt,'s', $messageDate);
mysqli_stmt_execute($stmt);


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
  
  // Process the response  
  if ($response)
    {
        $sql = "INSERT INTO messages (reciever, sender, body, status,usrIdfk) VALUES ('$PhoneNumber', '$Sender', '$Message', 'sent','$UserId')";
        mysqli_query($ConnStrx,$sql);
        echo '<script>alert("Message sent successfully!");';
        echo 'window.location.href = "smspage.php";</script>';
      
     }
  else
      {echo '<script>alert("Message not sent!");';
        echo 'history.back();</script>';
      }

?>
