<?php
include "../config/db.php";

if (isset($_POST['add_class'])) {
    $class_name = $_POST['class_name'];
    mysqli_query($conn, "INSERT INTO classes (class_name) VALUES ('$class_name')");
    echo "Class added successfully";
}
?>

<h2>Add Class</h2>
<form method="POST">
    <input type="text" name="class_name" placeholder="e.g Form 1A" required>
    <button name="add_class">Add Class</button>
</form>