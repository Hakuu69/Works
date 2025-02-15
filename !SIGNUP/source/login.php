<?php

    /*
        This is the Login page where users perform the login before
        gaining access to the different pages in the website.
    */

    // Start the session
    session_start();

    include "connection.php";

    // Action when login form is submitted
    if(isset($_POST['login'])) {

        // Function to validate the input of the user
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $email = validate($_POST['email']);
        $password = validate($_POST['password']);

        // MySQL quer
        $sql = "SELECT * FROM `users` WHERE email = '$email' AND `password` = '$password'";
        $res = mysqli_query($conn, $sql);

        if(mysqli_num_rows($res) === 1) {
            $row = mysqli_fetch_assoc($res);

            if($row['email'] === $email && $row['password'] === $password) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['id'] = $row['id'];

                if($row['role'] === 'admin') {
                    // Redirect user to dashboard if they are an admin
                    echo "<script>window.location = '../../!ADMIN/source/dashboard.php';</script>";
                } elseif ($row['role'] === 'employer') {
                    // Redirect user to Home page if they are a employer
                    echo "<script>window.location = '../../!EMPLOYER/source/homeEmployer.php';</script>";
                } else {
                    // Redirect user to Home page if they are a worker
                    echo "<script>window.location = '../../!WORKER/source/homeWorker.php';</script>";
                }

                exit();
            }
        } else {

            // Show error message "Incorrect email or password" if user entered incorrect login credentials
            header("Location: login.php?error");
            exit();
        }
    }

?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <!-- Page title and meta tags -->
        <title>OBRA | Login</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <!-- Icon -->
        <link rel = "icon" href = "../images/LogoTitle.png">

        <!-- JQuery Library -->
        <script src = "https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src = "https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

        <!-- Bootstrap 5.2.3 -->
        <link
            href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
            rel = "stylesheet" integrity = "sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
            crossorigin = "anonymous">
        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" 
            crossorigin="anonymous">
        </script>

        <!-- Bootstrap Icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@900&family=Poppins:wght@400;700&display=swap" rel="stylesheet">

        <!-- Custom JS -->
        <script src = "index.js"></script>

        <!-- Custom CSS -->
        <link rel = "stylesheet" type = "text/css" href = "index.css">
    </head>

    <body class="section">
        <!-- Navigation bar -->
        <nav class = "container">
            <a class = "navbar-brand">
                <img class ="logo" src = "../images/logo.png" alt = "JoyBoy! | Best Anime Figures" height = "60" width = "60">
                <span class = "align-center fs-4"> | Login</span>
            </a>
        </nav>

        <!-- Content -->
        <div class = "container-fluid">
            <div class = "row align-middle">

                <!-- Login section -->
                <div class = "col-lg-6 col-md-5 col-sm-12 align-self-center px-5" id = "login">
                    <h3 class = "text-center fw-bold">Login to your account</h3>
                    <form id = "login-form" method = "post" class = "needs-validation px-5 pt-5" novalidate>
                        <div class = "form-group pt-4">
                            <label for = "email" class = "form-label">Email</label>
                            <input type = "text" class = "form-control shadow-none" name = "email" id = "email" required>
                            <div class = "invalid-feedback">Please enter your email.</div> 
                        </div>

                        <div class = "form-group pt-4">
                            <label for = "password" class = "form-label">Password</label>
                            <input type = "password" class = "form-control shadow-none" name = "password" id = "password" required>
                            <div class = "invalid-feedback">Make sure that you have entered the correct password.</div>
                        </div>

                        <?php
                            if(isset($_GET['error'])) {
                                ?>
                                    <p class = "error pt-3">
                                        <?php echo "Incorrect email or password.";?>
                                    </p>
                                <?php
                            }
                        ?>

                        <button type = "submit" name = "login" id = "submitbtn" class = "submit btn btn-primary mt-5 w-100 shadow-lg rounded-5">Login</button>

                        <div class = "form-group pt-4">
                        <?php 
                        echo '<span style="color:#white"> Don\'t have an account?','<br>',
                        'Register as employer,','&emsp;<a href="..\..\!SIGNUP\source\employerReg.php">Register</a>','<br>',
                        'Register as Worker,','&emsp;<a href="..\..\!SIGNUP\source\workerReg.php">Register</a>';?>
                        </div>
                    </form>
                </div>

                <!-- Carousel -->
                <div class = "col-lg-5 col-md-5 d-none d-md-block" id = "carousel-container">
                    <div id = "images-slides" class = "carousel slide carousel-fade" data-bs-ride = "carousel" data-bs-interval = "5000">
                        <div class = "carousel-inner">
                            <div class = "carousel-indicators">
                                <button type = "button" data-bs-target = "#images-slides" data-bs-slide-to = "0" class = "active" aria-current = "true" aria-label = "Slide 1"></button>
                                <button type = "button" data-bs-target = "#images-slides" data-bs-slide-to = "1" aria-label = "Slides2"></button>
                                <button type = "button" data-bs-target = "#images-slides" data-bs-slide-to = "2" aria-label = "Sllides3"></button>
                            </div>

                            <div class = "carousel-item active">
                                <img src = "../images/logo.png" class =  "rounded-5" alt = "One Piece">
                            </div>
                            <div class = "carousel-item">
                                <img src = "../images/background.jpg" class = "rounded-5" alt = "Demon Slayer">
                            </div>
                            <div class = "carousel-item">
                                <img src = "../images/insertimg.png" class = "rounded-5" alt = "Hunterhunter">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>