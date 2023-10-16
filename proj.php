<?php

session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['user_name'];
    $password = $_POST['password'];

  // Assuming you have a database connection established
  //$connection = mysqli_connect("hostname", "username", "password", "database_name");

  

  $con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

  

  $username = mysqli_real_escape_string($con, $username);
  $password = mysqli_real_escape_string($con, $password);

  $query = "SELECT * FROM user WHERE user_name = '$username' AND password = '$password'";
  $result = mysqli_query($con, $query);

  if ($result && mysqli_num_rows($result) == 1) {
    // Successful login
    $_SESSION['username'] = $username;
    header("Location: manager.php"); // Redirect to a welcome page or dashboard
    exit();
  } else {
    $error = "Invalid username or password";
  }

  mysqli_close($con);
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

	<style type="text/css">
	
    * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: url('https://greeneconomy.media/wp-content/uploads/2022/04/Sol-Plaatje-University-SPU-Kimberley_4.jpg');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        #box {
            background-color: rgba(0, 0, 0, 0.7);
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        #box h2 {
            font-size: 24px;
            margin: 10px;
            color: white;
        }

        #text {
            width: 100%;
            height: 40px;
            border: none;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        #button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        #button:hover {
            background-color: #0056b3;
        }

        #box a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            font-size: 16px;
        }

        #box a:hover {
            text-decoration: underline;
        }


	</style>

	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" name="user_name"><br><br>
            
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>
