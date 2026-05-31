<?php

session_start();

include("config.php");

$result = mysqli_query(

$conn,

"SELECT

students.roll_number,

COUNT(attendance.id) AS present_days,

(
SELECT COUNT(DISTINCT attendance_date)
FROM attendance
) AS total_days

FROM students

LEFT JOIN attendance

ON students.id = attendance.student_id
AND attendance.status='Present'

GROUP BY students.id

ORDER BY students.roll_number"

);

?>

<!DOCTYPE html>

<html>

<head>

<title>Student Attendance Report</title>

<style>

body{
    margin:0;
    padding:30px;
    font-family:Arial,sans-serif;
    background:#f4f7fc;
}

.container{
    max-width:1100px;
    margin:auto;
}

.card{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 5px 20px rgba(0,0,0,.1);
}

h1{
    text-align:center;
    color:#007bff;
    margin-bottom:25px;
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
    text-align:center;
    padding:12px;
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

.btn:hover{
    background:#0056b3;
}

</style>

</head>

<body>

<div class="container">

<div class="card">

<h1>Student Attendance Report</h1>

<table>

<tr>

<th>Roll Number</th>
<th>Present Days</th>
<th>Total Working Days</th>
<th>Attendance %</th>

</tr>

<?php

while($row=mysqli_fetch_assoc($result)){

$percent = 0;

if($row['total_days']>0){

$percent =
round(
($row['present_days']/$row['total_days'])*100,
2
);

}

?>

<tr>

<td><?php echo $row['roll_number']; ?></td>

<td><?php echo $row['present_days']; ?></td>

<td><?php echo $row['total_days']; ?></td>

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

<br>

<a href="teacher-dashboard.php" class="btn">

Back To Dashboard

</a>

</div>

</div>

</body>

</html>

