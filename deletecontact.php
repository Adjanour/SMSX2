<?php

    require_once("include/dbconn.php");

    if(isset($_GET['Del']))
    {
        $CtcId = $_GET['Del'];


        $querry = "DELETE FROM contacts  WHERE ctcId = '".$CtcId."'";
        $result = mysqli_query($ConnStrx,$querry);

        if ($result)
        {
            echo '<script>alert("Deleted Succesfully");';
        echo 'window.location.href = "contacts.php";</script>';

        }
        else
        {
            echo "Please Check your Query";
        }

    }
    else
    {
        echo '<script>alert("Contact not Sent!");';
        echo 'window.location.href = "contacts.php";</script>';
    }

?>