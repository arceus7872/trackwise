<!DOCTYPE html>
<html>
<head>
<title>Student Registration</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="card">

<h2>Student Registration</h2>

<form action="student-register-action.php" method="POST">

<input type="text"
name="name"
placeholder="Student Name"
required>

<input type="email"
name="email"
placeholder="Email"
required>

<input type="password"
name="password"
placeholder="Password"
required>

<input type="text"
name="roll_number"
placeholder="Roll Number"
required>

<input type="text"
name="department"
placeholder="Department"
required>

<input type="text"
name="semester"
placeholder="Semester"
required>

<button type="submit">
Register
</button>

</form>

<a href="student-login.php">
Already Registered?
</a>

</div>

</body>
</html>