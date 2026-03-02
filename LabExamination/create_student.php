<!DOCTYPE html>
<html>
<head>
    <title>Create Student Record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Create Student Record</h2>
    <form action="store_student_handling.php" method="POST">
        <label>ID Number</label><br>
        <input type="text" name="id_number" required><br><br>
        
        <label>Name</label><br>
        <input type="text" name="name" required><br><br>
        
        <label>Email</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Course</label><br>
        <input type="text" name="course" required><br><br>
        
        <button type="submit">Add Student ➜</button>
        <a href="home.php">Cancel</a>
    </form>
</body>
</html>