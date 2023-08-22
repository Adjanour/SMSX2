<?php
require_once("include/dbconn.php");
require_once("include/functions.php");
session_start();
$UserId =  $_SESSION['user_id']; 
$Fullname = $_SESSION['fullname'];

date_default_timezone_set('Africa/Accra');
$currentTime = time();
$messageDate = date('Y-m-d H:i:s', $currentTime);

// // Check if the user is logged in and is an admin
// if (!isset($_SESSION['user_id']) || $_SESSION['isAdmin'] !== 1) {
//     header("Location: logon.php");
//     exit();
// }

// User Management: Fetch user data for the admin panel
$query = "SELECT * FROM users";
$result = mysqli_query($ConnStrx, $query);

// Template Management: Fetch message templates for the admin panel
$queryTemplates = "SELECT * FROM message_templates";
$resultTemplates = mysqli_query($ConnStrx, $queryTemplates);
$templates = [];

while ($template = mysqli_fetch_assoc($resultTemplates)) {
    $templates[] = $template;
}

// ... Rest of your existing code ...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User and Template Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/total2.css">
</head>
<body>        
    <div class="navigation">
        <ul>
            <li>
                <br>
                <a class="" href="about.php">
                    <img src="./include/favicon_io/favicon.ico" width="50" height="50" class="d-inline-block align-top" alt="Logo">
                    <h1 class="title" style="margin-top: 5px; font-size: large;"> Salem Server</h1>
                </a>
            </li>
            <li>
                <a href="index.html">
                    <span class="icon"><i class="fa fa-home"></i></span>
                    <span class="title">Homepage</span>
                </a>
            </li>
            <li>
                <a href="contacts.php">
                    <span class="icon"><i class="fa fa-user"></i></span>
                    <span class="title">Contacts</span>
                </a>
            </li>
            <li>
                <a href="smspage.php">
                    <span class="icon"><i class="fa fa-envelope"></i></span>
                    <span class="title">SMS</span>
                </a>
            </li>
            <li>
                <a href="signup.php">
                    <span class="icon"><i class="fa fa-heart"></i></span>
                    <span class="title">Signup</span>
                </a>
            </li>
            <li>
                <a href="useraccount.php">
                    <span class="icon"><i class="fa fa-lock"></i></span>
                    <span class="title">Security and Account</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <span class="icon"><i class="fa fa-sign-out"></i></span>
                    <span class="title">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <!--main-->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <i class="fa fa-bookmark"></i>
            </div>
            <!--search-->
            <div class="search">
                <label>
                    <input type="text" placeholder="Search here">
                    <i class="fa fa-search"></i>
                </label>
            </div>
            <div class="date-display">
                <span class="badge bg-primary">
                    <i class="far fa-calendar-alt me-1"></i>
                    <span id="currentDateTime"></span>
                </span>
            </div>
            <div>
                <h4>Welcome <?php echo $Fullname ?></h4>
            </div>
            <!--userimg-->
            <div class="user">
                <a href="account.php"><img src="img/Image (2).jpg" alt="img" width=""></a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="card mt-5">
                    <div class="card-title">
                        <h3 class="bg-secondary text-white text-center py-3"> User Management</h3>
                    </div>
                    <div class="card-body">
                        <p><a class="btn btn-info text-white" href="index.html">+ Add New Record</a></p>
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
            <div class="col-md-6">
                <h2>Template Management</h2>
                <ul class="list-group">
                    <?php foreach ($templates as $template): ?>
                        <li class="list-group-item"><?= $template['templateName'] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <footer>
            <!-- Add footer content here -->
        </footer>
    </div>
            <!-- Include Bootstrap JS and dependencies -->
            <script src="js/number.js"></script>
            <script src="js/bootstrap.js"></script>
            <script src="js/script.js"></script>
            <script src="js/main.js"></script>
            <script src="js/getdate.js"></script>
            <script src="js/clock.js"></script>
            <script src="js/main2.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Bootstrap JS - Be sure to include jQuery and Popper.js before this -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

</body>
</html>
