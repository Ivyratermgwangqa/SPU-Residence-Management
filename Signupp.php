<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && is_numeric($user_name))
		{

			//save to database
			$user_id = random_num(5);
			$query = "insert into user (user_id,user_name,password) values ('$user_id','$user_name','$password')";

			mysqli_query($con, $query);

			header("Location: sign2.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
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
            background-image: url('Moroka5.jpg');
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
   

    <label for="Student_Number">Student Number:</label>
    <input id="text" type="text" name="user_name" placeholder="Enter your student number" required><br><br>

    <label for="password">Password:</label>
    <input id="text" type="password" name="password" placeholder="Enter your password" required><br><br>

    <input id="button" type="submit" value="Signup"><br><br>

    <a href="login.php">Click to Login</a><br><br>
</form>

	</div>
</body>
</html>
