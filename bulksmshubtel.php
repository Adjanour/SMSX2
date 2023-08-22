<?php

function send_bulk_sms($phone_numbers, $message) {
    $api_url = "https://api.hubtel.com/v1/sms/bulk";
    $api_key = "your_api_key";

    $payload = array(
        "to" => $phone_numbers,
        "message" => $message,
    );

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Basic " . base64_encode("$api_key:"),
    ));

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        throw new Exception("Curl error: " . curl_error($ch));
    }

    $json = json_decode($response);

    if ($json->status === 200) {
        echo "Bulk SMS message sent successfully.";
    } else {
        echo "Error sending bulk SMS message: " . $json->error->message;
    }
}

if (isset($_POST["phone_numbers"]) && isset($_POST["message"])) {
    $phone_numbers = explode(",", $_POST["phone_numbers"]);
    send_bulk_sms($phone_numbers, $_POST["message"]);
}
?>
