<?php

session_start();

if(
!isset($_SESSION['user_id'])
){

header(
"Location:student-login.php"
);

exit();

}

?>

<!DOCTYPE html>
<html>
<head>

<title>
Student Dashboard
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

<p>
Attendance information
will appear here
</p>
<a href="scan-qr.php">

<button>

Scan Attendance QR

</button>

</a>

<a href="student-report.php">
<button>Student Attendance Report</button>
</a>

<a href="logout.php">

<button>
Logout
</button>

</a>

</div>

</body>
</html>