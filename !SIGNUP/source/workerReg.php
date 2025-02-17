<?php

    /*
        This is the !Signup page where users perform the !signup if
        the user has no account.
    */

    // Start the session
    session_start();

    include "connection.php";

    if(isset($_POST["next"])) {
        // Store the form data in session variables
        $_SESSION['firstname'] = $_POST['firstname'];
        $_SESSION['middlename'] = $_POST['middlename'];
        $_SESSION['lastname'] = $_POST['lastname'];
        $_SESSION['bdate'] = $_POST['bdate'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['contact'] = $_POST['contact'];
        $_SESSION['password'] = $_POST['password'];
    
        // File upload handling for the profile photo
        $tm_profile = md5(time() . "profile");
        $fnm_profile = $_FILES["image"]["name"];
        $dst_profile = "./../uploads/".$tm_profile.$fnm_profile;
        $dst_profile_db = "../uploads/".$tm_profile.$fnm_profile;
    
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $dst_profile)) {
            $_SESSION['profimg'] = $dst_profile_db;
        } else {
            echo "Failed to upload profile photo.";
            exit();
        }
    
        // Redirect to the next page (resumeUpload.php)
        header("Location: resumeUpload.php");
        exit();
    }
    ?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <!-- Page title and meta tags -->
        <title>Worker | Register</title>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">


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
        <script src = "user.js" type = "text/javascript"></script>

        <!-- Custom CSS -->
        <link rel = "stylesheet" type = "text/css" href = "index.css">
    </head>

    <body class="section">
        <!-- Navigation bar -->
        <nav class = "container">
            <a class = "navbar-brand">
                <img class ="logo" src = "../images/logo.png" alt = "OBRA | Public Employment Service Office" height = "60" width = "60">
                <span class = "align-center fs-4"> | Public Employment Service Office</span>
            </a>
        </nav>

        <!-- Content -->
        <div class = "content" id = "right">
                    <form class = "row needs-validation pt-3 w-100 d-flex align-items-center justify-content-center" method = "post" enctype = "multipart/form-data" novalidate>
                        <h4>Register as Worker</h4>
                        <div class = "col-6 px-5 pt-3 pb-1 d-flex justify-content-center vstack h-100">
                            <div class = "form-group row">
                                <div class = "col-6">
                                    <label for = "firstname" class = "form-label">First Name</label>
                                    <input type = "text" class = "form-control shadow-none" name = "firstname" placeholder = "e.g. Juan" id = "fname" required>
                                    <div class = "invalid-feedback">Please enter user first name.</div>
                                </div>
                                <div class = "col-6">
                                    <label for = "middlename" class = "form-label">Middle Name</label>
                                    <input type = "text" class = "form-control shadow-none" name = "middlename" placeholder = "e.g. Dela Rosa" id = "mname" required>
                                    <div class = "invalid-feedback">Please enter user middle name.</div>
                                </div>
                            </div>

                            <div class = "form-group pt-4">
                                <label for = "lastname" class = "form-label">Last Name</label>
                                <input type = "text" class = "form-control shadow-none" name = "lastname" placeholder = "e.g. Dela Cruz" id = "lname" required>
                                <div class = "invalid-feedback">Please enter user last name.</div>
                            </div>

                            <div class = "form-group row pt-4">
                                <div class = "col-6">
                                    <label for = "bdate" class = "form-label">Birthdate</label>
                                    <div class = "md-form md-outline input-with-post-icon datepicker">
                                        <input type = "date" class = "form-control shadow-none" name = "bdate" placeholder = "Select date" id = "bdate" required>
                                        <div class = "invalid-feedback">Please enter user birthdate.</div>
                                    </div>
                                </div>
                                <div class = "col-6">
                                    <label for = "contact" class = "form-label">Contact Number</label>
                                    <input type = "number" class = "form-control shadow-none" name = "contact" placeholder = "09123456789" id = "contact" required>
                                    <div class = "invalid-feedback">Please enter user contact.</div>
                                </div>
                        
                            </div>

                            <div class = "form-group pt-4">
                                <label for = "email" class = "form-label">Email Address</label>
                                <input type = "email" class = "form-control shadow-none" name = "email" placeholder = "e.g. juan@your-domain.com" id = "email" required>
                                <div class = "invalid-feedback">Please enter a valid email address.</div>
                            </div>

                            <div class = "form-group pt-4">
                                <label for = "password" class = "form-label">Password</label>
                                <input type = "password" class = "form-control shadow-none" name = "password" placeholder = "Enter password" id = "password" required>
                                <div class = "invalid-feedback">Please enter password.</div>
                            </div>
                            <br>
                            <button type="submit" name="next" class="btn btn-primary mt-3 shadow-lg w-100 rounded-5" id="adduser">Next</button>
                        </div>

                        <div class = "col-5 d-flex vstack justify-content-center">
                            <img src = "../images/profilePhoto.png" class = "rounded-4 align-self-center" alt = "File Uploaded" id = "useruploaded" height = "300px">
                            <div class = "form-group">
                                <br><br>
                                <label for = "image" class = "form-label">Profile Photo</label>
                                <input accept = "image/*" type = "file" class = "form-control shadow-none" name = "image" id = "upload" required>
                                <div class = "invalid-feedback">Please submit your picture</div>
                            </div>
                        </div>
                    </form>
                    <br>
                    &emsp;&emsp;
                    <?php 
                        echo '<span style="color:#white">Or Register as Client?,</span>','&emsp;<a href="..\..\!SIGNUP\source\employerReg.php">Register</a>','<br>&emsp;&emsp;',
                        '<span style="color:#white">  Have an account?,</span>','&emsp;<a href="..\..\!SIGNUP\source\login.php">Log in</a>';?>
                </div>
            </div>
    </body>
</html>
