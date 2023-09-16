<?php
// Include database connection code here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input from the login form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username exists in the database
    $sql = "SELECT username, password FROM users WHERE username = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username exists, verify the password
        $stmt->bind_result($dbUsername, $dbPassword);
        $stmt->fetch();

        if (password_verify($password, $dbPassword)) {
            // Password is correct, log in the user (you can set session variables)
            session_start();
            $_SESSION["username"] = $username;
            // Redirect to a protected page or dashboard
            header("Location: dashboard.php");
        } else {
            // Password is incorrect
            $loginError = "Invalid username or password.";
        }
    } else {
        // Username does not exist
        $loginError = "Invalid username or password.";
    }

    $stmt->close();
}

// Close the database connection when done
$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <h1>User Login</h1>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <?php if (isset($loginError)) { echo "<p>$loginError</p>"; } ?>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>

