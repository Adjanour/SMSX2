<?php
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['is_admin'] !== 1) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include CSS and other head elements -->
</head>
<body>
    <header>
        <!-- Header content, navigation, etc. -->
    </header>
    <main>
        <h1>Welcome to the Admin Dashboard</h1>
        <!-- Admin-specific content and functionalities -->
        <ul>
            <li><a href="userManagement.php">User Management</a></li>
            <li><a href="settings.php">Settings</a></li>
        </ul>
    </main>
    <footer>
        <!-- Footer content -->
    </footer>
</body>
</html>
