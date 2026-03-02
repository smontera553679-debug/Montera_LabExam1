<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "student_db";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

class Student {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM students ORDER BY id DESC");
    }

    public function save($id_num, $name, $email, $course) {
        $stmt = $this->db->prepare("INSERT INTO students (id_number, name, email, course) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $id_num, $name, $email, $course);
        return $stmt->execute();
    }
}
?>