<?php
include "../config/db.php";

$classes = mysqli_query($conn, "SELECT * FROM classes");
$subjects = mysqli_query($conn, "SELECT * FROM subjects");

if (isset($_POST['assign'])) {
    mysqli_query($conn,
        "INSERT INTO class_subjects (class_id, subject_id, coefficient)
         VALUES ('$_POST[class_id]','$_POST[subject_id]','$_POST[coefficient]')"
    );
    echo "Subject assigned to class";
}
?>

<h2>Assign Subject to Class</h2>
<form method="POST">
    <select name="class_id">
        <?php while($c = mysqli_fetch_assoc($classes)) { ?>
            <option value="<?= $c['id'] ?>"><?= $c['class_name'] ?></option>
        <?php } ?>
    </select><br>

    <select name="subject_id">
        <?php while($s = mysqli_fetch_assoc($subjects)) { ?>
            <option value="<?= $s['id'] ?>"><?= $s['subject_name'] ?></option>
        <?php } ?>
    </select><br>

    <input type="number" name="coefficient" placeholder="Coefficient" required><br>

    <button name="assign">Assign</button>
</form>