<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<form method="POST">
    <h2>Register</h2>
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
</form>