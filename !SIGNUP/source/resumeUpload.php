<?php
session_start();
include "connection.php";
include "config.php";  // Contains your CV_SUBSCRIPTION_KEY and CV_ENDPOINT

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST["insert"])) {
    $email = $_SESSION['email']; // Assuming email as identifier
    $checksql = "SELECT * FROM users WHERE email = '$email'";
    $checkun = mysqli_query($conn, $checksql);

    if (mysqli_num_rows($checkun) > 0) {
        header("Location: workerReg.php?error");
        exit();
    } else {
        // Ensure the uploads directory exists
        if (!is_dir("../uploads/")) {
            mkdir("../uploads/", 0777, true);
        }

        // File upload handling for resume
        $tm_resume = md5(time() . "resume");
        $fnm_resume = $_FILES["resume"]["name"];
        $dst_resume = "./../uploads/" . $tm_resume . $fnm_resume;
        $dst_resume_db = "../uploads/" . $tm_resume . $fnm_resume;

        if (!move_uploaded_file($_FILES["resume"]["tmp_name"], $dst_resume)) {
            echo "Failed to upload resume. Error details: " . $_FILES["resume"]["error"];
            exit();
        }

        // --- Microsoft Cognitive Services OCR Integration for Resume Verification ---

        // Read the uploaded file content
        $imageData = file_get_contents($dst_resume);

        // Function to call the Read (OCR) API
        function callReadAPI($imageData) {
            $url = CV_ENDPOINT . '/vision/v3.2/read/analyze';
            $headers = [
                "Ocp-Apim-Subscription-Key: " . CV_SUBSCRIPTION_KEY,
                "Content-Type: application/octet-stream"
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $imageData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true); // Get headers for the Operation-Location

            $response = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($response, 0, $headerSize);
            curl_close($ch);

            if ($status != 202) {
                die("OCR request failed. HTTP Status: " . $status);
            }

            // Extract Operation-Location header for polling
            if (preg_match('/Operation-Location:\s*(.*)/i', $header, $matches)) {
                return trim($matches[1]);
            } else {
                die("Operation-Location header not found.");
            }
        }

        // Function to poll the OCR result until completion
        function pollReadResult($operationLocation) {
            $retries = 10;
            while ($retries > 0) {
                sleep(1); // wait a second before each poll
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $operationLocation);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    "Ocp-Apim-Subscription-Key: " . CV_SUBSCRIPTION_KEY
                ]);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $pollResponse = curl_exec($ch);
                $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                $result = json_decode($pollResponse, true);
                if (isset($result['status']) && $result['status'] === 'succeeded') {
                    return $result;
                }
                $retries--;
            }
            return false;
        }

        // Call the OCR API and poll for the result
        $operationLocation = callReadAPI($imageData);
        $ocrResult = pollReadResult($operationLocation);

        if (!$ocrResult) {
            // Optionally remove the uploaded file if OCR fails
            unlink($dst_resume);
            die("Failed to retrieve OCR result in time.");
        }

        // Extract the text from the OCR result
        $extractedText = "";
        if (isset($ocrResult['analyzeResult']['readResults'])) {
            foreach ($ocrResult['analyzeResult']['readResults'] as $page) {
                foreach ($page['lines'] as $line) {
                    $extractedText .= $line['text'] . "\n";
                }
            }
        }

        // Validate that the resume contains expected keywords (e.g., experience, education, skills)
        $requiredKeywords = ['experience', 'education', 'skills'];
        $isValidResume = true;
        foreach ($requiredKeywords as $keyword) {
            if (stripos($extractedText, $keyword) === false) {
                $isValidResume = false;
                break;
            }
        }

        if (!$isValidResume) {
            // Optionally remove the uploaded file if the resume is invalid
            unlink($dst_resume);
            echo "<script>alert('The uploaded resume does not appear to contain the necessary sections (experience, education, skills).'); window.history.back();</script>";
            exit();
        }
        // --- End of OCR Verification ---

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
            'worker',
            '$_SESSION[profimg]',
            'NULL',
            '$dst_resume_db',
            '$_SESSION[specialty]',
            'NULL',
            '0'
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
            <h4 class="w-100">Register as Worker</h4>

            <!-- Left Column -->
            <div class="col-md-6 d-flex flex-column align-items-center px-4">
                <div class="w-100 d-flex flex-column align-items-center">
                    <br><br>
                    <img src="../images/profilePhoto.png" class="rounded-4 align-self-center" alt="File Uploaded" id="useruploaded" height="500px" width="400px">
                    <div class="form-group w-100 mt-3">
                        <label for="resume" class="form-label">Resume</label>
                        <input accept="image/*" type="file" class="form-control shadow-none" name="resume" id="upload" required>
                        <div class="invalid-feedback">Please submit your Resume.</div>
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
            '<span style="color:#white">  Have an account?,</span>','&emsp;<a href="..\..\!SIGNUP\source\login.php">Log in</a>';
        ?>
    </div>
</body>
</html>
