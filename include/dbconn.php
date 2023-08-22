<?php
// index.php
require_once("include/functions.php"); // Include the file containing the config() function

$dbHost = config('config', 'db_host');
$dbUsername = config('config', 'db_user');
$dbPassword = config('config', 'db_pass');
$dbName = config('config', 'db_name');
$dbPort = config('config', 'db_port');
$dbPort = (int)$dbPort;
// Use the retrieved values as needed
$ConnStrx = mysqli_connect($dbHost, $dbUsername, $dbPassword,$dbName,$dbPort);

if(!$ConnStrx)
{
    die("error: ".mysqli_connect_error($ConnStrx));
}

?>