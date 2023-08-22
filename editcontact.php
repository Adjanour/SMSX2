<?php
require_once("include/dbconn.php");
session_start();

$CtcID = $_GET['ID'];
$query = "SELECT * FROM contacts WHERE ctcId = '".$CtcID."'";

$result = mysqli_query($ConnStrx, $query);
while($row = mysqli_fetch_assoc($result))
{
    $ContactId = $row['ctcId'];
    $PhoneNumber = $row['ctcphonenumber'];
    $Name = $row['ctcname'];
    $EmailAddress = $row['ctcemailaddress'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>              
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="about.php">
                <img src="./include/favicon_io/favicon-16x16.png" width="30" height="30" class="d-inline-block align-top" alt="Logo">
                Salem Server
            </a>
            <!-- ... Rest of the navigation code ... -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.html">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logon.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index1.php">Send SMS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view.php">View</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <form action="contactupdate.php?ID=<?php echo $ContactId ?>" method="post">
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Full Name" name="name" value=<?php echo $Name ?> required>
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" placeholder="Email Address" name="emailaddress" value=<?php echo $EmailAddress ?> required>
            </div>
            <div class="mb-3">
                <input type="phonenumber" class="form-control" placeholder="Phone number" name="phonenumber" value=<?php echo $PhoneNumber ?> required>
            </div>
            <input type="submit" class="btn btn-primary" name="Update" value="Update Record">
        </form>
    </div>

    <!-- Add Bootstrap JS and other scripts as needed -->
    <!-- Optional: You can also add Bootstrap JS for additional functionality -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
<script type="text/javascript" src="js/bootstrap.js"></script>

</html>


