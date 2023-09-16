<!DOCTYPE html>
<html>
<head>
    <title>Student Residence Application</title>
</head>
<body>
    <h1>Student Residence Application</h1>
    <form method="POST" action="process_application.php">
        <input type="text" name="full_name" placeholder="Full Name" required>
        <input type="text" name="student_id" placeholder="Student ID" required>
        <select name="residence">
            <option value="residence_a">Residence A</option>
            <option value="residence_b">Residence B</option>
        </select>
        <input type="submit" name="apply" value="Apply">
    </form>
</body>
</html>
