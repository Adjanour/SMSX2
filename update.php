<?php

    require_once("include/dbconn.php");

    if(isset($_POST['Update']))
    {
        $UserID = $_GET['ID'];
        $FullName = $_POST['Full_name'];
        $UserName = $_POST['User_name'];
        $EmailAddress = $_POST['Email_Address'];
        $password = $_POST['Password'];
        $isAdmin = $_POST['isAdmin'];
        $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;
        $isActive = isset($_POST['isActive']) ? 1 : 0;

        $querry = "UPDATE users SET fullname = '".$FullName."' , username='".$UserName."', emailaddress='".$EmailAddress."', password ='".$password."' , isAdmin='".$isAdmin."',isActive='".$isActive."' WHERE usrID = '".$UserID."'" ;

        $result = mysqli_query($ConnStrx,$querry);

        if ($result)
        {
            header("location:view.php");
        }
        else
        {
            echo "Please Check your Query";
        }

    }
?>