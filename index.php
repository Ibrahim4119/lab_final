<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Add Student
if (isset($_POST['add'])) {
    $student_id = $_POST['student_id'];
    $student_name = $_POST['student_name'];
    $stmt = $conn->prepare("INSERT INTO students (student_id, student_name) VALUES (?, ?)");
    $stmt->bind_param("ss", $student_id, $student_name);
    $stmt->execute();
}

// Delete Student
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id=$id");
}

// Fetch students
$result = $conn->query("SELECT * FROM students");
?>

<a href="logout.php">Sign out</a>

<form method="POST">
    Student ID: <input type="text" name="student_id" required>
    Student Name: <input type="text" name="student_name" required>
    <button type="submit" name="add">Add Student</button>
</form>

<table border="1">
    <tr><th>Student id</th><th>Student Name</th><th>Action</th></tr>
    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['student_id'] ?></td>
            <td><?= $row['student_name'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                <a href="index.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this record?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>