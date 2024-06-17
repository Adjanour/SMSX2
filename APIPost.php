<?php

if (isset($_POST['Submit'])) {
    $ID = $_POST['ID'];
    $Name = $_POST['NAME'];
    $Department = $_POST['DEPARTMENT'];
    $Date = $_POST['DATE'];
    $Profile = $_POST['PROFILE'];

    $data = array(
        'EmployeeId' => $ID,
        'EmployeeName' => $Name,
        'Department' => $Department,
        'DateofJoining' => $Date,
        'PhotoFileName' => $Profile
    );
    $json_data = json_encode($data);
    echo $json_data;

    // Replace with the API endpoint URL

    $api_url = "http://127.0.0.1:8000/employee";
    $Id = (int)$ID;
    $url = "$api_url/$Id";

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    curl_close($ch);

// Process the API response, if needed
    if ( $response)
    {
        echo '<script>alert("Added Successfully");';
        echo 'window.location.href = "testAPI.php";</script>';
    }

}