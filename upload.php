<?php

session_start();
require_once("include/functions.php");

if (isset($_POST['Upload']))
{
    $targetDirectory = "upload/";
    $targetFile = $targetDirectory.basename($_FILES['File']['name']);
    $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $File = $_FILES['File'];
    $FileName = $_FILES['File']['name'];
    $FileTmpName = $_FILES['File']['tmp_name'];
    $FileSize = $_FILES['File']['size'];
    $FileError = $_FILES['File']['error'];


    if (file_exists($targetFile)) {
        echo '<script>alert("File already exists!");</script>';
        $uploadOk = 0;
    }

    if ($FileSize > 500000) {
        echo '<script>alert("File is too large");';
        echo 'history.back();</script>';
        $uploadOk = 0;
    }
    
    if ($fileType != "csv") {
        echo '<script>alert("Only CSV files are allowed");';
        echo 'history.back();</script>';
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo '<script>alert("Sorry, your file was not uploaded.");';
        echo 'history.back();</script>';
    } else {
        if (move_uploaded_file($FileTmpName, $targetFile)){
            $_SESSION['File'] = $FileName;
            $_SESSION['FilePath'] = $targetDirectory;
            $array = readData($targetDirectory.$FileName);
            $arrayDetails1 = retrieveDetails($array,0);
            $arrayDetails2 = retrieveDetails($array,1);
            $arrayAsString = implode(",",$arrayDetails2);
            $_SESSION['data'] = $arrayAsString;
            echo '<script>alert("The file  has been uploaded successfully.");';
            echo 'window.location.href = "bulksmspage.php";</script>';
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

?>