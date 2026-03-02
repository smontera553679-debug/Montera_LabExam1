<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_num = $_POST['id_number'];
    // String function usage: Capitalize each word in the name
    $name   = ucwords(strtolower($_POST['name'])); 
    $email  = $_POST['email'];
    $course = strtoupper($_POST['course']);

    $studentObj = new Student($conn);
    
    if ($studentObj->save($id_num, $name, $email, $course)) {
        header("Location: home.php");
        exit();
    } else {
        echo "Error saving record.";
    }
}
?>