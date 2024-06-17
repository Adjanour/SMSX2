<?php

$ID = $_GET['ID'];
    // Perform the DELETE request here
$Class = "employee";
//$querryParams = array(
//    "class" => "Employees",
//    "Id" => "$ID"
//);
$endPoint = "http://127.0.0.1:8000";
$response = delete($Class , $endPoint , $ID);

if ( $response)
{
    echo '<script>alert("Deleted Successfully");';
    echo 'window.location.href = "testAPI.php";</script>';
}


function delete(string $class, string $endPoint,int $ID): bool|string
{
//    $queryString = http_build_query($queryParameters);
    $url = "$endPoint/$class/$ID";

// Initialize cURL session
    return initializeCURLSession($url);
}

/**
 * @param string $url
 * @return bool|string
 */
function initializeCURLSession(string $url): string|bool
{
    $curl = curl_init();


// Set cURL options
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

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

// Return Response
    return $response;
}

?>
