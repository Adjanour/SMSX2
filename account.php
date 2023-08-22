<?php
session_start();
require_once("include/dbconn.php");
$UserId =  $_SESSION['user_id']; 
$query = "SELECT * FROM users Where usrId = '".$UserId."' ";
$result = mysqli_query($ConnStrx,$query);
$row = mysqli_fetch_assoc($result);
$Username = $row['username'];
$Fullname = $row['fullname'];
$Emailaddress = $row['emailaddress'];
$Phonenumber = $row['phonenumber'];
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
    </style>
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
                <a href="bulksmspage.php">
                    <span class="icon"><i class="fa fa-envelope"></i></span>
                    <span class="title">Bulk SMS</span>
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
            <div class="">
                <div class="container mt-5">
                    <h2>Accounts Management</h2>
                    <div class="row">
                      <!-- User Profile Information -->
                      <div class="col-md-6">
                        <div class="card mb-4">
                          <div class="card-header">User Profile</div>
                          <div class="card-body">
                            <form action="updatecontact.php?ID=<?php echo $UserId ?>" method="post">
                                <div class="form-group">
                                    <label for="Username">User Name</label>
                                    <input type="text" class="form-control" id="Username" name="username" value="<?php echo $Username ?>">
                                  </div>
                              <div class="form-group">
                                <label for="fullName">Full Name</label>
                                <input type="text" class="form-control" id="fullName"  name="fullname" value="<?php echo $Fullname ?>">
                              </div>
                              <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" name="emailaddress" id="email" value="<?php echo $Emailaddress ?>">
                              </div>
                              <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" class="form-control" name="phonenumber" id="phoneNumber" value="<?php echo $Phonenumber ?>">
                              </div>
                              <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                            <div class="card mb-4">
                            <div class="card-header">Password Management</div>
                                <div class="card-body">
                                    <form action="changepassword.php?ID=<?php echo $UserId?>" method="post">
                                        <div class="form-group">
                                            <label for="newPassword">New Password</label>
                                            <input type="password" name="password" class="form-control" id="newPassword" title="Password must be at least 8 characters long and contain at least one letter and one number" required>
                                            <small class="form-text text-muted">Password must be at least 8 characters long and contain at least one letter and one number.</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmPassword">Confirm New Password</label>
                                            <input type="password" class="form-control" id="confirmPassword" required>
                                        </div>
                                        <!-- Security questions for account recovery -->
                                        <div class="form-group">
                                            <label for="securityQuestion">Security Question</label>
                                            <select class="form-control" id="securityQuestion" name="securithyQuestion">
                                            <option value="1">What is your mother's maiden name?</option>
                                            <option value="2">What is your favorite childhood pet's name?</option>
                                            <option value="3">In which city were you born?</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="securityAnswer">Answer</label>
                                            <input type="text" class="form-control" id="securityAnswer" name="securityAnswer" required>
                                        </div>
                                        <button type="submit" name="changePassword" class="btn btn-primary">Change Password</button>
                                    </form>
                                </div>
                            </div>
                       </div>
                    </div>
                                            
                    <!-- Notification Preferences -->
                    <div class="card">
                            <div class="card-header">Notification Preferences</div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="emailNotifications" checked>
                                            <label class="form-check-label" for="emailNotifications">Receive Email Notifications</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="smsNotifications">
                                            <label class="form-check-label" for="smsNotifications">Receive SMS Notifications</label>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Preferences</button>
                                    </form>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
