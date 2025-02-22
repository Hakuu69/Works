<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workers List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .navbar {
            width: 100%;
            background-color: #add8e6; /* Light blue color */
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar img {
            height: 40px;
        }
        .navbar h1 {
            margin: 0;
            font-size: 24px;
            margin-left: 40px; /* Move the word "LIST" slightly to the right */
        }
        .navbar .nav-buttons {
            display: flex;
            gap: 10px;
        }
        .navbar .nav-buttons a {
            padding: 10px 20px;
            background-color: #555;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.2s ease;
        }
        .navbar .nav-buttons a:hover {
            background-color: #777;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 20px;
        }
        .worker-card {
            display: flex;
            align-items: center;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }
        .worker-card:hover {
            transform: translateY(-5px);
        }
        .worker-card img {
            border-radius: 50%;
            margin-right: 20px;
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .worker-details {
            flex-grow: 1;
        }
        .buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .buttons a {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.2s ease;
        }
        .buttons .hire {
            background-color: #28a745;
        }
        .buttons .hire:hover {
            background-color: #218838;
        }
        .buttons .message {
            background-color: #007bff;
        }
        .buttons .message:hover {
            background-color: #0056b3;
        }
        .buttons .profile {
            background-color: #ffc107;
        }
        .buttons .profile:hover {
            background-color: #e0a800;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <img src="path_to_logo.jpg" alt="Logo">
        <h1>LIST</h1>
        <div class="nav-buttons">
            <a href="home.php">Home</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="container">
        <?php
        $workers = [
            ['name' => 'John Doe', 'position' => 'Developer', 'img' => 'images/logo.png', 'profile_link' => 'profile_page1.php', 'hire_link' => 'hire_page1.php', 'message_link' => 'message_page1.php'],
            ['name' => 'Jane Smith', 'position' => 'Designer', 'img' => 'images/logo.png', 'profile_link' => 'profile_page2.php', 'hire_link' => 'hire_page2.php', 'message_link' => 'message_page2.php'],
            ['name' => 'Mike Johnson', 'position' => 'Manager', 'img' => 'images/logo.png', 'profile_link' => 'profile_page3.php', 'hire_link' => 'hire_page3.php', 'message_link' => 'message_page3.php'],
        ];

        foreach ($workers as $worker) {
            echo '
            <div class="worker-card">
                <img src="' . $worker['img'] . '" alt="' . $worker['name'] . '">
                <div class="worker-details">
                    <h3>' . $worker['name'] . '</h3>
                    <p>' . $worker['position'] . '</p>
                </div>
                <div class="buttons">
                    <a href="' . $worker['hire_link'] . '" class="hire">Hire</a>
                    <a href="' . $worker['message_link'] . '" class="message">Message</a>
                    <a href="' . $worker['profile_link'] . '" class="profile">Profile</a>
                </div>
            </div>';
        }
        ?>
    </div>
</body>
</html>
