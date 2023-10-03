<?php
// Include your database connection code here
// // Example:
// // require_once 'db_connection.php';
//
// // Check if the form has been submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Retrieve form data (sanitize and validate as needed)
//         $studentName = $_POST["student_name"];
//             $studentEmail = $_POST["student_email"];
//                 $desiredResidence = $_POST["desired_residence"];
//
//                     // Perform validation and error handling here
//
//                         // Assuming you have a database connection, insert the application into the database
//                             try {
//                                     // Establish a database connection
//                                             $pdo = new PDO("mysql:host=localhost;dbname=your_database", "your_username", "your_password");
//                                                     
//                                                             // Prepare and execute an SQL query to insert the application data
//                                                                     $query = "INSERT INTO applications (student_name, student_email, desired_residence) VALUES (?, ?, ?)";
//                                                                             $stmt = $pdo->prepare($query);
//                                                                                     $stmt->execute([$studentName, $studentEmail, $desiredResidence]);
//                                                                                             
//                                                                                                     // Close the database connection
//                                                                                                             $pdo = null;
//                                                                                                                     
//                                                                                                                             // Redirect the user to a success page or display a success message
//                                                                                                                                     header("Location: success.php");
//                                                                                                                                             exit();
//                                                                                                                                                 } catch (PDOException $e) {
//                                                                                                                                                         // Handle database connection or query errors here
//                                                                                                                                                                 echo "Error: " . $e->getMessage();
//                                                                                                                                                                     }
//                                                                                                                                                                     }
//                                                                                                                                                                     ?>
//
//                                                                                                                                                                     <!DOCTYPE html>
//                                                                                                                                                                     <html lang="en">
//                                                                                                                                                                     <head>
//                                                                                                                                                                         <meta charset="UTF-8">
//                                                                                                                                                                             <meta name="viewport" content="width=device-width, initial-scale=1.0">
//                                                                                                                                                                                 <title>Process Residence Application</title>
//                                                                                                                                                                                 </head>
//                                                                                                                                                                                 <body>
//                                                                                                                                                                                     <h1>Residence Application Processing</h1>
//                                                                                                                                                                                         <form method="POST" action="process_application.php">
//                                                                                                                                                                                                 <label for="student_name">Student Name:</label>
//                                                                                                                                                                                                         <input type="text" id="student_name" name="student_name" required><br>
//                                                                                                                                                                                                                 
//                                                                                                                                                                                                                         <label for="student_email">Student Email:</label>
//                                                                                                                                                                                                                                 <input type="email" id="student_email" name="student_email" required><br>
//                                                                                                                                                                                                                                         
//                                                                                                                                                                                                                                                 <label for="desired_residence">Desired Residence:</label>
//                                                                                                                                                                                                                                                         <select id="desired_residence" name="desired_residence" required>
//                                                                                                                                                                                                                                                                     <option value="Residence A">Residence A</option>
//                                                                                                                                                                                                                                                                                 <option value="Residence B">Residence B</option>
//                                                                                                                                                                                                                                                                                             <!-- Add more options as needed -->
//                                                                                                                                                                                                                                                                                                     </select><br>
//                                                                                                                                                                                                                                                                                                             
//                                                                                                                                                                                                                                                                                                                     <input type="submit" value="Submit Application">
//                                                                                                                                                                                                                                                                                                                         </form>
//                                                                                                                                                                                                                                                                                                                         </body>
//                                                                                                                                                                                                                                                                                                                         </html>
//
