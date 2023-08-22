<?php
require_once("include/dbconn.php");
require_once("include/functions.php");
session_start();

// // Check if user is logged in and is an admin
// if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== 1) {
//     header("Location: logon.php");
//     exit();
// }
$query = "SELECT * FROM messages ORDER BY id DESC"; // Adjust the query as needed
$result = mysqli_query($ConnStrx, $query);
$querry2 = "SELECT month, count, MonthName FROM message_counts join Months on message_counts.month = Months.MonthNumber ORDER BY month ASC";
$result2=mysqli_query($ConnStrx,$querry2);
$sentMessages = []; // Initialize an array to hold the sent messages

while ($row = mysqli_fetch_assoc($result)) {
    $sentMessages[] = $row;
}
while ($row = mysqli_fetch_assoc($result2)) {
    $sentMessage[] = $row;
}
$chartData = [];
$chartLabels = [];
foreach ($sentMessage as $messages) {
    $chartLabels[] = $messages['MonthName']; // Assuming you have a 'date' column
    $chartData[] = $messages['count']; // Assuming you have a 'count' column
}

$endPoint = "https://apps.mnotify.net/smsapi/balance";
  $apiKey = config('config', 'mnotify_sms_api_key');

  $queryParameters = array(
      "key" => $apiKey,
  );
  
  $queryString = http_build_query($queryParameters);
  
  $url = "$endPoint?$queryString";
  
  // Initialize cURL session
  $curl = curl_init($url);
  
  // Set cURL options
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  
  // Execute cURL request and get the response
  $response = curl_exec($curl);
  $result = json_decode($response);
  $balance = $result->sms_balance;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <style>
        .cardBox{
    padding: 10px;
    display:flex;
    justify-content: center;
    align-items: center;
    transition: 0.5s;
}
.cardBox .card{
    position: relative;
    padding: 30px;
    width: 150px;
    box-shadow: 0 7px 25px rgba(0,0,0,0.08);
    border-radius: 20px;
    display: flex;
    justify-content: space-between;
    cursor: pointer;
    transition: 0.5s;
    margin: 10px;
}
.cardBox .card .numbers{
    position: relative;
    font-weight: 500;
    font-size: 2em;
}
.cardBox .card .cardName{
    font-size: 1.1em;
    margin-top: 5px;
}

.cardBox .card .iconBx{
    font-size: 1.8em;

}
.cardBox .card:hover{
    background: black;
    transition: 0.5s;
}
.cardBox .card:hover .numbers,
.cardBox .card:hover .cardName,
.cardBox .card:hover .iconBx{
    color: white;
    transition: 0.5s;
}
.cardHeader{
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}
.cardHeader h2{
    font-weight: 600;
}
    </style>
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
                        <a class="nav-link" href="index.html">Home Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view.php">Users</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
      <div>
        <div class="container">
            <div class="" style="display:grid; grid-template-columns: repeat(2,1fr);">
                <div class="col-sm-12">
                    <h1 class="mt-5">Dashboard</h1>
                    <p class="lead">Welcome to the dashboard Admin!</p>
                    <p>Here you can view the sent messages and view your message history</p>
                </div>
                <div class="cardBox col-sm-12">
                    <div class="card">
                        <div>
                            <div class="numbers"><?php echo $balance; ?></div>
                            <div class="cardName">Balance</div>
                        </div>
                        <div class="iconBx">
                            <i class="fa fa-eye"></i>
                        </div>
                    </div>
                </div>
            </div>
      </div>
      <div>
     
      <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    Message History
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="myChart" width="100%" height="100%"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const chart = new Chart(document.getElementById("myChart"), {
    type: "line",
    data: {
        labels: <?= json_encode($chartLabels) ?>, // Encode PHP array as JSON
        datasets: [{
                    label: "SMS Messages Sent",
                    data: <?= json_encode($chartData) ?>, // Encode PHP array as JSON
                    fill: false,
                    lineTension: 0.1,
        }]
    },
    options: {
        maintainAspectRatio: false,
        scales: {
            x: {
                title: {
                    display: true,
                    text: "Month",
                },
                ticks: {
                    autoSkip: true,
                    maxRotation: 0,
                    padding: 10,
                },
            },
            y: {
                title: {
                    display: true,
                    text: "Number of Messages",
                },
                beginAtZero: true,
            },
        },
    },
});
</script>
<div class="container">
    <h1 class="mt-5">Sent Messages</h1>
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Message</th>
                <th>Action</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sentMessages as $message): ?>
                <tr>
                    <td><?= $message['id'] ?></td>
                    <td><?= $message['sender'] ?></td>
                    <td><?= $message['reciever'] ?></td>
                    <td><?= $message['body'] ?></td>
                    <td><a class="btn btn-danger" href="deleteMessage.php?Del=<?php echo $message['id']?>">Delete</a></td>
                    <!-- Add more columns as needed -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>
<script type="text/javascript" src="js/bootstrap.js"></script>

</body>
</html>
