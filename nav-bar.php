<?php
require_once("include/dbconn.php");

session_start();

# TODO: Find a way to perfect uer images
$UserId =  2;
$Fullname = "Kirk";

date_default_timezone_set('Africa/Accra');
$currentTime = time();
$messageDate = date('Y-m-d H:i:s', $currentTime);

$query = "SELECT * FROM contacts WHERE  usrId = $UserId ";
$result = mysqli_query($ConnStrx,$query);

$query3 = "SELECT * FROM message_templates WHERE  usrId = $UserId ";
$resulttemplate = mysqli_query($ConnStrx,$query3);

$joinquerry = "SELECT usrId, username, COUNT(*) AS messages FROM messages JOIN users ON messages.usrIdfk = users.usrID where users.usrID = ?" ;
$stmt = mysqli_prepare($ConnStrx, $joinquerry);
mysqli_stmt_bind_param($stmt, "i", $UserId);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt,$userId, $username, $messages);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);


$query4 = "SELECT * FROM users Where usrId = '".$UserId."' ";
$result4 = mysqli_query($ConnStrx,$query4);
$row = mysqli_fetch_assoc($result4);
$imgpath = $row['imgpath'];
if ($imgpath == NUll )
{
    $imgpath="img/boss.png";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../../Users/Kirk/PhpstormProjects/API_INTERACTION/css/font-awesome.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/total2.css">
    <script src="js/main.js"></script>
    <link rel="manifest" href="/manifest.json">

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
            <a href="bulksmspage.php">
                <span class="icon"><i class="fa fa-envelope"></i></span>
                <span class="title">Bulk SMS</span>
            </a>
        </li>
        <li>
            <a href="messagetemplate.php">
                <span class="icon"><i class="fa fa-heart"></i></span>
                <span class="title">Template</span>
            </a>
        </li>
        <li>
            <a href="account.php">
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
            <a href="account.php"><img src="<?php echo $imgpath ?>" alt="img" width=""></a>
        </div>
    </div>
    <div class="cardBox">
        <div class="card">
            <div>
                <div class="numbers">5</div>
                <div class="cardName">Inbox</div>
            </div>
            <div class="iconBx">
                <i class="fa fa-envelope"></i>
            </div>
        </div>

        <div class="card">
            <div>
                <div class="numbers"><?php echo $messages ?></div>
                <div class="cardName">Sent</div>
            </div>
            <div class="iconBx">
                <i class="fa fa-paper-plane"></i>
            </div>
        </div>
        <div class="card">
            <div>
                <div class="numbers">3</div>
                <div class="cardName">Drafts</div>
            </div>
            <div class="iconBx">
                <i class="fa fa-file"></i>
            </div>
        </div>
    </div>
</div>
<script src="js/number.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/script.js"></script>
<script src="js/main.js"></script>
<script src="js/getdate.js"></script>
<script src="js/clock.js"></script>
<script src="js/main2.js"></script>
</body>
</html>
