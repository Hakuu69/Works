<?php

    /*
        This page is where the admin can edit or remove
        a user from the database.
    */

    // Start session
    session_start();

    include '../connection.php';

    // Get users table
    $res = mysqli_query($conn, "SELECT * from users");
    $numrows = mysqli_num_rows($res);

    if(isset($_SESSION['id']) && isset($_SESSION['username'])) {

       $firstname = $_SESSION['firstname'];

?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <!-- Page title and meta tags -->
        <title>JoyBoy | Edit or Remove Users</title>
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
            <div class = "row px-3 py-3" id = "main" style="background-color: rgb(255, 192, 44);">

                <!-- Navigation -->
                <div class = "col-2 px-3 py-5 h-100" id = "left" style="background-color: rgb(255, 192, 44);">
                    <div class = "navbar-brand">
                        <img src = "../../images/logo.png" alt = "" height = "50" width = "140">
                        <span class = "align-center fs-5"></span> 
                    </div>

                    <ul class = "navbar-nav h-100 fw-bold d-flex vstack ps-2 pt-5 fs-6">
                        <li class = "nav-item d-flex py-3 rounded-pill">
                            <a class = "nav-link" href = "../dashboard.php"><i class="bi bi-clipboard-data px-3 fs-4"></i>Dashboard</a>
                        </li>

                        <li class = "nav-item py-3">
                            <div class = "d-flex">
                                <button type = "button" class = "btn btn-link fw-bold fs-6" id = "p-button">
                                    <i class="bi bi-box pe-4 fs-4"></i>Product Maintenance
                                </button>
                            </div>
                            <div id = "p-maintenance" class = "d-flex vstack ps-2">
                                <a class = "nav-link py-4" href ="../products/addproduct.php"><i class="bi bi-plus-circle px-2"></i>Add Products</a>
                                <a class = "nav-link py-4" href = "../products/editproduct.php"><i class="bi bi-pencil-square px-2"></i>Edit or Remove Products</a>
                                <a class = "nav-link py-4" href = "../products/allproduct.php"><i class="bi bi-card-list px-2"></i>All Products</a>
                            </div>
                        </li>

                        <li class = "nav-item py-3">
                            <div class = "d-flex">
                                <button type = "button" class = "btn btn-link fw-bold fs-6" id = "u-button">
                                    <i class="bi bi-people pe-4 fs-4"></i>User Maintenance
                                </button>
                            </div>
                            
                            <div id = "u-maintenance" class = "d-flex vstack ps-2">
                                <a class = "nav-link py-4" href ="adduser.php"><i class="bi bi-plus-circle px-2"></i>Add Users</a>
                                <a class = "nav-link py-4 rounded-pill" id = "active" href = "edituser.php"><i class="bi bi-pencil-square px-2"></i>Edit or Remove Users</a>
                                <a class = "nav-link py-4" href = "alluser.php"><i class="bi bi-card-list px-2"></i>All Users</a>
                            </div>
                        </li>
                        <li class = "nav-item d-flex pb-5" id = "logout">
                            <a class = "nav-link fw-bold fs-6" href = "../../../Login/source/logout.php"><i class="bi bi-box-arrow-left pe-3 fs-4"></i>Logout</a>
                        </li>
                    </ul>
                </div>

                <!-- Content -->
                <div class = "col-10 px-5 py-5 rounded-4" id = "right">
                    <div class = "d-flex justify-content-between" id = "title">
                        <div class = "d-flex align-self-center">
                            <h5 class = "fs-3 fw-bold py-1 pe-3" style = "font-family: 'Alexandria', sans-serif; color: #6F5B3E;">EDIT OR REMOVE USERS</h5>
                            <select class = "shadow-none rounded-pill align-self-center px-3" name = "selectedEdit" id = "selectedEdit">
                                <option selected disabled>Choose user to edit or remove</option>
                                <?php
                                    if($numrows == 0) {
                                        // Redirect user to the add user page if the users table is empty
                                        ?><script>alert("No user data to edit."); window.location.href = "adduser.php";</script><?php
                                    } else {
                                        while($row = mysqli_fetch_array($res)) {
                                            // Show the usernames of the users as options for the dropdown list
                                            ?> <option><?php echo $row["username"];?></option>
                                        <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <span class = "small align-self-center" id = "datetime"></span>
                    </div>

                    <form class = "row needs-validation pt-3 w-100 d-flex align-items-center justify-content-center" method = "post" enctype = "multipart/form-data" id = "user" novalidate>
                        <div class = "col-6 px-5 pt-3 pb-1 d-flex justify-content-center vstack h-100">
                            <div class = "form-group row">
                                <div class = "col-6">
                                    <label for = "firstname" class = "form-label">First Name</label>
                                    <input type = "text" class = "form-control shadow-none rounded-pill" name = "firstname" placeholder = "e.g. Juan" style="color:black;" id = "fname" required>
                                    <div class = "invalid-feedback">Please enter user first name.</div>
                                </div>
                                <div class = "col-6">
                                    <label for = "middlename" class = "form-label">Middle Name</label>
                                    <input type = "text" class = "form-control shadow-none rounded-pill" name = "middlename" placeholder = "e.g. Dela Rosa" style="color:black;" id = "mname" required>
                                    <div class = "invalid-feedback">Please enter user middle name.</div>
                                </div>
                            </div>

                            <div class = "form-group pt-4">
                                <label for = "lastname" class = "form-label">Last Name</label>
                                <input type = "text" class = "form-control shadow-none rounded-pill" name = "lastname" placeholder = "e.g. Dela Cruz" style="color:black;" id = "lname" required>
                                <div class = "invalid-feedback">Please enter user last name.</div>
                            </div>

                            <div class = "form-group row pt-4">
                                <div class = "col-6">
                                    <label for = "bdate" class = "form-label">Birthdate</label>
                                    <div class = "md-form md-outline input-with-post-icon datepicker">
                                        <input type = "date" class = "form-control shadow-none rounded-pill" name = "bdate" placeholder = "Select date" style="color:black;" id = "bdate" required>
                                        <div class = "invalid-feedback">Please enter user birthdate.</div>
                                    </div>
                                </div>
                                <div class = "col-6">
                                    <label for = "contact" class = "form-label">Contact Number</label>
                                    <input type = "number" class = "form-control shadow-none rounded-pill" name = "contact" placeholder = "09123456789" style="color:black;" id = "contact" required>
                                    <div class = "invalid-feedback">Please enter user contact.</div>
                                </div>
                            </div>

                            <div class = "form-group pt-4">
                                <label for = "email" class = "form-label">Email Address</label>
                                <input type = "email" class = "form-control shadow-none rounded-pill" name = "email" placeholder = "e.g. juan@your-domain.com" style="color:black;" id = "email" required>
                                <div class = "invalid-feedback">Please enter a valid email address.</div>
                            </div>
                                
                            <div class = "form-group pt-4">
                                <label for = "username" class = "form-label">Username</label>
                                <input type = "text" class = "form-control shadow-none rounded-pill" name = "username" placeholder = "Enter username" style="color:black;" id = "username" required>
                                <div class = "invalid-feedback">Please enter username.</div>
                            </div>

                            <div class = "form-group pt-4">
                                <label for = "password" class = "form-label">Password</label>
                                <input type = "password" class = "form-control shadow-none rounded-pill" name = "password" placeholder = "Enter password" style="color:black;" id = "password" required>
                                <div class = "invalid-feedback">Please enter password.</div>
                            </div>
                            <div class = "row mt-3">
                                    <div class = "col-6 d-flex justify-content-center">
                                        <button type = "submit" name = "update" class = "btn btn-primary shadow-lg rounded-pill w-100" id = "updateuser">Update</button>
                                    </div>
                                    <div class = "col-6 d-flex justify-content-center">
                                        <button type = "button" name = "delete" class = "btn btn-primary shadow-lg rounded-pill w-100" id = "deleteuser">Delete</button>
                                    </div>
                                </div>
                        </div>
                        
                        <div class = "col-6 pt-3 d-flex vstack justify-content-center">
                            <img src = "../../images/insertimg.png" class = "rounded-4 align-self-center" alt = "File Uploaded" id = "useruploaded">
                            <div class = "form-group pt-4">
                                <label for = "image" class = "form-label">User Image</label>
                                <input accept = "image/*" type = "file" class = "form-control shadow-none rounded-pill" name = "image" style="color:black;" id = "upload">
                                <div class = "invalid-feedback">Please add user image</div>
                            </div>

                            <div class = "form-group pt-4">
                                <label for = "role" class = "form-label">Role</label>
                                <select class = "form-control form-select shadow-none rounded-pill" name = "role" style="color:black;" id = "role" required>
                                    <option value = "admin" style="color:black;">Admin</option>
                                    <option value = "user"  style="color:black;">User</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
    } else {
        // Redirect to the Login page if the user is not logged in.
        header("Location: ../../../Login/source/login.php");
        exit();
    }
?>