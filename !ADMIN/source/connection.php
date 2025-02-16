<?php

    // Establishes connection with the database
    $sname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "works";

    $conn = mysqli_connect($sname, $username, $password, $dbname);

    if(!$conn) {
        echo "Failed to connect.";
    }

?>