<?php



    /*

        This PHP code fetches the users data

        from the users table in the database.

    */



    include '../connection.php';



    $user = $_POST['email'];

    $sql = "SELECT * FROM users WHERE `email` = '$user'";



    $result = mysqli_query($conn, $sql);

    while($rows = mysqli_fetch_array($result)) {

        $data['firstname'] = $rows['firstname'];

        $data['middlename'] = $rows['middlename'];

        $data['lastname'] = $rows['lastname'];

        $data['birthdate'] = $rows['birthday'];

        $data['email'] = $rows['email'];

        $data['contact'] = $rows['contact'];

        $data['password'] = $rows['password'];

        $data['role'] = $rows['role'];

        $data['image'] = $rows['image'];

    }



    echo json_encode($data);

?>