<?php
// Check if the user is logged in as an admin (implement proper authentication)
session_start();
if (!isset($_SESSION["admin_username"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome, Admin!</h1>
    <p><a href="manage_students.php">Manage Students</a></p>
    <p><a href="manage_residences.php">Manage Residences</a></p>
    <!-- Add more admin dashboard features and links as needed -->
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
