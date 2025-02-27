<?php
session_start();
include "connection.php";

if(isset($_POST["next"])) {
    $email = $_POST['email'];
    $bdate = $_POST['bdate'];
    $contact = $_POST['contact'];

    // Check if the email is already registered
    $check_query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $currentDate = new DateTime();
    $birthDate = new DateTime($bdate);
    $age = $currentDate->diff($birthDate)->y;

    if($result->num_rows > 0) {
        echo "<script>alert('Email already registered. Please use a different email.'); window.history.back();</script>";
    } else if($_POST['password'] !== $_POST['repassword']) {
        echo "<script>alert('Passwords do not match. Please re-enter your password.'); window.history.back();</script>";
    } else if($age < 21) {
        echo "<script>alert('You must be at least 21 years old to register.'); window.history.back();</script>";
    } else if(!preg_match('/^\d{11}$/', $contact)) {
        echo "<script>alert('Contact number must be exactly 11 digits.'); window.history.back();</script>";
    } else {
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

        // Redirect to the next page (idUpload.php)
        header("Location: idUpload.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employer | Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@900&family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <script src="user.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body class="section">
    <nav class="container">
        <a class="navbar-brand">
            <img class="logo" src="../images/logo.png" alt="WORKS | Public Employment Service Office" height="60" width="60">
            <span class="align-center fs-4"> | Public Employment Service Office</span>
        </a>
    </nav>

    <div class="content" id="right">
        <form class="row needs-validation pt-3 w-100 d-flex align-items-center justify-content-center" method="post" enctype="multipart/form-data" novalidate>
            <h4>Register as Employer</h4>
            <div class="col-6 px-5 pt-3 pb-1 d-flex justify-content-center vstack h-100">
                <div class="form-group row">
                    <div class="col-6">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control shadow-none" name="firstname" placeholder="e.g. Juan" id="fname" required>
                        <div class="invalid-feedback">Please enter user first name.</div>
                    </div>
                    <div class="col-6">
                        <label for="middlename" class="form-label">Middle Name</label>
                        <input type="text" class="form-control shadow-none" name="middlename" placeholder="e.g. Dela Rosa" id="mname" required>
                        <div class="invalid-feedback">Please enter user middle name.</div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control shadow-none" name="lastname" placeholder="e.g. Dela Cruz" id="lname" required>
                    <div class="invalid-feedback">Please enter user last name.</div>
                </div>

                <div class="form-group row pt-4">
                    <div class="col-6">
                        <label for="bdate" class="form-label">Birthdate</label>
                        <div class="md-form md-outline input-with-post-icon datepicker">
                            <input type="date" class="form-control shadow-none" name="bdate" placeholder="Select date" id="bdate" required>
                            <div class="invalid-feedback">Please enter user birthdate.</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="contact" class="form-label">Contact Number</label>
                        <input type="text" pattern="\d{11}" class="form-control shadow-none" name="contact" placeholder="09123456789" id="contact" required>
                        <div class="invalid-feedback">Please enter a valid 11-digit contact number.</div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control shadow-none" name="email" placeholder="e.g. juan@your-domain.com" id="email" required>
                    <div class="invalid-feedback">Please enter a valid email address.</div>                     
                </div>

                <div class="form-group pt-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control shadow-none" name="password" placeholder="Enter password" id="password" required>
                    <div class="invalid-feedback">Please enter password.</div>
                </div>

                <div class="form-group pt-4">
                    <label for="repassword" class="form-label">Re-enter Password</label>
                    <input type="password" class="form-control shadow-none" name="repassword" placeholder="Re-enter password" id="repassword" required>
                    <div class="invalid-feedback">Please re-enter password.</div>
                </div>

                <br>
                <button type="submit" name="next" class="btn btn-primary mt-3 shadow-lg w-100 rounded-5" id="adduser">Next</button>
            </div>

            <div class="col-5 d-flex vstack justify-content-center">
                <img src="../images/profilePhoto.png" class="rounded-4 align-self-center" alt="File Uploaded" id="useruploaded" height="300px">
                <div class="form-group">
                    <br><br>
                    <label for="image" class="form-label">Profile Photo</label>
                    <input accept="image/*" type="file" class="form-control shadow-none" name="image" id="upload" required>
                    <div class="invalid-feedback">Please submit your picture.</div>
                </div>
            </div>
        </form>
        <br>
        &emsp;&emsp;
        <?php 
            echo '<span style="color:#white">Or Register as Worker?,</span>','&emsp;<a href="..\..\!SIGNUP\source\workerReg.php">Register</a>','<br>&emsp;&emsp;',
            '<span style="color:#white">  Have an account?,</span>','&emsp;<a href="..\..\!SIGNUP\source\login.php">Log in</a>';
        ?>
    </div>
</body>
</html>
