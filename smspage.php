<?php
require_once("include/dbconn.php");

session_start();
$UserId =  $_SESSION['user_id']; 
$Fullname = $_SESSION['fullname'];

date_default_timezone_set('Africa/Accra');
$currentTime = time();
$messageDate = date('Y-m-d H:i:s', $currentTime);

$query = "SELECT * FROM contacts";
$result = mysqli_query($ConnStrx,$query);

$query3 = "SELECT * FROM message_templates";
$resulttemplate = mysqli_query($ConnStrx,$query3);

$joinquerry = "SELECT usrId, username, COUNT(*) AS messages FROM messages JOIN users ON messages.usrIdfk = users.usrID where users.usrID = ?" ;
$stmt = mysqli_prepare($ConnStrx, $joinquerry);
mysqli_stmt_bind_param($stmt, "i", $UserId);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt,$userId, $username, $messages);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
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
                <a href="account.php"><img src="img/Image (2).jpg" alt="img" width=""></a>
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
        <div class="container">
            <div class="">
                <!-- Toolbar (Navbar) -->
                <nav class=" toolbar" style="width:fit-content; margin-left:auto; margin-right:auto; background-color:#8af129;">
                            <div class="collapse navbar-collapse" id="toolbarNav" style="display: flex; justify-content: center; align-items: center;">
                                <ul class="navbar-nav " style="display:grid; grid-template-columns: repeat(4,1fr);">
                                    <li class="nav-item-fluid">
                                        <a href="#phone_number" class="btn btn-primary" style="background-color: black; border-color:black">Enter Number</a>
                                    </li>
                                    <li class="nav-item-fluid">
                                        <a href="#SelectedNumber" class="btn btn-primary"style="background-color: black; border-color:black">Select Number</a>
                                    </li>
                                    <li class="nav-item-fluid">
                                        <button class="btn btn-primary" style="background-color: black; border-color:black" id="openDialog">Add Contact</button>
                                        <div id="contactDialog" class="dialog">
                                            <div class="dialog-content">
                                                <span class="close-btn" id="closeDialog">&times;</span>
                                                <?php include 'addContactForm.php'; ?>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item-fluid">
                                            <select class=" btn btn-primary"style="background-color: black; border-color:black" name="selectedTemplate" id="SelectedTemplate">
                                            <option value="">Select a Template</option>
                                            <?php
                                            while($row = mysqli_fetch_assoc($resulttemplate))
                                            {
                                                $templatename = $row['templateName'];
                                                $templateContent = $row['templateContent'];
                                            ?>
                                            <option value="<?php echo $templateContent ?>"><?php echo $templatename?></option>
                                                <?php
                                            }
                                            ?>
                                            </select><br> 
                                    </li>
                                </ul>
                            </div>
                </nav>
                <div class="mb-3">
                    <form action="sms.php" method="post">
                        <div class="mb-3">
                                <div class="col">
                                            <select class="form-select" name="phone_number_selected" id="SelectedNumber">
                                            <option value="">Select a number</option>
                                            <?php
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                                $phoneNumber = $row['ctcphonenumber'];
                                                $Name = $row['ctcname'];
                                                $ctcId = $row['ctcId'];
                                            
                                            ?>
                                             <option value='{"contact": "<?php echo $phoneNumber ?>", "name": "<?php echo $Name ?>"}'><?php echo $Name ?></option>
                                                <?php
                                            }
                                            ?>
                                            </select><br> 
                                        <div class="row mb-3">
                                                <div class="col" style="display:flex;justify-content:flex-end;">
                                                    <input type="text" style="margin-right: 5px;" id="phone_number" class="form-control" name="phone_number" placeholder="Type a phone number in international format. For example: +23354159968">
                                                    <select class="form-select" style="width:100px;" name="country_code" id="country_code" placeholder="Countrycode" value="Country codes">
                                                        <option>Code</option>
                                                        <option value="+233">GH</option>
                                                        <option value="+234">NGR</option>
                                                        <option value="+1">USA</option>
                                                    </select>
                                                </div>
                                        </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <textarea class="form-control" name="message" id="message" cols="50" rows="10" placeholder="Enter your message here"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="mb-3">
                                        <div class="col mt-3 d-flex justify-content-end">
                                                <input class="btn btnhov" style="transform:scale(1.1); background-color:#8af129;" type="submit" value="Send" name="Send">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </form>    
                </div>
            
                    
        </div>
    </div>
</div>

    <footer>
        <!-- Add footer content here -->
    </footer>
            <script>
                const selectedTemplate = document.getElementById("SelectedTemplate");
            const messageInput = document.getElementById("message");

            selectedTemplate.addEventListener("change", function () {
            messageInput.value = selectedTemplate.value;
        });
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
