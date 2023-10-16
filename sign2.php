<?php
// Establish database connection
$hostname = "localhost";
$username = "root";
$password = "";
$database = "student_residences";
try {
    $db = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    // Set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $phoneNumber = $_POST["phoneNumber"];
    $emailAddress = $_POST["Email_Address"];
    $identityNumber = $_POST["Identity_Number"];
    $studentNumber = $_POST["Student_Number"];
    $Address = $_POST["Home_Address"];
    $gender = $_POST["gender"];
    $Residence_Name = $_POST["Residence_Name"];

    // Validate and store the data in the database
    if (!empty($studentNumber) && is_numeric($studentNumber)) {
        $query = "INSERT INTO student (Student_Number, firstName, lastName, Email_Address, phoneNumber,Home_Address, gender, Residence_Name) 
                  VALUES (:Student_Number, :firstName, :lastName, :Email_Address, :phoneNumber,:Home_Address, :gender , :Residence_Name)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':Student_Number', $studentNumber);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':Email_Address', $emailAddress);
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->bindParam(':Home_Address', $Address);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':Residence_Name', $Residence_Name);

        if ($stmt->execute()) {
            // Data successfully inserted into the database
            header("Location: home.php"); // Redirect to a success page
            exit();
        } else {
            echo "Error executing the statement: " . implode(" | ", $stmt->errorInfo());
        }
    } else {
        echo "Validation failed. Ensure Student Number is not empty and is numeric.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* Add your CSS styles here */
        /* Reset some default browser styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, Helvetica, sans-serif;
    background-image: url('MSSA.jpg');
    background-position: bottom;
    background-size: cover;
    background-repeat: no-repeat;
    color: white;
}

form {
    width: 200%;
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background: rgba(0, 0, 0, 0.7);
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    text-align: center;
}

form label, form select, form input[type="text"], form input[type="email"] {
    display: block;
    margin: 10px 0;
    font-size: 18px;
    color: white;
    text-align: left;
}

form input[type="text"], form input[type="email"], form select {
    width: 100%;
    padding: 10px;
    border: none;
    border-bottom: 2px solid white;
    background: transparent;
    color: white;
    font-size: 16px;
    transition: border-color 0.5s;
}

form input[type="text"]:focus, form input[type="email"]:focus, form select:focus {
    border-color: #007bff;
}

form input[type="submit"] {
    background: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 18px;
    cursor: pointer;
    border-radius: 8px;
    transition: background 0.5s;
}

form input[type="submit"]:hover {
    background: #0056b3;
}

/* Add scrollbar styles for better user experience */
::-webkit-scrollbar {
    width: 12px;
}

::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.2);
}

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: transparent;
        }

        h1 {
            padding-left: 35px;
            font-size: 40px;
            color: white;
            transition: color 1s;
        }

        h1:hover {
            color: black;
            font-weight: bold;
        }

        #login {
            height: 50px;
            width: 100px;
        }

        #register {
            height: 50px;
            width: 160px;
        }

        .login {
            height: 500px;
            width: 500px;
            color: black;
            border: 2px solid whitesmoke;
            border-radius: 8px;
            backdrop-filter: blur(20px);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: absolute;
            transform: scale(0) translateX(-800px);
            transition: 1s;
        }

        .active_login .login {
            transform: scale(1);
        }

        .Remember-Forgot {
            display: flex;
            justify-content: space-between;
            width: 80%;
            margin: 16px 0;
        }

        p {
            display: inline-block;
        }

        .main a {
            color: black;
            font-weight: bold;
        }

        .links {
            padding: 40px;
        }

        .links a, button {
            margin: 0px 20px;
            position: relative;
            font-size: 20px;
            color: white;
        }

        button {
            background: transparent;
            outline: none;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 8px;
            transition: background-color 1s;
        }

        a:hover::before {
            content: '';
            position: absolute;
            height: 8%;
            width: 100%;
            background-color: white;
            bottom: -30%;
        }

        button:hover {
            border: 2px solid whitesmoke;
            background-color: white;
            color: black;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .registration {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 450px;
            height: 600px;
            flex-direction: column;
            border: 2px solid whitesmoke;
            border-radius: 8px;
            backdrop-filter: blur(20px);
            position: absolute;
            color: black;
            top: 0;
            left: 50%;
            transform: translateX(-50%) scale(0) translateX(800px);
            transition: 1s;
        }

        .active_register .registration {
            transform: translateX(-50%) scale(1);
        }

        .main {
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        input {
            display: block;
        }

        input[type="submit"] {
            width: 300px;
            height: 40px;
            font-size: 20px;
            color: black;
            margin: 8px 0px;
            border: none;
            outline: none;
            border-radius: 8px;
        }

        input[type="password"], input[type="text"], input[type="email"], input[type="year"], input[type="number"] {
            width: 300px;
            height: 40px;
            background: transparent;
            outline: none;
            border: none;
            border-bottom: 2px solid black;
            margin: 16px;
            font-size: 17px;
            caret-color: red;
            color: whitesmoke;
        }

        input::placeholder {
            color: whitesmoke;
        }

        h2 {
            font-size: 30px;
            text-align: center;
        }

        input[type="radio"] {
            display: inline;
        }

        h3 {
            margin: 30px 0 0 0;
        }

        select {
            width: 308px;
            height: 40px;
            border: none;
            outline: none;
            background: transparent;
        }

        ::placeholder {
            color: whitesmoke;
        }

        a, a:hover {
            color: white;
            text-decoration: none;
            transition: 1s;
        }

        .links a:hover {
            position: relative;
            font-weight: bold;
            color: white;
        }

        .links a:hover::before {
            content: '';
            position: absolute;
            height: 8%;
            width: 100%;
            background-color: white;
            bottom: -30%;
        }

        button:hover::before {
            content: '';
            position: absolute;
            height: 100%;
            width: 100%;
            background-color: white;
            bottom: -100%;
        }

        input[type="submit"]:hover {
            background: whitesmoke;
            color: black;
        }

        ::-webkit-scrollbar-thumb {
            background: whitesmoke;
            border-radius: 16px;
        }

        ::-webkit-scrollbar {
            width: 14px;
        }

        ::-webkit-scrollbar-track {
            background: black;
        }

    </style>
</head>
<body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" required>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" required>

        <label for="phoneNumber">Phone Number:</label>
        <input type="text" name="phoneNumber" required pattern="\d{10}" title="Please enter exactly 10 digits">

        <label for="Email_Address">Email Address:</label>
        <input type="email" name="Email_Address" required>

        <label for="Identity_Number">Identity Number:</label>
        <input type="text" name="Identity_Number" required pattern="\d{13}" title="Please enter exactly 13 digits">


        <label for="Student_Number">Student Number:</label>
        <input type="text" name="Student_Number" required pattern="\d{9}" title="Please enter exactly 9 digits">


        <label for="Home_Address">Address:</label>
        <input type="text" name="Home_Address" required>
        
        <label for="Residence_Name">Residence:</label>
        <input type="text" list="residences" name="Residence_Name" required>
                  <datalist id="residences">
                    <option value="Moroka Hall Of Residence"></option>
                    <option value="Rathaga Hall Of Residence"></option>
                    <option value="Tauana Hall Of Residence"></option>
                    <option value="Hannetjie Hall Of Residence"></option>
                    <option value="Umnandi Hall Of Residence"></option>
                    <option value="My Student SA "></option>
                    <option value="De Beers"></option>
                    <option value="Denofusion"></option>
                  </datalist>

        <label for="gender">Gender:</label>
        <select name="gender" required>
            <option value="Female">Female</option>
            <option value="Male">Male</option>
        </select>

        <input type="submit" value="Submit Application">
    </form>
</body>
</html>
