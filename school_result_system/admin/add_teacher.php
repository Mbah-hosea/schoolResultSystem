<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['add_teacher'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = md5($_POST['password']);

    mysqli_query($conn,
        "INSERT INTO users (name, email, password, role)
         VALUES ('$name', '$email', '$pass', 'teacher')"
    );

    echo "<p style='color:green'>Teacher added successfully</p>";
}
?>

<h2>Add Teacher</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Teacher Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Temporary Password" required><br><br>

    <button name="add_teacher">Add Teacher</button>
</form>