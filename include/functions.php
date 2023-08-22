<?php

function config($configFilename, $key)
{
    $path = sprintf("../%s.php", $configFilename);
    if (file_exists($path)) {
        $config = include sprintf("../%s.php", $configFilename);
        if (isset($config[$key])) {
            return $config[$key];
        }
    }
}

function validate($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
function checkLogin($UserName, $Password , $ConnStrx)
{
    // Use prepared statement to protect against SQL injection
    $query = "SELECT usrID,username,fullname,emailaddress,password,isAdmin,isActive, COUNT(*) as Result FROM users WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($ConnStrx, $query);
    mysqli_stmt_bind_param($stmt, "ss", $UserName, $Password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt,$user_id,$fullname, $username, $email, $password, $isAdmin,$isActive,$count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    if ($count > 0) {
        $user_info = array(
            'authenticated' => true,
            'user_id' => $user_id,
            'username' => $username,
            'fullname' => $fullname,
            'email' => $email,
            'password' => $password,
            'isAdmin' => $isAdmin,
            'isActive' => $isActive
        );
        return $user_info;
    } else {
        return array('authenticated' => false);
    }
}

function readData ($filePath){
    $file = fopen($filePath, 'r');
    $data = fgetcsv($file, 1000, ",");
    while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
        $array[] = $data;
     }
     fclose($file);
     return $array;
}

function displayData()
{

}


function retrieveDetails($array,$keys)
{
    $array2 = array(); 
    foreach($array as $key => $value){
        $array2[] =  $value[$keys] ;
    }
    return $array2;
}
?>
