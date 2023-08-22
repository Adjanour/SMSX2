<?php   
require_once("include/dbconn.php");

if (isset($_POST['submit']))
{
    if (empty($_POST['fullname']) || empty($_POST['username']) || empty( $_POST['emailaddress']) || empty($_POST['password'])) 
    {
        echo"Please fill in the blank fields";
    }
    else
    {
        $fullName = $_POST['fullname'];
        $userName = $_POST['username'];
        $emailAddress = $_POST['emailaddress'];
        $password =$_POST['password'];
    }
    

    $querry = "INSERT INTO users (fullname,username,emailaddress,password) VALUES ('$fullName' , '$userName', '$emailAddress', '$password')" ; 
    $result = mysqli_query($ConnStrx,$querry);
    
    if ($result)
    {
        header("location:logon.php");
        
    }
    else 
    {
        echo "There is an error in your QUERY statment. Please check and try again";
    }
}

else 
{
    header("location:index.html");
}

?>