<!DOCTYPE html>
<html>
<head>
    <title>Create Student Record</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="form-page">

    <div class="form-container">
        <h2>Add New Student</h2>

        <form action="store_student_handling.php" method="POST">

            <div class="form-group">
                <label>ID Number</label>
                <input type="text" name="id_number" required>
            </div>

            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Course</label>
                <input type="text" name="course" required>
            </div>

            <button type="submit" class="primary-btn">Add Student ➜</button>
            <a href="home.php" class="cancel-link">Cancel</a>

        </form>
    </div>

</body>
</html>