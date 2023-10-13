<?php
// Include the database configuration
include 'config.php';

// Define variables to store user input
$name = $surname = $email = $password = $confirm_password = '';
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user inputs
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate inputs
    if (empty($name)) {
        array_push($errors, "Name is required");
    }
    if (empty($surname)) {
        array_push($errors, "Surname is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if ($password != $confirm_password) {
        array_push($errors, "The two passwords do not match");
    }

    // If there are no errors, save user data to the database
    if (count($errors) == 0) {
        // Hash the password before storing in the database
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and execute the SQL query to insert user data
        $sql = "INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $surname, $email, $password_hash);
        $stmt->execute();

        // Redirect to the login page after successful registration
        header('location: login.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPU Residence System - Registration</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file if needed -->
</head>
<body>
    <nav>
        <!-- Your navigation menu here -->
    </nav>

    <div class="main">
        <form action="register.php" method="POST">
            <div class="container">
                <h2>Student Registration</h2>
                <?php include('errors.php'); ?>
                <input type="text" name="name" placeholder="Name" value="<?php echo $name; ?>" required>
                <input type="text" name="surname" placeholder="Surname" value="<?php echo $surname; ?>" required>
                <input type="text" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <input type="submit" name="register" value="Register">
            </div>
        </form>
    </div>

    <!-- The rest of your content -->

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Sol Plaatjie University</p>
    </footer>
</body>
</html>
