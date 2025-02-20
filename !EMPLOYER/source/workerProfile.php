<?php
session_start();
include 'connection.php'; // Adjust the path as needed

// Check if worker ID is passed
if (isset($_GET['id'])) {
    $worker_id = $_GET['id'];

    // Check if the worker ID is a valid integer
    if (!filter_var($worker_id, FILTER_VALIDATE_INT)) {
        echo "Invalid worker ID.";
        exit;
    }
    
    // Fetch worker details using prepared statement
    $stmt = $conn->prepare("SELECT profimg, firstname, middlename, lastname, specialty, email, contact, resume, isHired FROM users WHERE id = ? AND role = 'worker'");
    $stmt->bind_param("i", $worker_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $worker = $result->fetch_assoc();
    } else {
        echo "Worker not found.";
        exit;
    }
} else {
    echo "No worker ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include Bootstrap and other required libraries -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Worker Profile</title>
</head>
<body>
<!-- Profile section -->
<div class="profile-section">
    <img src="../../!SIGNUP/uploads/<?php echo $worker['profimg']; ?>" alt="Profile Photo">
    <h2><?php echo $worker['firstname'] . ' ' . $worker['middlename'] . ' ' . $worker['lastname']; ?></h2>
    <p>Specialty: <?php echo $worker['specialty']; ?></p>
    <p>Email: <?php echo $worker['email']; ?></p>
    <p>Contact: <?php echo $worker['contact']; ?></p>
    <p>Resume: <a href="../../!SIGNUP/uploads/<?php echo $worker['resume']; ?>" target="_blank">View Resume</a></p>
    <p>Hired Status: <?php echo $worker['isHired'] ? 'Hired' : 'Not Hired'; ?></p>
</div>
</body>
</html>
