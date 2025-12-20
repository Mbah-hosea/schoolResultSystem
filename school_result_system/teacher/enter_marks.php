<?php
include "../config/db.php";

$class_subject_id = $_GET['id'];

$info = mysqli_query($conn,
    "SELECT cs.class_id, cs.subject_id, c.class_name, s.subject_name
     FROM class_subjects cs
     JOIN classes c ON cs.class_id=c.id
     JOIN subjects s ON cs.subject_id=s.id
     WHERE cs.id='$class_subject_id'"
);

$data = mysqli_fetch_assoc($info);

$students = mysqli_query($conn,
    "SELECT * FROM students WHERE class_id='{$data['class_id']}'"
);

if (isset($_POST['save'])) {
    foreach ($_POST['marks'] as $student_id => $m) {
        $ca = $m['ca'];
        $exam = $m['exam'];
        $total = $ca + $exam;

        mysqli_query($conn,
            "INSERT INTO marks (student_id, subject_id, term, ca_mark, exam_mark, total)
             VALUES ('$student_id','{$data['subject_id']}','$_POST[term]','$ca','$exam','$total')"
        );
    }
    echo "Marks saved successfully";
}
?>

<h2>
<?= $data['class_name'] ?> - <?= $data['subject_name'] ?>
</h2>

<form method="POST">
<select name="term">
    <option>First Term</option>
    <option>Second Term</option>
    <option>Third Term</option>
</select><br><br>

<table border="1">
<tr>
    <th>Student</th>
    <th>CA</th>
    <th>Exam</th>
</tr>

<?php while($st = mysqli_fetch_assoc($students)) { ?>
<tr>
    <td><?= $st['full_name'] ?></td>
    <td><input type="number" name="marks[<?= $st['id'] ?>][ca]" required></td>
    <td><input type="number" name="marks[<?= $st['id'] ?>][exam]" required></td>
</tr>
<?php } ?>
</table>

<button name="save">Save Marks</button>
</form>