<?php

session_start();

include("connection.php");
include("functions.php");

// Authentication function should return a user identifier if authentication is successful
function authenticateUser($user_name, $password) {
    // In this example, we use hard-coded credentials for simplicity
    $validUsername = "user_name";
    $validPassword = "password";
    $validUserId = 1; // Replace with the actual user ID

    if ($user_name === $validUsername && $password === $validPassword) {
        return $validUserId; // Authentication successful, return the user ID
    }
    return false; // Authentication failed
}

// Step 1: Authentication - Create a login system
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_name"]) && isset($_POST["password"])) {
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];

    // Authenticate the user - you may have your own authentication logic
    $user_id = authenticateUser($user_name, $password);
    if ($user_id) {
        // If authentication is successful, you can set a session variable or redirect
        $_SESSION['user_id'] = $user_id;
        header("Location: home.php"); // Redirect to the home page
        exit();
    } else {
        echo "Authentication failed. Please check your credentials.";
    }
}

// Step 2: Retrieving and displaying the entire "student" relation
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Connect to your database
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "student_residences";
    try {
        $db = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }

    // Query the database to fetch the entire "student" relation
    $query = "SELECT * FROM student";
    $stmt = $db->query($query);
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the student information
    if (!empty($students)) {
        echo "<h1>Student Relation</h1>";
        echo "<table>";
        echo "<tr><th>Student Number</th><th>First Name</th><th>Last Name</th><th>Email_Address</th><th>phoneNumber</th><th>Address</th><th>Gender</th><th>Residence_Name</th></tr>";
        foreach ($students as $student) {
            echo "<tr>";
            echo "<td>" . $student["Student_Number"] . "</td>";
            echo "<td>" . $student["firstname"] . "</td>";
            echo "<td>" . $student["lastname"] . "</td>";
            echo "<td>" . $student["Email_Address"] . "</td>";
            echo "<td>" . $student["phoneNumber"] . "</td>";
            echo "<td>" . $student["Home_Address"] . "</td>";
            echo "<td>" . $student["Gender"] . "</td>";
            echo "<td>" . $student["Residence_Name"] . "</td>";

            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No students found.";
    }
}

if (isset($_SESSION['user_id']) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Student_Number"]) && isset($_POST["application_status"]) && isset($_POST["Residence_Name"])) {
    $user_id = $_SESSION['user_id'];

    // Retrieve data from the form
    $Student_Number = $_POST["Student_Number"];
    $application_status = $_POST["application_status"];
    $Residence_Name = $_POST["Residence_Name"];

    // Check if the Student_Number already exists
    $checkQuery = "SELECT * FROM application_status WHERE Student_Number = :Student_Number";
    $stmt = $db->prepare($checkQuery);
    $stmt->bindParam(":Student_Number", $Student_Number);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // If the record exists, update it
        $updateQuery = "UPDATE application_status SET application_status = :application_status AND Residence_Name = :Residence_Name WHERE Student_Number = :Student_Number";
        $stmt = $db->prepare($updateQuery);
        $stmt->bindParam(":Student_Number", $Student_Number);
        $stmt->bindParam(":application_status", $application_status);
        $stmt->bindParam(":Residence_Name", $Residence_Name);
        $stmt->execute();
        echo "Application status has been updated.";
    } else {
        // If the record doesn't exist, insert a new one
        $insertQuery = "INSERT INTO application_status (Student_Number, application_status, Residence_Name) VALUES (:Student_Number, :application_status, :Residence_Name)";
        $stmt = $db->prepare($insertQuery);
        $stmt->bindParam(":Student_Number", $Student_Number);
        $stmt->bindParam(":application_status", $application_status);
        $stmt->bindParam(":Residence_Name", $Residence_Name);

        try {
            $stmt->execute();
            echo "New application status has been stored.";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>
<!-- Your HTML login form goes here -->

<!-- Add a form for updating application status -->
<form method="POST">
    <label for="Student_Number">Student Number:</label>
    <input type="text" name="Student_Number" id="Student_Number" required>
    <br>
    <label for="application_status">Application Status:</label>
    <input type="text" name="application_status" id="application_status" required>
    <br>
    <label for="Residence_Name">Residence:</label>
        <input type="text" list="residences" name="Residence_Name" required>
                  <datalist id="residences">
                    <option value="Moroka Hall Of Residence"></option>
                    <option value="Rathaga Hall Of Residence"></option>
                    <option value="Tauana Hall Of Residence"></option>
                    <option value="Hannetjie Hall Of Residence"></option>
                    <option value="Umnandi Hall Of Residence"></option>
                  </datalist>
    <br>
    <input type="submit" value="Update Application Status">
</form>

<script>
function validateForm() {
    var studentNumber = document.getElementById("Student_Number").value;
    var Residence_Name = document.getElementById("Residence_Name").value;
    var applicationStatus = document.getElementById("application_status").value;

    if (studentNumber.trim() === "" || applicationStatus.trim() === "") {
        alert("Please fill in all fields.");
        return false;
    }

    return true;
}
</script>

<style>
        table {
            border-collapse: collapse;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #ffffff;
         }

</style>

