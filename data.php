<?php
require_once "include/functions.php";
session_start();
 // To Read Data from CSV file
$array = readData($_SESSION['FilePath'].$_SESSION['File']);
$arrayDetails1 = retrieveDetails($array,0);
$arrayDetails2 = retrieveDetails($array,1);

?>