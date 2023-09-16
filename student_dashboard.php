<?php
// Check if the user is logged in as a student (implement proper authentication)
session_start();
if (!isset($_SESSION["student_username"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
</head>
<body>
    <h1>Welcome, Student!</h1>
    <p><a href="apply_for_residence.php">Apply for Residence</a></p>
    <p><a href="check_application_status.php">Check Application Status</a></p>
    <p><a href="view_room_allocation.php">View Room Allocation</a></p>
    <!-- Add more student dashboard features and links as needed -->
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
