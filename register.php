<?php
// Include database connection code here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the registration form
    $username = $_POST["username"];
    $password = $_POST["password"];
    // Add more fields as needed (e.g., name, email, etc.)

    // Hash the password for security (use a stronger hashing method in production)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        // Registration successful
        echo "Registration successful. You can now <a href='login.php'>log in</a>.";
    } else {
        // Registration failed
        echo "Registration failed. Please try again later.";
    }

    $stmt->close();
}

// Close the database connection when done
$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h1>User Registration</h1>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <!-- Add more fields as needed (e.g., name, email, etc.) -->
        <input type="submit" name="register" value="Register">
    </form>
</body>
</html>
