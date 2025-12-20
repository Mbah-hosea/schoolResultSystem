<?php 
session_start();
if ($_SESSION['role'] != 'head_teacher') {
    header("Location: ../index.php");

}
echo "<h1>Welcome to the Head Teacher Dashboard</h1>";