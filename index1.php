<?php
require_once("include/dbconn.php");

$query = "SELECT ctcId, ctcphonenumber FROM contacts";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/main.js"></script>
        <style>
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }
        .center-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-image: linear-gradient(to right, #00FFFF, #00BFFF); /* Blue linear gradient */
        }
        .sub-container {
            background-color: #f8f9fa; /* Light gray background */
            border: 1px solid #ced4da; /* Gray border */
            padding: 10px;
            max-width: fit-content;
            border-radius: 25px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);/* Add a shadow on hover */
    }
    .toolbar {
            /* Add border and padding to the navbar */
            border: 1px solid #ced4da; /* Gray border */
            padding: 5px;
            border-radius: 25px;
            margin-bottom: 20px; /* Create some space between the toolbar and content */
        }

    .sub-container:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        transform: scale(1.01);
        transition-delay: 0.1s;
    }
    .btn-gradient {
        background: linear-gradient(to right, #FF0000, #DE0000);
            border: none;
            color: white; 
            transition: background 0.3s;
            border-radius: 20px;
        }
    .btn 
    {
        border-radius: 20px;
        margin: 5px;
    }

    .btn-gradient:hover {
            background: linear-gradient(to right, #008000, #00FF00);
        }
        .dialog {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    border-radius: 25px;
}

.dialog-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 400px;
    position: relative;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    cursor: pointer;
}
#contactDialog
{
 border-radius: 25px;
}
.date-display {
    display: flex;
    justify-content: flex-end;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    background-color: #f8f9fa;
    color: #0d6efd;
}
.search{
    position: relative;
    width: 400px;
    margin: 0 10px;
    
   
}
.search label{
    position: relative;
    width: 100%;
}
.search label input{
    width: 100%;
    height: 40px;
    border-radius: 40px;
    padding: 5px 20px;
    padding-left: 35px;
    font-size: 18px;
    outline: none;
    border: 1px solid var(--black2);
    background: var(--blue);
    border: none;
}
.search label input::placeholder{
    color: var(--white);
    text-align: center;
}
.search label i{
    position: absolute;
    top: 0;
    left: 10px;
    font-size: 1.2em;
}
.user{
    position: relative;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    cursor: pointer;
}
.user img{
    position: absolute;
    top: 0;
    left: 0;
    width: 100px;
    height: 100%;
    object-fit: cover;
}
.main{
    position: absolute;
    width: calc(100% - 300px);
    left: 300px;
    min-height: 100vh;
    background: var--(white);
    transition: 0.5s;
}
.main.active{
    width: calc(100% - 80px);
    left: 80px;
}
.topbar{
    width: 100%;
    height: 60px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 10px;
}
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
        <div class="container">
            <a class="navbar-brand" href="about.php">
                <img src="./include/favicon_io/favicon-16x16.png" width="30" height="30" class="d-inline-block align-top" alt="Logo">
                Salem Server
            </a>
            <!-- ... Rest of the navigation code ... -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end"  id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="logon.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index1.php">Send SMS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Log out </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
                <!--userimg-->
                <div class="user">
                        <img src="img/g.jpg" alt="img" width="">
                </div>
            </div>
        </div>
    </div>        
    <div class="d-flex flex-column">
        <!-- ... Rest of the sidebar code ... -->
            <div class="center-container">
                <div class="sub-container">
                    <div class="date-display">
                        <span class="badge bg-primary">
                            <i class="far fa-calendar-alt me-1"></i>
                            <span id="currentDateTime"></span>
                        </span>
                    </div>
                     <!-- Toolbar (Navbar) -->
                    <nav class="navbar  navbar-expand navbar-dark bg-dark toolbar">
                        <div class="container-fluid">
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toolbarNav" aria-controls="toolbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="toolbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                    <a href="#phone_number" class="btn btn-primary">Enter Number</a>
                                    </li>
                                    <li class="nav-item">
                                    <button class="btn btn-primary"  id="openDialog">Add Contact</button>
                            <div id="contactDialog" class="dialog">
                                <div class="dialog-content">
                                    <span class="close-btn" id="closeDialog">&times;</span>
                                    <?php include 'addContactForm.php'; ?>
                                </div>
                            </div>
                                    </li>
                                    <li class="nav-item">
                                <button class=" btn btn-primary dropdown-toggle " type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Message Template
                                </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Item 1</a>
                                <a class="dropdown-item" href="#">Item 2</a>
                                <a class="dropdown-item" href="#">Item 3</a>
                            </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    
                    <div class="mb-3">
                        <form action="sms.php" method="post">
                            <div class="mb-3">
                                <!-- ... Rest of the form fields ... -->
                                <div class="col">
                                        
                                            <select class="form-select" name="phone_number_selected" id="SelectedNumber">
                                            <option value="">Select a number</option>
                                            <?php
                                            while($row = mysqli_fetch_assoc($result))
                                            {
                                                $phoneNumber = $row['ctcphonenumber'];
                                                $ctcId = $row['ctcId'];
                                            ?>
                                            <option value="<?php echo $phoneNumber ?>"><?php echo $phoneNumber ?></option>
                                                <?php
                                            }
                                            ?>
                                            </select><br> 
                                        <div class="row mb-3">
                                                <div class="col" style="display:flex;justify-content:flex-end;">
                                                    <input type="text" style="margin-right: 5px;" id="phone_number" class="form-control" name="phone_number" placeholder="Type a phone number in international format. For example: +23354159968">
                                                    <select class="form-select" style="width:100px;" name="" id="country_code" placeholder="Countrycode" value="Country codes">
                                                        <option>Code</option>
                                                        <option value="">+233</option>
                                                        <option value="">+234</option>
                                                        <option value="">+1</option>
                                                    </select>
                                                </div>
                                        </div>
            
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <textarea class="form-control" name="message" id="" cols="50" rows="10" placeholder="Enter your message here"></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <select class="form-select" name="sender" id="">
                                            <option selected disabled>Select Sender</option>
                                            <option value="SalemInc">SalemInc</option>
                                            <option value="Salem Inc.">Salem Inc.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <select class="form-select" name="api" id="">
                                            <option selected disabled>Select API</option>
                                            <option value="Hubtel">Hubtel</option>
                                            <option value="Mnotify">Mnotify</option>
                                        </select><br>
                                    </div>
                                    <div class="mb-3">
                                        <div class="col">
                                        <label for="scheduledTime" id="time-label" class="form-label">Scheduled Date and Time:</label>
                                          <input class="form-control" type="datetime-local" id="scheduledTime" name="schedule">
                                        </div>
                                        <div class="col mt-3 d-flex justify-content-end">
                                                <input class="btn btn-primary me-2 btn-gradient" type="submit" value="Schedule" name="schedule">
                                                <input class="btn btn-primary btn-gradient" type="submit" value="Send" name="Send">
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
</body>
</html>
