<?php
session_start();

echo '<script>
        var result = confirm("Are you sure you want to log out?");
        if (result) {
            window.location.href = "logon.php"; // Redirect to logout page
        } else {
            history.back(); // Go back to the previous page
        }
    </script>';
    exit();

session_unset();
session_destroy();
echo '<script>alert("Logged out Successfully!");';
echo 'window.location.href = "logon.php";</script>';
exit();
?>
