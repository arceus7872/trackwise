<?php

session_start();

if(!isset($_SESSION['user_id'])){

header("Location:teacher-login.php");

exit();

}

include("config.php");

$result =
mysqli_query(
$conn,
"SELECT *
FROM students
ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Students</title>

<link rel="stylesheet"
href="style.css">

</head>

<body>

<div class="card">

<h2>
Students
</h2>

<form
action="students-add.php"
method="POST">

<input
type="text"
name="roll_number"
placeholder="Roll Number"
required>

<input
type="text"
name="department"
placeholder="Department"
required>

<input
type="text"
name="semester"
placeholder="Semester"
required>

<button type="submit">

Add Student

</button>

</form>

<hr>

<table
border="1"
width="100%">

<tr>

<th>ID</th>

<th>Roll</th>

<th>Department</th>

<th>Semester</th>

<th>Delete</th>

</tr>

<?php

while(
$row=
mysqli_fetch_assoc(
$result
)
){

?>

<tr>

<td>
<?php
echo $row['id'];
?>
</td>

<td>
<?php
echo $row['roll_number'];
?>
</td>

<td>
<?php
echo $row['department'];
?>
</td>

<td>
<?php
echo $row['semester'];
?>
</td>

<td>

<a href=
"students-delete.php?id=<?php echo $row['id']; ?>">

Delete

</a>

</td>

</tr>

<?php

}

?>

</table>

<br>

<a href="teacher-dashboard.php">

<button>

Back

</button>

</a>

</div>

</body>
</html>