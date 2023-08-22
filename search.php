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

if (isset($_GET['searchbutton'])) {
    // Get search criteria from form
    $searchContent = $_GET["search"];
    
    // Construct the SQL query
    $sql = "SELECT * FROM contacts WHERE ctcname LIKE '%$searchContent%' OR ctcphonenumber LIKE '%$searchContent%' OR ctcemailaddress LIKE '%$searchContent%'";
         
    // Execute the query
    $result = mysqli_query($ConnStrx,$sql);

    // Check if the query returned any results
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
</head>
<body>
<div class="container mt-5">
                <div class="">
                    <div class="card">
                            <div class="cardName">
                                <div class="card-header">
                                    <h1 class="text-center">Search Results</h1>
                                </div>
                                <div class="card-body">
                                    <table class="table  table-bordered">
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>EmailAddress</th>
                                            <td>Action</td>
                                            
                                        </tr>
                                        <?php
                                         
                                            while ($row2 = mysqli_fetch_assoc($result))
                                            {   
                                                $ContactId = $row2['ctcId'];
                                                $PhoneNumber = $row2['ctcphonenumber'];
                                                $Name = $row2['ctcname'];
                                                $EmailAddress = $row2['ctcemailaddress'];
                                                ?>
                                                <tr>
                                                    <td><?php echo $Name ?></td>
                                                    <td><?php echo $PhoneNumber ?></td>
                                                    <td><?php echo $EmailAddress ?></td>
                                                    <td><a class="btn btn-primary" href="editcontact.php?ID=<?php echo $ContactId ?>">Edit </a>  ||  <a class="btn btn-danger" href="deletecontact.php?Del=<?php echo $ContactId?>">Delete</a></td>

                                                </tr>
                                                
                                                <?php
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div>
            </div>
</body>
</html>


