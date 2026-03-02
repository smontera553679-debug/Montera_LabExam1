<?php 
include 'db.php'; 
$studentObj = new Student($conn);

if (isset($_GET['delete_id'])) {
    $id_to_delete = $_GET['delete_id'];
    $delete_query = "DELETE FROM students WHERE id = $id_to_delete";
    if ($conn->query($delete_query)) {
        header("Location: home.php"); 
        exit();
    }
}

if (isset($_POST['update_student'])) {
    $id = $_POST['id'];
    $id_num = $_POST['id_number'];
    $name = ucwords(strtolower($_POST['name'])); 
    $email = $_POST['email'];
    $course = strtoupper($_POST['course']);

    $stmt = $conn->prepare("UPDATE students SET id_number=?, name=?, email=?, course=? WHERE id=?");
    $stmt->bind_param("ssssi", $id_num, $name, $email, $course, $id);
    
    if ($stmt->execute()) {
        header("Location: home.php");
        exit();
    }
}

$edit_row = null;
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $result = $conn->query("SELECT * FROM students WHERE id = $id");
    $edit_row = $result->fetch_assoc();
}

$records = $studentObj->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Records</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .dropdown { position: absolute; right: 15px; top: 15px; display: inline-block; }
        .dropbtn { background: none; border: none; font-size: 22px; cursor: pointer; color: #333; padding: 5px; }
        .dropdown-content { display: none; position: absolute; right: 0; background-color: #fff; min-width: 140px; box-shadow: 0px 4px 12px rgba(0,0,0,0.15); z-index: 1; border: 1px solid #ddd; border-radius: 4px; }
        .dropdown-content a { color: #333; padding: 12px 16px; text-decoration: none; display: block; font-size: 14px; }
        .dropdown-content a:hover { background-color: #f8f9fa; }
        .dropdown:hover .dropdown-content { display: block; }
        .card { position: relative; border: 1px solid #ddd; padding: 20px; margin-bottom: 10px; border-radius: 8px; }
        .edit-container { background: #fefefe; padding: 20px; border: 2px solid #333; border-radius: 8px; }
        input { width: 100%; padding: 10px; margin: 10px 0; display: block; }
    </style>
</head>
<body>

    <?php if ($edit_row): ?>
        <div class="edit-container">
            <h1>Edit Student Record</h1>
            <form action="home.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $edit_row['id']; ?>">
                
                <label>ID Number</label>
                <input type="text" name="id_number" value="<?php echo $edit_row['id_number']; ?>" required>
                
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $edit_row['name']; ?>" required>
                
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $edit_row['email']; ?>" required>
                
                <label>Course</label>
                <input type="text" name="course" value="<?php echo $edit_row['course']; ?>" required>
                
                <button type="submit" name="update_student" class="add-btn">Save Changes 💾</button>
                <a href="home.php" style="display:block; text-align:center;">Cancel</a>
            </form>
        </div>

    <?php else: ?>
        <h1>Student Records</h1>
        <a href="create_student.php" class="add-btn">Add Student +</a>

        <?php if ($records->num_rows > 0): ?>
            <?php while($row = $records->fetch_assoc()): ?>
                <div class="card">
                    <strong><?php echo htmlspecialchars($row['name']); ?></strong>
                    
                    <div class="dropdown">
                        <button class="dropbtn">... ▾</button>
                        <div class="dropdown-content">
                            <a href="home.php?edit_id=<?php echo $row['id']; ?>">📝 Edit</a>
                            <a href="home.php?delete_id=<?php echo $row['id']; ?>" 
                               onclick="return confirm('Delete this record?')">🗑️ Delete</a>
                        </div>
                    </div>

                    <p>
                        <?php echo htmlspecialchars($row['email']); ?><br>
                        <?php echo htmlspecialchars($row['id_number']); ?><br>
                        <?php echo strtoupper(htmlspecialchars($row['course'])); ?>
                    </p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align: center; color: #999;">No student records found.</p>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>