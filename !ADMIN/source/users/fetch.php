<?php



    /*

        This PHP code fetches the users data

        from the users table in the database.

    */

    include '../connection.php';

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-Type: application/json');

    $user = $_POST['email'];
    $sql = "SELECT * FROM users WHERE `email` = '$user'";
    $result = mysqli_query($conn, $sql);

    $data = [];
    if ($result) {
        if(mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_array($result)) {
                $data['firstname'] = $rows['firstname'];
                $data['middlename'] = $rows['middlename'];
                $data['lastname'] = $rows['lastname'];
                $data['birthdate'] = $rows['birthday'];
                $data['email'] = $rows['email'];
                $data['contact'] = $rows['contact'];
                $data['password'] = $rows['password'];
                $data['role'] = $rows['role'];
                // Use relative path for the image
                $data['image'] = isset($rows['profimg']) ? '/Works/!SIGNUP/uploads/' . $rows['profimg'] : null;
            }
            echo json_encode($data);
        } else {
            echo json_encode(["error" => "No data found"]);
        }
    } else {
        echo json_encode(["error" => mysqli_error($conn)]);
    }
?>