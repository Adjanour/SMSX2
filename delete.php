<?php

    require_once("include/dbconn.php");

    if(isset($_GET['Del']))
    {
        $UserID = $_GET['Del'];


        $querry = "DELETE FROM users WHERE usrID = '".$UserID."'";
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
    else
    {
        header("location :view.php");
    }

?>