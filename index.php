<?php
session_start();
include 'config/db.php';
if(isset($_POST['login'])){
    $email= $_POST['email'];
    $password=md5($_POST['password']);
    $query=mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$password'");
     if (mysqli_num_rows($query) == 1) {
        $user = mysqli_fetch_assoc($query);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['name'];

        if ($user['role'] == 'admin') {
            header("Location: admin/dashboard.php");
        } elseif ($user['role'] == 'teacher') {
            header("Location: teacher/dashboard.php");
        } elseif ($user['role'] == 'class_master') {
            header("Location: class_master/dashboard.php");
        } else {
            header("Location: head_teacher/dashboard.php");
        }
    } else {
        echo "Invalid login details";
    }
}
?>

<form method="POST">
    <h2>School Result System Login</h2>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button name="login">Login</button>
</form>
