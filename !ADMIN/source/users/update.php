<?php

    /*

        This PHP code update the users data

        from the users table in the database.

    */

include '../connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$user = $_POST['user'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$birthdate = $_POST['bdate'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$password = $_POST['password'];
$role = $_POST['role'];
$fnm = $_FILES['image']['name'];

$tm = md5(time());
$uploadDir = "../../../!SIGNUP/uploads/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($fnm == "") {
    $sql = "UPDATE users SET 
        firstname = '$firstname',
        middlename = '$middlename',
        lastname = '$lastname',
        birthday = '$birthdate',
        email = '$email',
        contact = '$contact',
        `password` = '$password',
        `role` = '$role'
    WHERE `email` = '$user'";
} else {
    $dst = $uploadDir . $tm . $fnm;
    $dst1 = $tm . $fnm;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $dst)) {
        $sql = "UPDATE users SET 
            firstname = '$firstname',
            middlename = '$middlename',
            lastname = '$lastname',
            birthday = '$birthdate',
            email = '$email',
            contact = '$contact',
            `password` = '$password',
            `role` = '$role',
            `profimg` = '$dst1'
        WHERE `email` = '$user'";
    } else {
        echo json_encode(["error" => "Failed to move uploaded file."]);
        exit;
    }
}

mysqli_query($conn, $sql);

if (mysqli_error($conn)) {
    echo json_encode(["error" => mysqli_error($conn)]);
} else {
    echo json_encode(["success" => "User information successfully updated."]);
}
?>
