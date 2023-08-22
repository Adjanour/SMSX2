<?php
require_once ("include/dbconn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['fullname'];
    $phone = $_POST['phonenumber'];
    $email = $_POST['email'];
    $query = "INSERT INTO contacts (ctcname, ctcphonenumber, ctcemailaddress) VALUES ('$name', '$phone', '$email')";
    $result = mysqli_query($ConnStrx, $query);
    if ($result) {
        echo '<script>alert("Contact added Succefully!");';
        echo 'history.back();</script>';
    } else {
        echo '<script>alert("Contact not added!");';
        echo 'window.location.href = "smspage.php";</script>';
    }
}
?>
