<?php

include("config.php");

$name = $_POST['name'];

$email = $_POST['email'];

$password =
password_hash(
$_POST['password'],
PASSWORD_DEFAULT
);

$roll =
$_POST['roll_number'];

$department =
$_POST['department'];

$semester =
$_POST['semester'];

$sql =
"INSERT INTO nusers
(name,email,password,role)

VALUES

('$name',
'$email',
'$password',
'student')";

if(mysqli_query($conn,$sql)){

$user_id =
mysqli_insert_id($conn);

mysqli_query(

$conn,

"INSERT INTO students
(user_id,
roll_number,
department,
semester)

VALUES

('$user_id',
'$roll',
'$department',
'$semester')"

);

header(
"Location: student-login.php"
);

exit();

}

echo "Registration Failed";

?>