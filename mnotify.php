<?php
//    require 'connection.php';
//
//    // Get the email and password from the user input
//    $contact = $_POST["telephone"];
//
//    // Prepare the SQL query
//    $sql_query = "SELECT id FROM Booking WHERE contact = '$contact'";
//
//    // Execute the query and get the result
//    $result = mysqli_query($conn, $sql_query);
//
//    // Check if the query returned any row
//    if (mysqli_num_rows($result) > 0) {
//        // Fetch the row as an associative array
//        $row = mysqli_fetch_assoc($result);
//        // Get the id value from the array
//        $recipient_id = $row["id"];
//        // Echo the id value
//        echo $recipient_id;
//    } else {
//        // No row found, echo an error message
//        echo "No user found with that email and password";
//    }


// Define the mnotify class
class Mnotify
{
    // Declare the properties
    private $api_key;
    private $sender_id;
    private $recipient;
    private $base_url = 'https://api.mnotify.com/api/sms/quick';
    private $url;


    // Define the constructor
    public function __construct()
    {
        // Initialize the properties
        $this->api_key = "fo0K4z1VizxW9Ie4oE3zxVmKY";
        $this->sender_id = "Salem Inc.";
        $this->recipient = '';
    }

    // Define the setter methods
    public function setApiKey($api_key)
    {
        // Set the api key
        $this->api_key = $api_key;
    }

    public function setUrl($url){
        $this->url = $url;
    }
    public function setSenderId($sender_id)
    {
        // Set the sender id
        $this->sender_id = $sender_id;
    }

    public function setRecipient($recipient)
    {
        // Set the recipient
        $this->recipient = $recipient;
    }

    // Define the getter methods
    public function getApiKey()
    {
        // Get the api key
        return $this->api_key;
    }

    public function getSenderId()
    {
        // Get the sender id
        return $this->sender_id;
    }

    public function getRecipient()
    {
        // Get the recipient
        return $this->recipient;
    }

    // Define the send message method
    public function sendMessage($message)
    {
        $queryParameters = array(
            "key" => $this->api_key,
            "to" => $this->recipient,
            "msg" => $message,
            "sender_id" => $this->sender_id
        );

        $queryString = http_build_query($queryParameters);

        $url = $this->base_url;

        $this->$url = $url;
        // Initialize cURL session
        $curl = curl_init($url);

        // Set cURL options
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL request and get the response
        $response = curl_exec($curl);

        curl_close($curl);

        // Decode the response as an associative array
        $response = json_decode($response, true);

        // Return the response
        return $response;
    }
}
