<?php



    /*

        This is the PHP code responsible for deleting the users

        from the database.

    */



    include '../connection.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    $email = $_POST['email'];



    $sql = "DELETE FROM users WHERE `email` = '$email'";



    mysqli_query($conn, $sql);

?>