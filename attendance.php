<?php

session_start();

include("config.php");

if(!isset($_SESSION['user_id'])){

header("Location: teacher-login.php");
exit();

}

$students = mysqli_query(

$conn,

"SELECT *
FROM students
ORDER BY roll_number"

);

?>

<!DOCTYPE html>

<html>

<head>

<title>

Manual Attendance

</title>

<link rel="stylesheet" href="style.css">

<style>

table{

width:100%;
border-collapse:collapse;

}

th,td{

border:1px solid #ddd;
padding:10px;
text-align:center;

}

th{

background:#333;
color:white;

}

</style>

</head>

<body>

<div class="card">

<h1>

Manual Attendance

</h1>

<form method="post" action="save-attendance.php">

<table>

<tr>

<th>Roll Number</th>
<th>Present</th>

</tr>

<?php

while(
$row =
mysqli_fetch_assoc($students)
){

?>

<tr>

<td>

<?php
echo $row['roll_number'];
?>

</td>

<td>

<input
type="checkbox"
name="present[]"
value="<?php echo $row['id']; ?>">

</td>

</tr>

<?php

}

?>

</table>

<br>

<button type="submit">

Save Attendance

</button>

</form>

</div>

</body>

</html>

