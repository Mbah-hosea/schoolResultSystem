<?php 
session_start();
if ($_SESSION['role'] != 'class_master') {
    header("Location: ../index.php");

}
echo "<h1>Welcome to the Class Master Dashboard</h1>";