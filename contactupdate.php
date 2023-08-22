<?php

    require_once("include/dbconn.php");

    if(isset($_POST['Update']))
    {
        $CtcID = $_GET['ID'];
        $FullName = $_POST['name'];
        $EmailAddress = $_POST['emailaddress'];
        $PhoneNumber = $_POST['phonenumber'];
    
        $querry = "UPDATE contacts SET ctcname = '".$FullName."', ctcemailaddress='".$EmailAddress."', ctcphonenumber ='".$PhoneNumber."'  WHERE ctcId = '".$CtcID."'" ;

        $result = mysqli_query($ConnStrx,$querry);

        if ($result)
        {
            echo '<script>alert("Changes saved Succesfully!.");';
            echo 'window.location.href = "contacts.php";</script>';
        }
        else
        {
            echo "Please Check your Query";
        }

    }
   
?>