<?php
require_once("include/dbconn.php");
session_start();
$query = "SELECT * FROM contacts";
$result = mysqli_query($ConnStrx,$query);
date_default_timezone_set('Africa/Accra');
$currentTime = time();
$messageDate = date('Y-m-d H:i:s', $currentTime);
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
                <a href="smspage.php">
                    <span class="icon"><i class="fa fa-envelope"></i></span>
                    <span class="title">SMS</span>
                </a>
            </li>
            <li>
                <a href="logon.php">
                    <span class="icon"><i class="fa fa-tags"></i></span>
                    <span class="title">Login</span>
                </a>
            </li>
            <li>
                <a href="signup.php">
                    <span class="icon"><i class="fa fa-heart"></i></span>
                    <span class="title">Signup</span>
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
                <form action="search.php" method="$_GET">
                <label>
                    <input type="text" name="search" placeholder="Search here">
                    <button type="submit" name="searchbutton"><i class="fa fa-search"></i></button>
                </label>
                </form>
            </div>
            <div class="date-display">
                <span class="badge bg-primary">
                    <i class="far fa-calendar-alt me-1"></i>
                    <span id="currentDateTime"></span>
                </span>
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
                    <div class="numbers">2</div>
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
                    <div class="card">
                            <div class="cardName">
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
            </div>  
        </div>
    </div>
</div>

    <footer>
        <!-- Add footer content here -->
    </footer>

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
