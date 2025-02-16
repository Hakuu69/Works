<?php

    /*
        This is the PHP code responsible for deleting the users
        from the database.
    */

    include '../connection.php';

    $username = $_POST['username'];

    $sql = "DELETE FROM users WHERE `username` = '$username'";

    mysqli_query($conn, $sql);
?>