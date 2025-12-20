<?php
include "../config/db.php";

if (isset($_POST['add_subject'])) {
    $subject = $_POST['subject_name'];
    mysqli_query($conn, "INSERT INTO subjects (subject_name) VALUES ('$subject')");
    echo "Subject added";
}
?>

<h2>Add Subject</h2>
<form method="POST">
    <input type="text" name="subject_name" placeholder="e.g Mathematics" required>
    <button name="add_subject">Add Subject</button>
</form>