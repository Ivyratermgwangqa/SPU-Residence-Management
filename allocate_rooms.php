<?php
// Check if the user is logged in as an admin (implement proper authentication)
session_start();
if (!isset($_SESSION["admin_username"])) {
    header("Location: login.php");
    exit();
}

// Process room allocation (similar to manage_residences.php)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and validate form data
    $studentId = $_POST["student_id"];
    $roomId = $_POST["room_id"];
    // Add more fields and validation as needed

    // Update the room allocation in the database
    // ...
    // Redirect to a confirmation page or back to the admin dashboard
    header("Location: admin_dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Allocate Rooms</title>
</head>
<body>
    <h1>Allocate Rooms</h1>
    <form method="POST" action="">
        <label for="student_id">Student ID:</label>
        <input type="text" id="student_id" name="student_id" required><br><br>
        <label for="room_id">Room ID:</label>
        <input type="text" id="room_id" name="room_id" required><br><br>
        <!-- Add more fields as needed (e.g., room type) -->
        <input type="submit" name="allocate" value="Allocate">
    </form>
    <p><a href="admin_dashboard.php">Back to Admin Dashboard</a></p>
</body>
</html>
