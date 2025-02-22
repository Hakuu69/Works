<?php
session_start();
include 'connection.php'; // Adjust the path as needed

// Check if user_id session variable is set
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    
    // Fetching user profile data
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $profile_photo = $row['profimg'];
        $profile_photo_path = '../../!SIGNUP/uploads/' . $profile_photo;


        // Fetch and split the specialty into an array
        $specialty = explode(',', $row['specialty']);
    } else {
        echo "User not found";
        exit;
    }
} else {
    echo "User ID not set";
    exit;
}
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
   <link rel = "icon" href = "../images/logo.png">
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1"> 
   <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body class="profile-background">

<!-- header section starts  -->

<header>
        <a href="../../!WORKER/source/homeWorker.php#home" class="xx"><img src="../images/logoworker.png" height="50" width="50"> | WORKS</a>
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
                                <a href="profileWorker.php">PROFILE</a>
                            </div>
                            <div class="dropdown-divider"></div>
                            <!-- Other navigation items -->
                            <a class="dropdown-item" href="../../!WORKER/source/homeWorker.php">HOME</a>
                            <a class="dropdown-item" href="../../!WORKER/source/employerlist.php">EMPLOYERS</a>
                            <a class="dropdown-item" href="../../!WORKER/communication/messaging.php">MESSAGES</a>
                            <a class="dropdown-item" href="../../!WORKER/source/homeWorker.php#about">ABOUT US</a>
                            <a class="dropdown-item" href="../../!WORKER/source/homeWorker.php#contact">INQUIRIES</a>
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
<section class="" id="home">
    <div class="content">
        <br><br><br><br><br>
        <div class="header-container">
            <h1 class="profile-header">Profile</h1>
        </div>
    </div>
</section>
<br>
<!-- home section ends -->

<!-- Profile form -->
<div class="container">
    <form action="updateProfile.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="profimg">Profile Image</label>
            <input type="file" class="form-control" id="profimg" name="profimg" accept="image/*">
        </div>
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>" disabled>
        </div>
        <div class="form-group">
            <label for="middlename">Middle Name</label>
            <input type="text" class="form-control" id="middlename" name="middlename" value="<?php echo $row['middlename']; ?>" disabled>
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>" disabled>
        </div>
        <div class="form-group">
            <label for="birthday">Birthday</label>
            <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo $row['birthday']; ?>" disabled>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" disabled>
        </div>
        <div class="form-group">
            <label for="contact">Contact</label>
            <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $row['contact']; ?>">
        </div>
        <div class="form-group">
            <label for="specialty">Specialty</label><br>
            <input type="checkbox" id="welder" name="specialty[]" value="Welder" <?php if(in_array('Welder', $specialty)) echo 'checked'; ?>>
            <label for="welder">Welder</label><br>
            <input type="checkbox" id="mechanic" name="specialty[]" value="Mechanic" <?php if(in_array('Mechanic', $specialty)) echo 'checked'; ?>>
            <label for="mechanic">Mechanic</label><br>
            <input type="checkbox" id="electrician" name="specialty[]" value="Electrician" <?php if(in_array('Electrician', $specialty)) echo 'checked'; ?>>
            <label for="electrician">Electrician</label><br>
            <input type="checkbox" id="construction" name="specialty[]" value="Construction Worker" <?php if(in_array('Construction Worker', $specialty)) echo 'checked'; ?>>
            <label for="construction">Contstruction Worker</label><br>
        </div>
        <div class="form-group">
            <label for="resume">Resume</label>
            <input type="file" class="form-control" id="resume" name="resume" accept="image/*">
        </div>
        <!-- Add other editable fields here -->
        <button type="submit" class="btn btn-primary">Update Profile</button>
        <br><br><br>
    </form>
</div>

<!-- Footer -->
<footer class = "footer">
            <div class = "row">
                <div class = "col-lg-3 col-md-3 col-sm-12">
                    <h2 class = "fs-4" style = "font-family: 'Alexandria', sans-serif;">Works</h2>
                    <p class = "small">
                        Works Started as a small website to help our fellow blue collars workers in Tarlac City.
                        <br><br>
                        With limited resources 3 Students dared to create a blue collar website with minimal experience.
                    </p>
                </div>
                <div class = "col-lg-3 col-md-3 col-sm-12">
                    <h5 class = "fs-6 fw-semibold">CONTACT US</h5>
                    <p class = "small">
                        <i class = "bi bi-geo-alt"></i>&nbsp; 396,Calle Onse, Paraiso
                        <br>&nbsp; &nbsp; &nbsp; Tarlac City, Tarlac,
                        <br>&nbsp; &nbsp; &nbsp; Philippines
                        <br><i class = "bi bi-envelope"></i>&nbsp; osokcarl@gmail.com
                        <br><i class = "bi bi-telephone"></i>&nbsp; +639705318246
                    </p>
                </div>
                <div class = "col-lg-3 col-md-3 col-sm-12 vstack">
                </div>
                <div class = "col-lg-3 col-md-3 col-sm-12">
                    <h5 class = "fs-6 fw-semibold">HEAR NEWS FROM US</h5>
                    <p class = "small">
                        Subscribe to our monthly newsletter to receive news about
                        new updates to the website
                    </p><br>
                    <form class = "form-group needs-validation" novalidate>
                        <div class = "input-group">
                            <input type = "email" class = "form-control shadow-none rounded-pill" id = "email-footer" placeholder = "Your email address" required> 
                            <br><br>
                            <button class = "btn btn-primary px-2 rounded-pill shadow-none" type = "submit" id = "email-btn">Subscribe Now!</button>
                            <div class = "invalid-feedback">
                                Please provide a valid email address.
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class = "container-fluid row mt-4 pt-4 pb-3" id = "copyright">
                <div class = "col-6 text-start">
                    <p>&copy; 2024 Works | Blue Collar Website in Tarlac City</p>
                </div>
                <div class = "col-6 text-end">
                    <a href = "#facebook"><i class = "bi bi-facebook"></i></a>
                    <a href = "#twitter"><i class = "bi bi-twitter"></i></a>
                    <a href = "#instagram"><i class = "bi bi-instagram"></i></a>
                    <a href = "#youtube"><i class = "bi bi-youtube"></i></a>
                    <a href = "#linkedin"><i class = "bi bi-linkedin"></i></a>
                    <a href = "#pinterest"><i class = "bi bi-pinterest"></i></a>
                </div>
            </div>
        </footer> 
</body>
</html>