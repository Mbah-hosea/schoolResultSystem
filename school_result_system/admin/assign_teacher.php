<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

/* Fetch all teachers */
$teachers = mysqli_query($conn, 
    "SELECT id, name FROM users WHERE role = 'teacher'"
);

/* Fetch all class-subject combinations */
$class_subjects = mysqli_query($conn,
    "SELECT 
        cs.id AS cs_id,
        c.class_name,
        s.subject_name,
        u.name AS teacher_name
     FROM class_subjects cs
     JOIN classes c ON cs.class_id = c.id
     JOIN subjects s ON cs.subject_id = s.id
     LEFT JOIN users u ON cs.teacher_id = u.id"
);

/* Assign teacher */
if (isset($_POST['assign'])) {
    $cs_id = $_POST['class_subject_id'];
    $teacher_id = $_POST['teacher_id'];

    mysqli_query($conn,
        "UPDATE class_subjects 
         SET teacher_id = '$teacher_id'
         WHERE id = '$cs_id'"
    );

    echo "<p style='color:green'>Teacher assigned successfully</p>";
}
?>

<h2>Assign Teacher to Subject (Per Class)</h2>

<form method="POST">
    <label>Class & Subject</label><br>
    <select name="class_subject_id" required>
        <option value="">-- Select Class & Subject --</option>
        <?php while ($cs = mysqli_fetch_assoc($class_subjects)) { ?>
            <option value="<?= $cs['cs_id'] ?>">
                <?= $cs['class_name'] ?> — <?= $cs['subject_name'] ?>
                <?= $cs['teacher_name'] ? "(Assigned: {$cs['teacher_name']})" : "(Not Assigned)" ?>
            </option>
        <?php } ?>
    </select>
    <br><br>

    <label>Teacher</label><br>
    <select name="teacher_id" required>
        <option value="">-- Select Teacher --</option>
        <?php while ($t = mysqli_fetch_assoc($teachers)) { ?>
            <option value="<?= $t['id'] ?>">
                <?= $t['name'] ?>
            </option>
        <?php } ?>
    </select>
    <br><br>

    <button name="assign">Assign Teacher</button>
</form>