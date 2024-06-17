<?php
// index.php
global  $ConnStrx;
require_once("include/functions.php"); // Include the file containing the config() function

$dbHost = config('config', 'db_host');
$dbUsername = config('config', 'db_user');
$dbPassword = config('config', 'db_pass');
$dbName = config('config', 'db_name');
$dbPort = config('config', 'db_port');
$dbPort = (int)$dbPort;
$socket="";
// Use the retrieved values as needed
$ConnStrx = mysqli_connect("localhost", "root", "TonePave66$","crud",$dbPort,$socket);

if(!$ConnStrx)
{
    die("error: ".mysqli_connect_error($ConnStrx));
}

//$host="35.205.98.177";
//$port=3306;
//$socket="";
//$user="root";
//$password="TonePave66$";
//$dbname="crud";
//
//$ConnStrx = new mysqli($host, $user, $password, $dbname, $port, $socket)
//or die ('Could not connect to the database server' . mysqli_connect_error());

//$con->close();
