  <?php
require_once "Student.php";
require_once "Attendance.php";

$studentObj = new Student();
$attendanceObj = new Attendance();

// Handle Student form
if (isset($_POST['add_student'])) {
    $studentObj->addStudent($_POST['name'], $_POST['course']);
}

// Handle Attendance form
if (isset($_POST['add_attendance'])) {
    $attendanceObj->addAttendance($_POST['student_id'], $_POST['date'], $_POST['status']);
}

// Handle Deletes
if (isset($_GET['delete_student'])) {
    $studentObj->deleteStudent($_GET['delete_student']);
}
if (isset($_GET['delete_attendance'])) {
    $attendanceObj->deleteAttendance($_GET['delete_attendance']);
}

$students = $studentObj->getAllStudents();
$attendances = $attendanceObj->getAllAttendance();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student & Attendance Management</title>
</head>
<body>
    <h2>Add Student</h2>
    <form method="post">
        Name: <input type="text" name="name" required>
        Course: <input type="text" name="course" required>
        <button type="submit" name="add_student">Add</button>
    </form>

    <h3>Student List</h3>
    <table border="1">
        <tr><th>ID</th><th>Name</th><th>Course</th><th>Action</th></tr>
        <?php foreach ($students as $s): ?>
        <tr>
            <td><?= $s['id'] ?></td>
            <td><?= $s['name'] ?></td>
            <td><?= $s['course'] ?></td>
            <td><a href="?delete_student=<?= $s['id'] ?>">Delete</a></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Add Attendance</h2>
    <form method="post">
        Student:
        <select name="student_id">
            <?php foreach ($students as $s): ?>
                <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
            <?php endforeach; ?>
        </select>
        Date: <input type="date" name="date" required>
        Status:
        <select name="status">
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>
        <button type="submit" name="add_attendance">Add</button>
    </form>

    <h3>Attendance Records</h3>
    <table border="1">
        <tr><th>ID</th><th>Student ID</th><th>Date</th><th>Status</th><th>Action</th></tr>
        <?php foreach ($attendances as $a): ?>
        <tr>
            <td><?= $a['id'] ?></td>
            <td><?= $a['student_id'] ?></td>
            <td><?= $a['date'] ?></td>
            <td><?= $a['status'] ?></td>
            <td><a href="?delete_attendance=<?= $a['id'] ?>">Delete</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
