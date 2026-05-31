<?php

session_start();

include("config.php");

$roll =
$_POST['roll_number'];

$department =
$_POST['department'];

$semester =
$_POST['semester'];

mysqli_query(

$conn,

"INSERT INTO students
(
roll_number,
department,
semester
)

VALUES
(
'$roll',
'$department',
'$semester'
)"

);

header(
"Location:students.php"
);

?>