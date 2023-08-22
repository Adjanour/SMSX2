<?php
session_start();
require_once 'include/functions.php';
$array = readData($_SESSION['FilePath'].$_SESSION['File']);
$arrayDetails1 = retrieveDetails($array,0);
$arrayDetails2 = retrieveDetails($array,1);
$array2[] = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="card mt-5">
            <div class="col ">
                <div class="card-header">
                    <h3 class="bg-secondary text-white text-center py-3">File Data</h3>
                </div>
                <table class="table table-bordered">
                <thead>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Birthdate</th>
                </thead>
                <tbody>
                    <?php 
                    foreach($array as $key => $value){ ?>
                    <tr>
                        <td><?php echo $value[0]; ?></td>
                        <td><?php echo $value[1]; ?></td>
                        <td><?php echo $value[2]; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>

                </table>
                <div class="card-footer">
                    <h3 class="bg-secondary text-white text-center py-3">Phone Numbers</h3>
                    <?php
                       echo "<pre>";
 
                       // To display array data
                       var_dump($array2);
                       echo "</pre>";
                        ?>
                </div>
                <div class="card-footer">
                    <a href="index.php" class="btn btn-primary">Back</a>
                    <a href="include/download.php" class="btn btn-success">Download</a>
                    <a href="include/delete.php" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</body>
</html>