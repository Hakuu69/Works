<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $contact = $_POST['contact'];
    $resume = $_FILES['resume']['name'];
    $profimg = $_FILES['profimg']['name'];
    $specialty = isset($_POST['specialty']) ? $_POST['specialty'] : [];
    
    // Directory where files will be uploaded
    $target_dir = "../../!SIGNUP/uploads/";

    // Move uploaded files to target directory
    if ($resume) {
        move_uploaded_file($_FILES['resume']['tmp_name'], $target_dir . $resume);
    }
    if ($profimg) {
        move_uploaded_file($_FILES['profimg']['tmp_name'], $target_dir . $profimg);
    }

    // Update query
    $query = "UPDATE users SET contact = '$contact'";
    
    if ($resume) {
        $query .= ", resume = '$resume'";
    }
    if ($profimg) {
        $query .= ", profimg = '$profimg'";
    }
    
    // Convert specialty array to comma-separated string
    $specialty_str = implode(',', $specialty);
    $query .= ", specialty = '$specialty_str' WHERE id = $user_id";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Profile Updated'); window.location.href = 'profileWorker.php';</script>";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
