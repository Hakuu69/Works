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
<body>

<!-- header section starts  -->

    <header>
        <a href="../../!EMPLOYER/source/homeEmployer.php#home" class="xx"><img src="../images/logoworker.png" height="50" width="50"> | WORKS</a>
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
<section class="home" id="home">
    <div class="content">
        <h3><b style="color:white"></b></h3>
        <h5><i style="color:white"></i></h5>
        <a href="website/workerlist.php" class="btn">Find a Worker</a>
    </div>
</section>
<br>
<!-- home section ends -->
<!-- about section starts  -->
<section class="about" id="about">
    <div class="row">

        <div class="about-img">
            <img src="../images/qualityCheck.png" width="275" alt="" class="img-fluid">
          </div>

        <div class="content">
            <h3>We Help Our Fellow Blue Collar Workers An Alternative Way To Find A Job</h3>
            <p>We are dedicated to revolutionizing the job search experience for blue collar workers. Recognizing the challenges often faced by individuals in the blue collar industry when seeking employment, we strive to provide an alternative, more efficient, and empowering solution.
            <br><br>
            Our mission is simple: to assist our fellow blue collar workers in finding meaningful employment opportunities that align with their skills, preferences, and aspirations. Whether you're a skilled tradesperson, a seasoned laborer, or an aspiring professional in the blue collar sector, we're here to support you every step of the way.
            <br><br>
            Through our innovative platform, we offer a diverse range of job listings tailored specifically to blue collar professions. From construction and manufacturing to transportation and maintenance, we connect job seekers with reputable employers seeking their valuable expertise.
            <br><br>
            What sets us apart is our commitment to understanding the unique needs of blue collar workers. We recognize the importance of steady employment, fair compensation, and a supportive work environment. That's why we prioritize transparency, integrity, and accessibility in everything we do.
          </p>
        </div>
    </div>
</section>
<section class="services section-padding" >
          <div class="container">
              <div class="row align-content-md-center"> 
                  <div class="col-md-12">
                    <div class="col-lg-12 text-lg-start ps-5 pb-5">
                        <div class="row col-sm-12">
                            <div class="section_title-divider col-lg-1 col-md-1 col-sm-6 mt-3"></div>
                            <div class="col-lg-11 col-md-11 col-sm-6">
                                <center><h1 style="font-weight: 600; font-family: Verdana, Geneva, Tahoma, sans-serif;">- AT YOUR SERVICE -</h1> </center>
                            </div>
                        </div>
                    </div>

                <div class="row">
                    <div class="col-md-4 text-center featured">
                        <img src="../images/logo.png" width="" height="270" alt="">
                        <br><br>
                            <h5>Carl Patrick Mallari - <strong>Member</strong></h5>
                        <br>
                          <p style="font-size: 11px; color:black;">3rd Year at AMA Computer College</p>
                        
                    
                        <br><br>
                    </div>

                    <div class="col-md-4 text-center featured">
                        <img src="../images/logo.png" width="" height="270" alt="">
                        <br><br>
                            <h5>Jacob Salvador - <strong>Member</strong></h5>
                        <br>
                            <p style="font-size: 11px; color:black;">3rd Year at AMA Computer College</p>
                        
                    
                        <br><br>
                    </div>

                    <div class="col-md-4 text-center featured">
                        <img src="../images/logo.png" width="" height="270" alt="">
                        <br><br>
                            <h5>Yvan Balinan - <strong>Member</strong></h5>
                        
                        <p style="font-size: 11px; color:black;">3rd Year at AMA Computer College</p>
                        <br>
                    
                        <br><br>
                    </div>
                </section>  
<div class="row pb-5 pt-5" id="new">
        <hr>
        </div>
<!-- about section ends -->
<!-- contact section starts  -->
<section class="contact" id="contact">

    <h1 class="heading" style="font-weight: bold;">SENDS US A MESSAGE</h1>

    <div class="row">

        <form action=" a">
            <h4 style="color:black; font-weight: bold; font-family: Verdana, Geneva, Tahoma, sans-serif;">FULL NAME</h3><input type="text" placeholder="name" class="box">
            <h4 style="color:black; font-weight: bold; font-family: Verdana, Geneva, Tahoma, sans-serif;">EMAIL<h4><input type="email" placeholder="email" class="box">
            <h4 style="color:black; font-weight: bold; font-family: Verdana, Geneva, Tahoma, sans-serif;">CONTACT INFORMATION</h4><input type="number" placeholder="number" class="box">
            <h4 style="color:black; font-weight: bold; font-family: Verdana, Geneva, Tahoma, sans-serif;">CONCERN</h4><textarea name="" class="box" placeholder="message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" class="btn">
        </form>

        <div class="image">
            <img src="../images/homee.gif" alt="">
        </div>
    </div>
</section>
<br><br><br><br><br>
<!-- contact section ends -->

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