<?php



    /*

        This is the page where the admin can

        view all the users' information stored

        on the database.

    */



    // Start session

    session_start();



    include '../connection.php';



    // Get products table

    $res = mysqli_query($conn, "SELECT * from users");

    $numrows = mysqli_num_rows($res);



    if(isset($_SESSION['id']) && isset($_SESSION['email'])) {



       $firstname = $_SESSION['firstname'];



?>



<!DOCTYPE html>

<html lang = "en">

    <head>

        <!-- Page title and meta tags -->

        <title>Works | All Users</title>

        <meta charset = "utf-8">

        <meta name = "viewport" content = "width=device-width, initial-scale=1">



        <!-- Icon -->

        <link rel = "icon" href = "../../images/LogoTitle.png">



        <!-- JQuery Library -->

        <script src = "https://code.jquery.com/jquery-3.6.0.js" type = "text/javascript"></script>

        <script src = "https://code.jquery.com/ui/1.13.2/jquery-ui.js" type = "text/javascript"></script>



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

            crossorigin="anonymous">

        </script>



        <!-- Bootstrap Icon -->

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">



        <!-- Google Fonts -->

        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@900&family=Poppins:wght@400;700&display=swap" rel="stylesheet">



        <!-- Custom JS -->

        <script src = "user.js" type = "text/javascript"></script>



        <!-- Custom CSS -->

        <link rel = "stylesheet" type = "text/css" href = "../styles.css"> 

    </head>



    <body>

        <div class = "container-fluid">

            <div class = "row px-3 py-3" id = "main" style="background-color: rgb(0, 183, 255);">



                <!-- Navigation -->

                <div class = "col-2 px-3 py-5 h-100" id = "left" style="background-color: rgb(0, 183, 255);">

                    <div class = "navbar-brand">

                        <img src = "../../images/logoworker.png" alt = "" height = "140" width = "140">

                        <span class = "align-center fs-5"></span> 

                    </div>



                    <ul class = "navbar-nav h-100 fw-bold d-flex vstack ps-2 pt-5 fs-6">

                        <li class = "nav-item d-flex py-3 rounded-pill">

                            <a class = "nav-link" href = "../dashboard.php"><i class="bi bi-clipboard-data px-3 fs-4"></i>Dashboard</a>

                        </li>

                        <li class = "nav-item py-3">

                            <div class = "d-flex">

                                <button type = "button" class = "btn btn-link fw-bold fs-6" id = "u-button">

                                    <i class="bi bi-people pe-4 fs-4"></i>User Maintenance

                                </button>

                            </div>

                            

                            <div id = "u-maintenance" class = "d-flex vstack ps-2">

                                <a class = "nav-link py-4" href ="adduser.php"><i class="bi bi-plus-circle px-2"></i>Add Users</a>

                                <a class = "nav-link py-4" href = "edituser.php"><i class="bi bi-pencil-square px-2"></i>Edit or Remove Users</a>

                                <a class = "nav-link py-4 rounded-pill" id = "active" href = "alluser.php"><i class="bi bi-card-list px-2"></i>All Users</a>

                            </div>

                        </li>

                        <li class = "nav-item d-flex pb-5" id = "logout">

                            <a class = "nav-link fw-bold fs-6" href = "../../../!SIGNUP/source/logout.php"><i class="bi bi-box-arrow-left pe-3 fs-4"></i>Logout</a>

                        </li>

                    </ul>

                </div>



                <!-- Content -->

                <div class = "col-10 px-5 py-5 rounded-4" id = "right">

                    <div class = "d-flex justify-content-between" id = "title">

                        <div class = "d-flex align-self-center">

                            <h5 class = "fs-3 fw-bold py-1 pe-3" style = "font-family: 'Alexandria', sans-serif; color: #6F5B3E;">ALL USERS</h5>

                        </div>

                        <span class = "small align-self-center" id = "datetime"></span>

                    </div>



                    <?php

                        if($numrows == 0) {

                            // Redirect the user to the add user page if the users table is empty.

                            ?><script>alert("No users to show."); window.location.href = "adduser.php";</script><?php

                        } else {

                            ?>

                            <div class = "row mt-3" id = "tablecontainer">

                                <table class = "table table-striped ms-2">

                                    <thead class = "text-center">

                                        <tr>

                                            <th>ID</th>

                                            <th>Image</th>

                                            <th>First Name</th>

                                            <th>Middle Name</th>

                                            <th>Last Name</th>

                                            <th>Birthday</th>

                                            <th>Email</th>

                                            <th>Contact</th>

                                            <th>Password</th>

                                            <th>Role</th>

                                        </tr>

                                    </thead>

                                    <tbody class = "text-center">

                                        <?php

                                            // Show the users information in the table

                                            while($row = mysqli_fetch_array($res)) {

                                                echo "<tr>";

                                                echo "<td>"; echo $row["id"]; echo "</td>";

                                                echo "<td>"; ?><img src = "<?php echo $row["profimg"];?>" height = "100" width = "100"><?php echo "</td>";

                                                echo "<td>"; echo $row["firstname"]; echo "</td>";

                                                echo "<td>"; echo $row["middlename"]; echo "</td>";

                                                echo "<td>"; echo $row["lastname"]; echo "</td>";

                                                echo "<td>"; echo $row["birthday"]; echo "</td>";

                                                echo "<td>"; echo $row["email"]; echo "</td>";

                                                echo "<td>"; echo $row["contact"]; echo "</td>";

                                                echo "<td>"; echo $row["password"]; echo "</td>";

                                                echo "<td>"; echo $row["role"]; echo "</td>";

                                                echo "</tr>";

                                            }

                                        ?>

                                    </tbody>

                                </table>

                            </div>

                                

                            <?php

                        }

                    ?>

                </div>

            </div>

        </div>

    </body>

</html>



<?php

    } else {

        // Redirect to the Login page if the user is not logged in.

        header("Location: ../../../!SIGNUP/source/login.php");

        exit();

    }

?>