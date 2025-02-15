<?php

    /* 
        This PHP code is responsible for logging the user out and ending the session.
    */

    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
?>