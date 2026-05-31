<?php

include("config.php");

$name = mysqli_real_escape_string(
    $conn,
    $_POST['name']
);

$email = mysqli_real_escape_string(
    $conn,
    $_POST['email']
);

$password = password_hash(
    $_POST['password'],
    PASSWORD_DEFAULT
);

$employee_id = mysqli_real_escape_string(
    $conn,
    $_POST['employee_id']
);

$check =
mysqli_query(
    $conn,
    "SELECT id
     FROM nusers
     WHERE email='$email'"
);

if(mysqli_num_rows($check) > 0){

    die("Email already exists");

}

$userInsert =
mysqli_query(

    $conn,

    "INSERT INTO nusers
    (
        name,
        email,
        password,
        role
    )

    VALUES
    (
        '$name',
        '$email',
        '$password',
        'teacher'
    )"

);

if(!$userInsert){

    die(
        "User Registration Failed : "
        . mysqli_error($conn)
    );

}

$user_id =
mysqli_insert_id($conn);

$teacherInsert =
mysqli_query(

    $conn,

    "INSERT INTO teachers
    (
        user_id,
        employee_id
    )

    VALUES
    (
        '$user_id',
        '$employee_id'
    )"

);

if(!$teacherInsert){

    die(
        "Teacher Registration Failed : "
        . mysqli_error($conn)
    );

}

header(
    "Location: teacher-login.php?success=1"
);

exit();

?>

