<?php

    /*

        This is the Dashboard page where the admin can see a summarized report

        for the employer and the workers within the system.

    */



    // Start session

    session_start();



    include 'connection.php';


    // workers sql query

    $adminsql = "SELECT * FROM `users` WHERE role = 'admin'";

    $employersql = "SELECT * FROM `users` WHERE role = 'employer'";

    $workersql = "SELECT * FROM `users` WHERE role = 'worker'";

    $adminres = mysqli_query($conn, $adminsql);

    $employerres = mysqli_query($conn, $employersql);

    $workerres = mysqli_query($conn, $workersql);


    // Get number of workers

    $numadmin = mysqli_num_rows($adminres);

    $numemployer = mysqli_num_rows($employerres);
    
    $numworker = mysqli_num_rows($workerres);

    if(isset($_SESSION['id']) && isset($_SESSION['email'])) {



       $firstname = $_SESSION['firstname'];



?>



<!DOCTYPE html>

<html lang = "en">

    <head>

        <!-- Page title and meta tags -->

        <title>JoyBoy | Dashboard</title>

        <meta charset = "utf-8">

        <meta name = "viewport" content = "width=device-width, initial-scale=1">



        <!-- Icon -->

        <link rel = "icon" href = "../images/LogoTitle.png">



        <!-- JQuery Library -->

        <script src = "https://code.jquery.com/jquery-3.6.0.js" type = "text/javascript"></script>

        <script src = "https://code.jquery.com/ui/1.13`.2/jquery-ui.js" type = "text/javascript"></script>



        <!-- dayjs to get current Date and Time -->

        <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>



        <!-- chart.js for the creation of the charts -->

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



        <!-- Bootstrap 5.2.3 -->

        <link

            href = "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"

            rel = "stylesheet" integrity = "sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"

            crossorigin = "anonymous">

        <script 

            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 

            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" 

            crossorigin="anonymous" type = "text/javascript">

        </script>



        <!-- Bootstrap Icon -->

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">



        <!-- Google Fonts -->

        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@900&family=Poppins:wght@400;700&display=swap" rel="stylesheet">



        <!-- Custom JS -->

        <script src = "script.js" type = "text/javascript"></script>



        <!-- Custom CSS -->

        <link rel = "stylesheet" type = "text/css" href = "styles.css"> 

    </head>



    <body>

        <div class = "container-fluid">

            <div class = "row px-3 py-3" id = "main" style="background-color: rgb(255, 192, 44);">



                <!-- Navigation -->

                <div class = "col-2 px-3 py-5 h-100" id = "left" style="background-color: rgb(255, 192, 44);">

                    <div class = "navbar-brand">

                        <img src = "../images/logo.png" alt = "JoyBoy" height = "50" width = "140">

                        <span class = "align-center fs-5"> </span> 

                    </div>



                    <ul class = "navbar-nav h-100 fw-bold d-flex vstack ps-2 pt-5 fs-6">

                        <li class = "nav-item d-flex py-3 rounded-pill" id = "active">

                            <a class = "nav-link" href = "dashboard.php"><i class="bi bi-clipboard-data px-3 fs-4"></i>Dashboard</a>

                        </li>


                        <li class = "nav-item py-3">

                            <div class = "d-flex">

                                <button type = "button" class = "btn btn-link fw-bold fs-6" id = "e-button">

                                    <i class="bi bi-people pe-4 fs-4"></i>User Maintenance
                                </button>

                            </div>

                            

                            <div id = "e-maintenance" class = "d-flex vstack ps-2">

                                <a class = "nav-link py-4" href ="users/adduser.php"><i class="bi bi-plus-circle px-2"></i>Add Users</a>

                                <a class = "nav-link py-4" href = "users/edituser.php"><i class="bi bi-pencil-square px-2"></i>Edit or Remove Users</a>

                                <a class = "nav-link py-4" href = "users/alluser.php"><i class="bi bi-card-list px-2"></i>All Users</a>

                            </div>

                        </li>



                        

                        <li class = "nav-item d-flex pb-5" id = "logout">

                            <a class = "nav-link fw-bold fs-6" href = "../../!SIGNUP/source/logout.php"><i class="bi bi-box-arrow-left pe-3 fs-4"></i>Logout</a>

                        </li>

                    </ul>

                </div>



                <!-- Content -->

                <div class = "col-10 px-5 py-5 rounded-4" id = "right">

                    <div class = "d-flex justify-content-between" id = "title">

                        <h5 class = "fs-3 fw-bold py-1" style = "font-family: 'Alexandria', sans-serif; color: #6F5B3E;">DASHBOARD</h5>

                        <span class = "small align-self-center" id = "datetime"></span>

                    </div>



                    <!-- Welcome message and statistics -->

                    <div class = "row">

                        <span class = "fs-4 fw-bold pt-4" id = "welcome">Welcome,

                            <!-- Get the First Name of the worker -->

                            <?php

                                echo $firstname;

                            ?>!

                        </span>

                        <span class = "small pt-2">Take a look at these numbers</span>

                        

                        <div class = "col-4 py-4">

                            <div class = "card" style = "background-color: #C4AE78; background-image: var(--bs-gradient);">

                                <div class = "row g-0">

                                    <div class = "col-6 align-self-end">

                                        <img src = "../images/employer.png" class = "rounded-start" alt = "employer" height = "200">

                                    </div>

                                    <div class = "col-6 align-self-center">

                                        <div class = "card-body text-end">

                                            <h5 class = "fw-bold fs-3 card-title">

                                                <!-- Get the Total Number of Employer -->

                                                <?php

                                                    echo $numemployer;

                                                ?>

                                            </h5>

                                            <p class = "card-text fs-6">Number of Employers</p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class = "col-4 py-4">

                            <div class = "card" style = "background-color: #C4AE78; background-image: var(--bs-gradient);">

                                <div class = "row g-0">

                                    <div class = "col-6 align-self-end">

                                        <img src = "../images/worker.png" class = "rounded-start ps-2" alt = "workers" height = "200">

                                    </div>

                                    <div class = "col-6 align-self-center">

                                        <div class = "card-body text-end">

                                            <h5 class = "fw-bold fs-3 card-title">

                                                <!-- Get the Total Number of Workers -->

                                                <?php

                                                    echo $numworker;

                                                ?>

                                            </h5>

                                            <p class = "card-text fs-6">Number of Workers</p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class = "col-4 py-4">

                            <div class = "card" style = "background-color: #C4AE78; background-image: var(--bs-gradient);">

                                <div class = "row g-0">

                                    <div class = "col-6 align-self-end">

                                        <img src = "../images/admin.png" class = "rounded-start ps-2" alt = "Admins" height = "200">

                                    </div>

                                    <div class = "col-6 align-self-center">

                                        <div class = "card-body text-end">

                                            <h5 class = "fw-bold fs-3 card-title">

                                                <!-- Get the Total Number of Admins -->

                                                <?php

                                                    echo $numadmin;

                                                ?>

                                            </h5>

                                            <p class = "card-text fs-6">Number of Admins</p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>



                    <!-- Graphs -->

                    <div class = "row">

                        <span class = "fs-4 fw-bold pt-4">Some graphs to help you</span>

                        <span class = "small pt-2">Examine these graphs and gain some insights</span>


                        <div class = "col-6 py-4">

                        <canvas id = "userchart"></canvas>

                            <script>

                                // Doughnut chart for the workers

                                new Chart($("#userchart"), {

                                    type: 'doughnut',

                                    data: {

                                        labels: [

                                            'Admins',

                                            'Employers',

                                            'Workers'

                                        ],



                                        datasets: [{

                                            label: 'User Roles',

                                            data: [

                                                <?php echo $numadmin ?>,

                                                <?php echo $numemployer ?>,
                                                
                                                <?php echo $numworker ?>

                                            ],

                                            backgroundColor: [

                                                '#FAD4D4',

                                                '#33CCFF',

                                                '#99CCFF'

                                            ],

                                            hoverOffset: 4

                                        }]

                                    },

                                    options: {

                                        plugins: {

                                            title: {

                                                display: true,

                                                text: 'User Roles'

                                            }

                                        },



                                        maintainAspectRatio: false,

                                    }

                                });

                            </script>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </body>

</html>



<?php

    } else {

        // Redirect to Login page if worker is not logged in.

        header("Location: ../../!SIGNUP/source/login.php");

        exit();

    }

?>