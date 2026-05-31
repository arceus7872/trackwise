<?php

session_start();

include("config.php");

$email =
$_POST['email'];

$password =
$_POST['password'];

$sql =
"SELECT *
FROM nusers
WHERE email='$email'
AND role='teacher'";

$result =
mysqli_query(
$conn,
$sql
);

if(
mysqli_num_rows($result)==1
){

$user =
mysqli_fetch_assoc(
$result
);

if(
password_verify(
$password,
$user['password']
)
){

$_SESSION['user_id'] =
$user['id'];

$_SESSION['role'] =
'teacher';

$_SESSION['name'] =
$user['name'];

header(
"Location: teacher-dashboard.php"
);

exit();

}

}

echo "Invalid Login";

?>