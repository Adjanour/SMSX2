<?php

    require_once("include/dbconn.php");
    session_start();
    $UserId =  $_SESSION['user_id']; 
    if(isset($_POST['changePassword']))
    {
        $CtcID = $_GET['ID'];
        $Password = $_POST['password'];
    
        $querry = "UPDATE users SET password = '".$Password."'WHERE usrID = '".$UserId."'" ;

        $result = mysqli_query($ConnStrx,$querry);

        if ($result)
        {
            echo '<script>alert("Changes saved Succesfully!.");';
            echo 'window.location.href = "account.php";</script>';
        }
        else
        {
            echo "Please Check your Query";
        }

    }
   
?>