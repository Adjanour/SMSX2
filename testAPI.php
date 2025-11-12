<?php

use Elementor\Core\Files\File_Types\Json;

$queryParameters = array(
   $class = "Employees"
);

$endPoint = "http://127.0.0.1:8000";
/**
 * @param array $queryParameters
 * @param string $endPoint
 * @return bool|string
 */
function endpoint(array $queryParameters, string $endPoint): bool|string
{
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

    return $response ;
}

function delete(array $queryParameters, string $endPoint): bool|string
{
    $queryString = http_build_query($queryParameters);

    $url = "$endPoint?$queryString";

// Initialize cURL session
    return initializeCURLSession($url);
}


$ch = curl_init();
$api_url = "http://127.0.0.1:8000/employees";

curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);

if(curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
}

curl_close($ch);

$data = json_decode($response, true);

//echo var_dump($data);
//echo "<link href=css/bootstrap.css>";
//echo "<table class='table table-bordered'>";
//echo "<tablebody>";
//
//foreach($employee = $data as $employees )
//    {
//        echo "<tr>";
//        echo "<td>";
//        echo  $employees['EmployeeName'];
//        echo "</td>";
//        echo "<td>";
//        echo  $employees['Department'];
//        echo "</td>";
//        echo "<td>";
//        echo  $employees['DateofJoining'];
//        echo "</td>";
//        echo "<td>";
//        echo  $employees['PhotoFileName'];
//        echo "</td>";
//        echo "</tr>";
//
//    }
//
//
//echo "</tablebody>";
//echo "</table>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Add Bootstrap CSS link -->
    <link href="../../../Users/Kirk/PhpstormProjects/API_INTERACTION/css/bootstrap.css" rel="stylesheet">
    <link href="../../../Users/Kirk/PhpstormProjects/API_INTERACTION/css/total2.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="sub-container">
        <div class="card-title " >
            <h3 class="bg-secondary text-white text-center py-3" style="border-radius: 25px"> List Of Registered Members</h3>
        </div>
        <div class="card-body" style="border-radius: 25px">
            <table class="table  table-bordered" style="border-radius: 25px">
                <tr>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Email Address</th>
                    <th>Action</th>
                </tr>
                <?php
                foreach($employee = $data as $employees )
                {
                    ?>

                    <tr>
                        <td><?php echo $employees['EmployeeName']?></td>
                        <td><?php echo $employees['Department'] ?></td>
                        <td><?php echo $employees['DateofJoining'] ?></td>
                        <td><?php echo $employees['PhotoFileName'] ?></td>
<!--                  <td>--><?php // echo $PhotoFileName ?><!--</td>-->
                        <td>
                            <a class="btn btn-primary" href="testEdit.php?ID=<?php echo $employees['EmployeeId']?>">Edit </a> | <a class="btn btn-danger" href="APIDlete.php?ID=<?php echo $employees['EmployeeId']?>">Delete </a>

                        </td>
<!--                        <button class="btn btn-primary" onclick="">Edit </button>  |  <button class="btn btn-danger" onclick="sendDeleteRequest()">Delete</button>-->
                    </tr>

                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script>
    document.getElementById("deleteButton").addEventListener("click", function() {
        // Perform the DELETE request here
        sendDeleteRequest();
    });

    function sendDeleteRequest() {
        // Implement the DELETE request using AJAX
        var xhr = new XMLHttpRequest();
        var api_url = "http://127.0.0.1:8000"; // Replace with your API URL

        xhr.open("DELETE", api_url, true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                alert("Resource deleted successfully!");
                // You can perform additional actions here upon success
            } else {
                alert("Error: " + xhr.status);
            }
        };

        xhr.send();
    }
</script>

</body>
</html>
