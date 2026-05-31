<?php

session_start();

include("config.php");

$result = mysqli_query(

$conn,

"SELECT

s.roll_number,

COUNT(a.id) AS present_days,

(
SELECT COUNT(DISTINCT attendance_date)
FROM attendance
) AS total_classes

FROM students s

LEFT JOIN attendance a

ON s.id = a.student_id
AND a.status='Present'

GROUP BY s.id

ORDER BY s.roll_number"

);

?>

<!DOCTYPE html>

<html>

<head>

<title>Attendance Reports</title>

<style>

body{

background:#f4f7fc;
font-family:Arial,sans-serif;
padding:30px;

}

.card{

max-width:1000px;
margin:auto;
background:white;
padding:30px;
border-radius:15px;
box-shadow:0 0 20px rgba(0,0,0,.1);

}

h1{

text-align:center;
margin-bottom:25px;
color:#007bff;

}

table{

width:100%;
border-collapse:collapse;

}

th{

background:#007bff;
color:white;
padding:15px;

}

td{

padding:12px;
text-align:center;
border-bottom:1px solid #ddd;

}

tr:hover{

background:#f5f5f5;

}

.good{

color:green;
font-weight:bold;

}

.warning{

color:red;
font-weight:bold;

}

.btn{

display:inline-block;
margin-top:20px;
padding:12px 25px;
background:#007bff;
color:white;
text-decoration:none;
border-radius:8px;

}

</style>

</head>

<body>

<div class="card">

<h1>Attendance Reports</h1>

<table>

<tr>

<th>Roll Number</th>
<th>Present Days</th>
<th>Total Classes</th>
<th>Attendance %</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result)){

$percent = 0;

if($row['total_classes']>0){

$percent =
round(
($row['present_days']/$row['total_classes'])*100,
2
);

}

?>

<tr>

<td><?php echo $row['roll_number']; ?></td>

<td><?php echo $row['present_days']; ?></td>

<td><?php echo $row['total_classes']; ?></td>

<td>

<?php

if($percent >= 75){

echo "<span class='good'>".$percent."%</span>";

}else{

echo "<span class='warning'>".$percent."%</span>";

}

?>

</td>

</tr>

<?php } ?>

</table>

<a
href="teacher-dashboard.php"
class="btn">

Back To Dashboard

</a>

</div>

</body>

</html>




