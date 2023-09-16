<?php
// Check if the user is logged in as a student (implement proper authentication)
session_start();
if (!isset($_SESSION["student_username"])) {
    header("Location: login.php");
    exit();
}

// Process the residence application form (similar to register.php)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and validate form data
    $studentName = $_POST["student_name"];
    $preferredResidence = $_POST["preferred_residence"];
    // Add more fields and validation as needed

    // Insert the application data into the database
    // ...
    // Redirect to a confirmation page or back to the dashboard
    header("Location: student_dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Apply for Residence</title>
</head>
<body>
    <h1>Apply for Residence</h1>
    <form method="POST" action="">
        <label for="student_name">Your Name:</label>
        <input type="text" id="student_name" name="student_name" required><br><br>
        <label for="preferred_residence">Preferred Residence:</label>
        <input type="text" id="preferred_residence" name="preferred_residence" required><br><br>
        <!-- Add more fields as needed (e.g., contact details) -->
        <input type="submit" name="apply" value="Apply">
    </form>
    <p><a href="student_dashboard.php">Back to Dashboard</a></p>
</body>
</html>
