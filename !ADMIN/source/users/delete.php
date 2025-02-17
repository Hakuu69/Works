<?php



    /*

        This is the PHP code responsible for deleting the users

        from the database.

    */



    include '../connection.php';



    $email = $_POST['email'];



    $sql = "DELETE FROM users WHERE `email` = '$email'";



    mysqli_query($conn, $sql);

?>