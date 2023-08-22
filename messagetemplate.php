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

// Message Variables: Fetch variable data for dropdown
$queryVariables = "SELECT * FROM message_variables";
$resultVariables = mysqli_query($ConnStrx, $queryVariables);
$variables = [];

while ($vars = mysqli_fetch_assoc($resultVariables)) {
    $variables[] = $vars;
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
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/total2.css">
    <script src="js/main.js"></script>
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
                <a href="smspage.php">
                    <span class="icon"><i class="fa fa-envelope"></i></span>
                    <span class="title">SMS</span>
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
                <a href="account.php"><img src="img/Image (2).jpg" alt="img" width=""></a>
            </div>
        </div>
        
        <div class="container">
        <div class="container mt-5">
        <h2>Template Creation</h2>
        <form action="addtemplate.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="templateName" placeholder="Enter the template name">
                <label for="templateContent">Template Content</label>
                <textarea class="form-control" name="content" id="templateContent"></textarea>
            </div>
            <div class="form-group">
                <label for="variableSelect">Select Variable</label>
                <select class="form-control" id="variableSelect">
                    <option value="">Select Variable</option>
                    <?php foreach ($variables as $variable): ?>
                        <option value="<?= $variable['variableName'] ?>"><?= $variable['variableDescription'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="button" class="btn btn-primary" onclick="insertVariable()">Insert Variable</button>
            <button type="submit" name="Submit" class="btn btn-primary" > Save Template </button> 
        </form>
    </div>
        </div>

    <footer>
        <!-- Add footer content here -->
    </footer>
    <!-- Bootstrap JS - Be sure to include jQuery and Popper.js before this -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
    function insertVariable() {
        var textarea = document.getElementById("templateContent");
        var variableSelect = document.getElementById("variableSelect");
        var selectedVariable = variableSelect.value;

        if (selectedVariable) {
            var cursorPosition = textarea.selectionStart;
            var currentValue = textarea.value;
            var newValue =
                currentValue.substring(0, cursorPosition) +
                "{" + selectedVariable + "}" +
                currentValue.substring(cursorPosition);

            textarea.value = newValue;
        }
    }
    </script>
    <!-- Include Bootstrap JS and dependencies -->
    <script src="js/number.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
    <script src="js/main.js"></script>
    <script src="js/getdate.js"></script>
    <script src="js/clock.js"></script>
    <script src="js/main2.js"></script>

</body>
</html>
