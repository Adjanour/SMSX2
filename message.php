<?php

// // Include the mnotify library
// require_once 'mnotify.php';

// // Get the contact from the database
// $contact = getContactFromDatabase();

// // Create a new instance of the mnotify class
// $mnotify = new Mnotify();

// // Set your mnotify API key
// $mnotify->setApiKey('YOUR_API_KEY');

// // Set the sender ID
// $mnotify->setSenderId('YOUR_SENDER_ID');

// // Set the recipient's phone number
// $mnotify->setRecipient($contact['phone_number']);

// // Set the message content
// $message = 'Welcome to our platform!';

// // Send the message
// $response = $mnotify->sendMessage($message);

// // Check if the message was sent successfully
// if ($response['status'] == 'success') {
//     echo 'Message sent successfully!';
// } else {
//     echo 'Failed to send message. Error: ' . $response['message'];
// }

// // Function to get the contact from the database
// function getContactFromDatabase()
// {
//     // Your code to retrieve the contact from the database goes here
//     // Replace this with your actual implementation
//     $contact = [
//         'phone_number' => '+1234567890',
//         'name' => 'John Doe',
//         'email' => 'johndoe@example.com'
//     ];

//     return $contact;
// }


// Include the mnotify library
require_once 'mnotify.php';

// Create a new instance of the mnotify class
$mnotify = new Mnotify();

// Set your mnotify API key
$mnotify->setApiKey('l4OSeqp1RxuNBY3dmNr6J1NlP');

// Set the sender ID
$mnotify->setSenderId('mNotify');

// Set the recipient's phone number
$mnotify->setRecipient('+233541559369');

// Set the message content
$message = 'Welcome to our platform!';

// Send the message
$response = $mnotify->sendMessage($message);

// Check if the message was sent successfully
if ($response) {
    echo 'Message sent successfully!';
    echo ($response['message']);
} else {
    echo 'Failed to send message. Error: ' . $response['message'];
}


