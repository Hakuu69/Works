<?php
session_start();
include 'connection.php'; // Adjust the path as needed

// Check if user_id session variable is set
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    
    // Fetching user profile photo
    $query = "SELECT profimg FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $profile_photo = $row['profimg'];
        $profile_photo_path = '../../!SIGNUP/uploads/' . $profile_photo;
    } else {
        // Fallback profile photo if not found
        $profile_photo_path = '../../!SIGNUP/images/profilePhoto.png';
    }
} else {
    // Handle case where user_id is not set
    $profile_photo_path = '../../!SIGNUP/images/profilePhoto.png';
}

// worker count
$wcount = "SELECT COUNT(*) as worker_count FROM users WHERE role='worker' AND isHired=0";
$result = $conn->query($wcount);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $workerCount = $row['worker_count'];
} else {
    $workerCount = 0;
}

// fetching workers who are not hired
$res = mysqli_query($conn, "SELECT id, profimg, firstname, middlename, lastname, specialty FROM users WHERE role='worker' AND isHired=0");
$numrows = mysqli_num_rows($res);
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Bootstrap Icon -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLa+naA4r59gqGU6EGGJnJXn/tWtIaxVXMxm0" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

   <title>WORKS | We find works</title>
   <link rel="icon" href="../images/logo.png">
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1"> 
   <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>

<!-- header section starts  -->

<header>
   <a href="#home" class="xx"><img src="../images/logoworker.png" height="50" width="50"> | WORKS</a>
   <nav class="navbar navbar-expand-md">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navigation">
         <span class="navbar-toggler-icon custom-hamburger"></span>
      </button>
      <div class="collapse navbar-collapse" id="main-navigation">
         <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
               <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-bars"></i>
               </a>
               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <!-- Profile section at the top -->
                  <div class="dropdown-item profile-section">
                     <img src="<?php echo $profile_photo_path; ?>" alt="Profile Photo" class="profile-photo">
                     <a href="profileEmployer.php">PROFILE</a>
                  </div>
                  <div class="dropdown-divider"></div>
                  <!-- Other navigation items -->
                  <a class="dropdown-item" href="#home">HOME</a>
                  <a class="dropdown-item" href="workerlist.php">WORKERS</a>
                  <a class="dropdown-item" href="#about">ABOUT US</a>
                  <a class="dropdown-item" href="#contact">INQUIRIES</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="../../!SIGNUP/source/logout.php"><i class="bi bi-box-arrow-left pe-3 fs-4" id="logouticon"></i>LOGOUT</a>
               </div>
            </li>
         </ul>
      </div>
   </nav>
</header>

<!-- header section ends -->

<!-- home section starts  -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
<!-- Content -->
<br><br><br><br><br><br>
<div class="worker-section">
  <div class="worker-header">AVAILABLE WORKERS (<?php echo $workerCount; ?>)</div>
  <div class="worker-container">
    <?php
      while ($worker = mysqli_fetch_assoc($res)) {
        echo '
        <div class="worker-card">
          <img src="../../!SIGNUP/uploads/' . $worker['profimg'] . '" class="card-img-top" alt="Worker Photo">

            <div class="worker-details">
              <h5>' . $worker['firstname'] . ' ' . $worker['middlename'] . ' ' . $worker['lastname'] . '</h5>
              <a>Specialty: ' . $worker['specialty'] . '</a>
            </div>

            <div class="buttons">
              <a href="' . $worker['hire_link'] . '" class="hire">Hire</a>
              <a href="' . $worker['message_link'] . '" class="message">Message</a>
              <a href="workerProfile.php?id=' . $worker['id'] . '" class="profile">Profile</a>
            </div>
        </div>
        ';
      }
    ?>
  </div>
</div>
<!-- home section ends -->
</body>
</html>
