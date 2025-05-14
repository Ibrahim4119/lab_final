<?php
include 'db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $student_name = $_POST['student_name'];
    $stmt = $conn->prepare("UPDATE students SET student_id=?, student_name=? WHERE id=?");
    $stmt->bind_param("ssi", $student_id, $student_name, $id);
    $stmt->execute();
    header("Location: index.php");
}

$result = $conn->query("SELECT * FROM students WHERE id=$id");
$row = $result->fetch_assoc();
?>

<form method="POST">
    Student ID: <input type="text" name="student_id" value="<?= $row['student_id'] ?>" required><br>
    Student Name: <input type="text" name="student_name" value="<?= $row['student_name'] ?>" required><br>
    <button type="submit">Update</button>
</form>