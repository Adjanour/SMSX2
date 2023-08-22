<?php
require_once ("include/dbconn.php");

if (isset($_POST['Submit'])) {
    $name = $_POST['templateName'];
    $content = $_POST['content'];
    $query = "INSERT INTO message_templates (templateName, templateContent) VALUES ('$name', '$content')";
    $result = mysqli_query($ConnStrx, $query);
    if ($result) {
        echo '<script>alert("Template added Succefully!");';
        echo 'history.back();</script>';
    } else {
        echo '<script>alert("Template not added!");';
        echo 'window.location.href = "messagetemplate.php";</script>';
    }
}
?>
