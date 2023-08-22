<?php

    require_once("include/dbconn.php");

    if(isset($_POST['submit']))
    {
        $UserID = $_GET['ID'];
        $FullName = $_POST['fullname'];
        $UserName = $_POST['username'];
        $EmailAddress = $_POST['emailaddress'];
        $PhoneNumber = $_POST['phonenumber'];
    
        $querry = "UPDATE users SET fullname = '".$FullName."' , username='".$UserName."', emailaddress='".$EmailAddress."', phonenumber ='".$PhoneNumber."'  WHERE usrID = '".$UserID."'" ;

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