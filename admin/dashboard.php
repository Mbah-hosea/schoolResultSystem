<?php 
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../index.php");

}
echo "<h1>Welcome to the Admin Dashboard</h1>";