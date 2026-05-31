<!DOCTYPE html>
<html>
<head>
    <title>Teacher Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">

<h2>Teacher Registration</h2>

<form action="teacher-register-action.php" method="POST">

<input
type="text"
name="name"
placeholder="Full Name"
required>

<input
type="email"
name="email"
placeholder="Email"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<input
type="text"
name="employee_id"
placeholder="Employee ID"
required>

<button type="submit">
Register
</button>

</form>

<br>

<a href="teacher-login.php">
Already Registered? Login
</a>

</div>

</body>
</html>
