<?php

session_start();

if(!isset($_SESSION['user_id'])){

    header(
        "Location: student-login.php"
    );

    exit();

}

?>

<!DOCTYPE html>
<html>

<head>

<title>

Scan Attendance QR

</title>

<link
rel="stylesheet"
href="style.css">

<script src="https://unpkg.com/html5-qrcode"></script>

<style>

body{

font-family:Arial;

background:#f5f5f5;

}

.card{

width:90%;

max-width:600px;

margin:50px auto;

background:white;

padding:20px;

border-radius:10px;

box-shadow:0 0 10px rgba(0,0,0,.1);

text-align:center;

}

#reader{

width:100%;

margin:auto;

}

#result{

margin-top:20px;

font-size:18px;

font-weight:bold;

}

button{

padding:10px 20px;

cursor:pointer;

}

</style>

</head>

<body>

<div class="card">

<h2>

Scan Attendance QR

</h2>

<p>

Point your camera at the QR code.

</p>

<div id="reader"></div>

<div id="result"></div>

<br>

<a href="student-dashboard.php">

<button>

Back To Dashboard

</button>

</a>

</div>

<script>

const html5QrCode =
new Html5Qrcode(
"reader"
);

function onScanSuccess(
decodedText
){

document.getElementById(
"result"
).innerHTML =
"QR Detected";

html5QrCode.stop();

const deviceHash =
btoa(

navigator.userAgent +

screen.width +

screen.height +

Intl.DateTimeFormat()
.resolvedOptions()
.timeZone

);

window.location =

"attendance-save.php?token="

+

encodeURIComponent(
decodedText
)

+

"&device_hash="

+

encodeURIComponent(
deviceHash
);

}

html5QrCode.start(

{
facingMode:"environment"
},

{
fps:10,
qrbox:250
},

onScanSuccess

)

.catch(

(err)=>{

document.getElementById(
"result"
).innerHTML =

"Camera Error : "

+

err;

}

);

</script>

</body>

</html>

