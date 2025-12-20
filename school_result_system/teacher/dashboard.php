<?php
session_start();
include "../config/db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'teacher') {
    header("Location: ../index.php");
    exit();
}

$teacher_id = $_SESSION['user_id'];

$query = mysqli_query($conn,
    "SELECT cs.id, c.class_name, s.subject_name
     FROM class_subjects cs
     JOIN classes c ON cs.class_id = c.id
     JOIN subjects s ON cs.subject_id = s.id
     WHERE cs.teacher_id = '$teacher_id'"
);
?>

<h2>Teacher Dashboard</h2>
<p>Welcome, <strong><?= $_SESSION['name'] ?></strong></p>

<table border="1" cellpadding="5">
<tr>
    <th>Class</th>
    <th>Subject</th>
    <th>Action</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($query)) { ?>
<tr>
    <td><?= $row['class_name'] ?></td>
    <td><?= $row['subject_name'] ?></td>
    <td>
        <a href="enter_marks.php?id=<?= $row['id'] ?>">
            Enter Marks
        </a>
    </td>
</tr>
<?php } ?>
</table>