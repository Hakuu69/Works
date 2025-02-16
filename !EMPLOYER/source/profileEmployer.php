<!DOCTYPE html>
<?php
$proposals = [
    [
        'name' => 'Marketing Strategist, B2B, B2C, Digital Marketing.',
        'location' => 'South Africa',
        'description' => 'Hi, I have two years of experience doing market and quantitative research...'
    ],
    [
        'name' => 'Consultant with proven track of success in B2B & Consumer research',
        'location' => 'Bulgaria',
        'description' => 'I’m a professional researcher and market advisor who just recently joined Upwork...'
    ],
    [
        'name' => 'Experienced Market Researcher',
        'location' => 'Kenya',
        'description' => 'Expert in company research, consumer behavior analysis, and data interpretation...'
    ]
];
?>
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
  <a href="#home" class="xx"><img src="../images/logo.png" height="50" width="50"> | WORKS</a>
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
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; margin: 0; padding: 0; }
        .header { background-color: #007bff; color: white; padding: 15px; text-align: center; font-size: 20px; }
        .container { width: 80%; margin: auto; }
        .proposal { background: white; padding: 15px; margin: 10px 0; border-radius: 5px; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1); }
        .proposal h3 { margin: 0; color: #0056b3; }
        .proposal p { margin: 5px 0; color: #555; }
        .actions { margin-top: 10px; }
        .btn { padding: 8px 12px; border: none; border-radius: 3px; cursor: pointer; }
        .btn-message { background-color: #0056b3; color: white; }
        .btn-hire { background-color: #004494; color: white; }
    </style>
</head>
<body>
    <br><br><br><br><br><br>
    <div class="header">AVAILABLE WORKERS (<?php echo count($proposals); ?>)</div>
    <div class="container">
        <?php foreach ($proposals as $proposal) : ?>
            <div class="proposal">
                <h3><?php echo $proposal['name']; ?></h3>
                <p><strong>Location:</strong> <?php echo $proposal['location']; ?></p>
                <p><?php echo $proposal['description']; ?></p>
                <div class="actions">
                    <button class="btn btn-message">Message</button>
                    <button class="btn btn-hire">Hire</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<!-- home section ends -->



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
                    <h5 class = "fs-6 fw-semibold">HELPFUL LINKS</h5>
                    <a class = "small" href = "#home">Home</a>

                    <a class = "small" href = "#about">About</a>
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