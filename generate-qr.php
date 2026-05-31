<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: teacher-login.php");
    exit();
}

include("config.php");

$token = bin2hex(random_bytes(16));

$expires_at = date(
    "Y-m-d H:i:s",
    strtotime("+20 seconds")
);

mysqli_query(
    $conn,
    "INSERT INTO qr_sessions
    (
    class_id,
    qr_token,
    expires_at,
    is_active
    )

    VALUES
    (
1,
'$token',
DATE_ADD(NOW(),INTERVAL 20 SECOND),
1
)"
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Generate Attendance QR</title>

<link rel="stylesheet" href="style.css">

<style>

#expiredMessage{

display:none;

color:red;

font-size:28px;

font-weight:bold;

text-align:center;

margin-top:20px;

}

#countdown{

font-size:22px;

font-weight:bold;

text-align:center;

}

</style>

</head>

<body>

<div class="card">

<h2>Attendance QR</h2>

<div id="qrContainer">

<img
id="qrImage"
src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=<?php echo urlencode($token); ?>"
alt="QR Code">

</div>

<br>

<div id="countdown">

20

</div>

<div id="expiredMessage">

QR HAS EXPIRED

</div>

<br>

<a href="teacher-dashboard.php">

<button>

Back

</button>

</a>

</div>

<script>

let timeLeft = 20;

const countdown =
document.getElementById(
"countdown"
);

const qr =
document.getElementById(
"qrContainer"
);

const expired =
document.getElementById(
"expiredMessage"
);

const timer =
setInterval(function(){

timeLeft--;

countdown.innerHTML =
timeLeft;

if(timeLeft <= 0){

clearInterval(timer);

qr.style.display =
"none";

countdown.style.display =
"none";

expired.style.display =
"block";

}

},1000);

</script>

</body>
</html>