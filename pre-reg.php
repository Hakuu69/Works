<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join as Employer or Worker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f8f8f8;
        }
        .container {
            margin: 100px auto;
            width: 50%;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        .option {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        .option a {
            border: 2px solid #ccc;
            padding: 20px;
            text-decoration: none;
            color: black;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 200px;
            font-size: 16px;
            transition: 0.3s;
        }
        .option a:hover {
            border-color: #1400a8;
            background: #E8F5E9;
        }
        .btn {
            background-color: #1400a8;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 75%;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        a {
            text-decoration: none;
            color: #1400a8;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Join as an employer or worker</h2>
        
        <div class="option">
            <a href="../Works/!SIGNUP/source/employerReg.php">I'm an employer, looking for workers</a>
            <a href="../Works/!SIGNUP/source/workerReg.php">I'm a worker, looking for employers</a>
        </div>

        <a href="../Works/!SIGNUP/source/login.php" class="btn"> Log In</a>
    </div>

</body>
</html>
