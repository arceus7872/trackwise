<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include("config.php");

if(!isset($_SESSION['user_id'])){

    die("Please Login");

}

$user_id =
$_SESSION['user_id'];

$token =
$_GET['token'] ?? '';

$device_hash =
$_GET['device_hash'] ?? '';

$ip =
$_SERVER['REMOTE_ADDR'];

/*
Check Allowed Network
*/

$network =
mysqli_query(

$conn,

"SELECT *
FROM allowed_networks
WHERE network_ip='$ip'"

);

if(
mysqli_num_rows($network)==0
){

    die(
    "Connect To College WiFi"
    );

}

/*
Check QR Session
*/

$qr =
mysqli_query(

$conn,

"SELECT *
FROM qr_sessions
WHERE qr_token='$token'
AND is_active=1
AND expires_at > NOW()"

);

if(
mysqli_num_rows($qr)==0
){

    die(
    "QR Expired Or Invalid"
    );

}

$qr_data =
mysqli_fetch_assoc($qr);

$qr_session_id =
$qr_data['id'];

$class_id =
$qr_data['class_id'];

/*
Find Student
*/

$student =
mysqli_query(

$conn,

"SELECT *
FROM students
WHERE user_id='$user_id'"

);

if(
mysqli_num_rows($student)==0
){

    die(
    "Student Record Missing"
    );

}

$student_data =
mysqli_fetch_assoc($student);

$student_id =
$student_data['id'];

/*
Attendance Already Marked?
*/

$already =
mysqli_query(

$conn,

"SELECT *
FROM attendance
WHERE student_id='$student_id'
AND qr_session_id='$qr_session_id'"

);

if(
mysqli_num_rows($already)>0
){

    die(
    "Attendance Already Marked"
    );

}

/*
Device Already Used?
*/

$device =
mysqli_query(

$conn,

"SELECT *
FROM attendance
WHERE qr_session_id='$qr_session_id'
AND device_hash='$device_hash'"

);

if(
mysqli_num_rows($device)>0
){

    die(
    "Device Already Used"
    );

}

/*
Save Attendance
*/

$insert =
mysqli_query(

$conn,

"INSERT INTO attendance

(
student_id,
class_id,
attendance_date,
status,
ip_address,
device_hash,
qr_session_id
)

VALUES

(
'$student_id',
'$class_id',
CURDATE(),
'Present',
'$ip',
'$device_hash',
'$qr_session_id'
)"

);

if(!$insert){

die(

"Attendance Save Failed : "

.

mysqli_error($conn)

);

}

?>

<!DOCTYPE html>

<html>

<head>

<title>

Attendance Success

</title>

<style>

body{

font-family:Arial;

background:#f5f5f5;

text-align:center;

padding-top:100px;

}

.success{

color:green;

font-size:32px;

font-weight:bold;

}

</style>

</head>

<body>

<div class="success">

Attendance Marked Successfully

</div>

<br><br>

<a href="student-dashboard.php">

Back To Dashboard

</a>

</body>

</html>

