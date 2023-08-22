<?php

    require_once("include/dbconn.php");

    if(isset($_GET['Del']))
    {
        $msgID = $_GET['Del'];

        $querry = "DELETE FROM messages WHERE ID = '".$msgID."'";
        $result = mysqli_query($ConnStrx,$querry);

        if ($result)
        {
            header("location:dashboard.php");

        }
        else
        {
            echo "Please Check your Query";
        }

    }
    else
    {
        header("location :dashboard.php");
    }

?>