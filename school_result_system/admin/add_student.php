<?php
include "../config/db.php";

if (isset($_POST['add_student'])) {
    $adm = $_POST['admission_number'];
    $name = $_POST['full_name'];
    $gender = $_POST['gender'];
    $class_id = $_POST['class_id'];

    mysqli_query($conn, 
        "INSERT INTO students (admission_number, full_name, gender, class_id)
         VALUES ('$adm','$name','$gender','$class_id')"
    );
    echo "Student added";
}

$classes = mysqli_query($conn, "SELECT * FROM classes");
?>

<h2>Add Student</h2>
<form method="POST">
    <input type="text" name="admission_number" placeholder="Admission Number" required><br>
    <input type="text" name="full_name" placeholder="Full Name" required><br>

    <select name="gender">
        <option>Male</option>
        <option>Female</option>
    </select><br>

    <select name="class_id">
        <?php while($c = mysqli_fetch_assoc($classes)) { ?>
            <option value="<?= $c['id'] ?>"><?= $c['class_name'] ?></option>
        <?php } ?>
    </select><br>

    <button name="add_student">Add Student</button>
</form>