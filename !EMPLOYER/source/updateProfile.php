<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $contact = $_POST['contact'];
    $id1 = $_FILES['id1']['name'];
    $profimg = $_FILES['profimg']['name'];
    $lookingfor = isset($_POST['lookingfor']) ? $_POST['lookingfor'] : [];
    
    // Directory where files will be uploaded
    $target_dir = "../../!SIGNUP/uploads/";

    // Move uploaded files to target directory
    if($id1) {
        move_uploaded_file($_FILES['id1']['tmp_name'], $target_dir . $id1);
    }
    if($profimg) {
        move_uploaded_file($_FILES['profimg']['tmp_name'], $target_dir . $profimg);
    }

    // Update query
    $query = "UPDATE users SET contact = '$contact'";
    
    if ($id1) {
        $query .= ", id1 = '$id1'";
    }
    if ($profimg) {
        $query .= ", profimg = '$profimg'";
    }
    
    // Convert lookingfor array to comma-separated string
    $lookingfor_str = implode(',', $lookingfor);
    $query .= ", lookingfor = '$lookingfor_str' WHERE id = $user_id";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Profile Updated'); window.location.href = 'profileEmployer.php';</script>";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
