<?php 
require_once("include/dbconn.php");

$query = "SELECT * FROM users";
$result = mysqli_query($ConnStrx, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Add Bootstrap CSS link -->
    <link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="about.php">
                <img src="./include/favicon_io/favicon-32x32.png" width="30" height="30" class="d-inline-block align-top" alt="Logo">
                Salem Server
            </a>
            <!-- ... Rest of the navigation code ... -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
      
    <div class="container">
        <div class="row">
            <div class="col m-auto">
                <div class="card mt-5">
                    <div class="card-title">
                        <h3 class="bg-secondary text-white text-center py-3"> List Of Registered Members</h3>
                    </div>
                    <div class="card-body">
                        <table class="table  table-bordered">
                            <tr>
                                <th>User ID</th>
                                <th>Full Name</th>
                                <th>User Name</th>
                                <th>Email Address</th>
                                <th>Admin Staus</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            <?php
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    $UserID = $row['usrID'];
                                    $FullName = $row['fullname'];
                                    $UserName = $row['username'];
                                    $EmailAddress = $row['emailaddress'];
                                    $isAdmin = $row['isAdmin'] ==1 ? "Admin" : "User";
                                    $isActive = $row['isActive'] == 1 ? "Active" : "Not Active";
                                    ?>
                        
                                    <tr>
                                        <td><?php echo $UserID?></td>
                                        <td><?php echo $FullName?></td>
                                        <td><?php echo $UserName?></td>
                                        <td><?php echo $EmailAddress?></td>
                                        <td><?php  echo $isAdmin ?></td>
                                        <td><?php  echo $isActive ?></td>
                                        <td><a class="btn btn-primary" href="edit.php?ID=<?php echo $UserID ?>">Edit </a>  |  <a class="btn btn-danger" href="delete.php?Del=<?php echo $UserID?>">Delete</a></td>
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
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>
