<?php
// Check if the user is logged in as an admin (implement proper authentication)
session_start();
if (!isset($_SESSION["admin_username"])) {
    header("Location: login.php");
    exit();
}

// Database connection code here

// Fetch and display a list of students (you can add edit and delete options)
$sql = "SELECT id, name, email FROM students";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Students</title>
</head>
<body>
    <h1>Manage Students</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo $row["email"]; ?></td>
                <!-- Add edit and delete links/buttons as needed -->
            </tr>
        <?php endwhile; ?>
    </table>
    <p><a href="admin_dashboard.php">Back to Dashboard</a></p>
</body>
</html>
