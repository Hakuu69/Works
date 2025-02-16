<?php



    /*

        This PHP code updates the changes made with the

        users information.

    */



    include '../connection.php';



    $user = $_POST['user'];

    $firstname = $_POST['firstname'];

    $middlename = $_POST['middlename'];

    $lastname = $_POST['lastname'];

    $birthdate = $_POST['bdate'];

    $email = $_POST['email'];

    $contact = $_POST['contact'];

    $password = $_POST['password'];

    $role = $_POST['role'];

    $fnm = $_FILES['image']['name'];



    $tm = md5(time());



    if($fnm == "") {

        $sql = "UPDATE users SET 

            firstname = '$firstname',

            middlename = '$middlename',

            lastname = '$lastname',

            birthday = '$birthdate',

            email = '$email',

            contact = '$contact',

            `password` = '$password',

            `role` = '$role' 

        WHERE `email` = '$user'";



        mysqli_query($conn, $sql);

    } else {

        $dst = "./../uploads/".$tm.$fnm;

        $dst1 = "../uploads/".$tm.$fnm;



        move_uploaded_file($_FILES['image']['tmp_name'], $dst);



        $sql = "UPDATE users SET 

            firstname = '$firstname',

            middlename = '$middlename',

            lastname = '$lastname',

            birthday = '$birthdate',

            email = '$email',

            contact = '$contact',

            `password` = '$password',

            `role` = '$role',

            `image` = '$dst1' 

        WHERE `email` = '$user'";



        mysqli_query($conn, $sql);

    }

?>