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
    <style>
        /* Add your CSS styles here to enhance the appearance of the dashboard */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
        }
        h1 {
            color: #007bff;
        }
        p {
            font-size: 18px;
            margin: 10px;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
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
