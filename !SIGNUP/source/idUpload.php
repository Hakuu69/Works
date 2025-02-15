<?php
session_start();
include "connection.php";

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if(isset($_POST["insert"])) {
    $email = $_SESSION['email']; // Assuming email as identifier
    $checksql = "SELECT * FROM users WHERE email = '$email'";
    $checkun = mysqli_query($conn, $checksql);

    if(mysqli_num_rows($checkun) > 0) {
        header("Location: employerReg.php?error");
        exit();
    } else {
        // Ensure the uploads directory exists
        if (!is_dir("../uploads/")) {
            mkdir("../uploads/", 0777, true);
        }

        // File upload handling for the first ID
        $tm_id1 = md5(time() . "id1");
        $fnm_id1 = $_FILES["id1"]["name"];
        $dst_id1 = "./../uploads/".$tm_id1.$fnm_id1;
        $dst_id1_db = "../uploads/".$tm_id1.$fnm_id1;

        if (!move_uploaded_file($_FILES["id1"]["tmp_name"], $dst_id1)) {
            echo "Failed to upload first ID. Error details: " . $_FILES["id1"]["error"];
            exit();
        }

        // File upload handling for the second ID
        $tm_id2 = md5(time() . "id2");
        $fnm_id2 = $_FILES["id2"]["name"];
        $dst_id2 = "./../uploads/".$tm_id2.$fnm_id2;
        $dst_id2_db = "../uploads/".$tm_id2.$fnm_id2;

        if (!move_uploaded_file($_FILES["id2"]["tmp_name"], $dst_id2)) {
            echo "Failed to upload second ID. Error details: " . $_FILES["id2"]["error"];
            exit();
        }

        // Insert user data into the database
        $sql = "INSERT INTO users VALUES (
            NULL,
            '$_SESSION[firstname]',
            '$_SESSION[middlename]',
            '$_SESSION[lastname]',
            '$_SESSION[bdate]',
            '$_SESSION[email]',
            '$_SESSION[contact]',
            '$_SESSION[password]',
            'employer',
            '$_SESSION[profimg]',
            '$dst_id1_db',
            '$dst_id2_db',
            'NULL'
        )";

        if (mysqli_query($conn, $sql)) {
            ?>
            <script type="text/javascript">
                alert("You have been successfully registered, Mabuhay!");
                window.location.href = "login.php";
            </script>
            <?php
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Page title and meta tags -->
    <title>Employer | Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- JQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <!-- Bootstrap 5.2.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
          crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" 
            crossorigin="anonymous"></script>

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@900&family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <!-- Custom JS -->
    <script src="user.js" type="text/javascript"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body class="section">
    <!-- Navigation bar -->
    <nav class="container">
        <a class="navbar-brand">
            <img class="logo" src="../images/logo.png" alt="WORKS | Public Employment Service Office" height="60" width="60">
            <span class="align-center fs-4"> | Public Employment Service Office</span>
        </a>
    </nav>

    <!-- Content -->
    <div class="content" id="right">
        <form class="row needs-validation pt-3 w-100 d-flex align-items-start justify-content-center" method="post" enctype="multipart/form-data" novalidate>
            
            <!-- Heading left-aligned (same position as before) -->
            <h4 class="w-100">Register as Employer</h4>

            <!-- Left Column -->
            <div class="col-md-6 d-flex flex-column align-items-center px-4">
                <div class="w-100 d-flex flex-column align-items-center">
                    <br><br>
                    <img src="../images/profilePhoto.png" class="rounded-4 align-self-center" alt="File Uploaded" id="useruploaded" height="250px" width="500px">
                    <div class="form-group w-100 mt-3">
                        <label for="id1" class="form-label">Valid ID 1</label>
                        <input accept="image/*" type="file" class="form-control shadow-none" name="id1" id="upload_id1" required>
                        <div class="invalid-feedback">Please submit your first valid ID.</div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6 d-flex flex-column align-items-center px-4">
                <div class="w-100 d-flex flex-column align-items-center">
                    <br><br>
                    <img src="../images/profilePhoto.png" class="rounded-4 align-self-center" alt="File Uploaded" id="useruploaded" height="250px" width="500px">
                    <div class="form-group w-100 mt-3">
                        <label for="id2" class="form-label">Valid ID 2</label>
                        <input accept="image/*" type="file" class="form-control shadow-none" name="id2" id="upload_id2" required>
                        <div class="invalid-feedback">Please submit your second valid ID.</div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="col-12 mt-4 d-flex justify-content-center">
                <button type="submit" name="insert" class="btn btn-primary w-50 shadow-lg rounded-5" id="adduser">Register Account</button>
            </div>
        </form>
        <br>
        &emsp;&emsp;
        <?php 
            echo '<span style="color:#white">Or Register as Worker?,</span>','&emsp;<a href="..\..\!SIGNUP\source\workerReg.php">Register</a>','<br>&emsp;&emsp;',
            '<span style="color:#white">  Have an account?,</span>','&emsp;<a href="..\..\!SIGNUP\source\login.php">Log in</a>';?>
    </div>
</body>
</html>
