<?php

session_start();

if(
!isset($_SESSION['user_id'])
){

header(
"Location: teacher-login.php"
);

exit();

}

?>

<!DOCTYPE html>
<html>
<head>

<title>
Teacher Dashboard
</title>

<link rel="stylesheet"
href="style.css">

</head>

<body>

<div class="card">

<h1>
Welcome
<?php
echo $_SESSION['name'];
?>
</h1>

<a href="students.php">

<button>
Manage Students
</button>

</a>

<a href="attendance.php">

<button>
Take Attendance
</button>

</a>

<a href="reports.php">

<button>
View Reports
</button>

</a>

<a href="generate-qr.php">

<button>

Generate Attendance QR

</button>

</a>

<a href="logout.php">

<button>
Logout
</button>

</a>

</div>

</body>
</html>