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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal Review</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; margin: 0; padding: 0; }
        .header { background-color:rgb(46, 114, 160); color: white; padding: 15px; text-align: center; font-size: 20px; }
        .container { width: 80%; margin: auto; }
        .proposal { background: white; padding: 15px; margin: 10px 0; border-radius: 5px; box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1); }
        .proposal h3 { margin: 0; color: #0056b3; }
        .proposal p { margin: 5px 0; color: #555; }
        .actions { margin-top: 10px; }
        .btn { padding: 8px 12px; border: none; border-radius: 3px; cursor: pointer; }
        .btn-message { background-color: #0056b3; color: white; }
        .btn-hire { background-color: #004494; color: white; }
        .btn-profile { background-color: #004494; color: white; }
    </style>
</head>
<body>
    <div class="header">AVAILABLE EMPLOYERS (<?php echo count($proposals); ?>)</div>
    <div class="container">
        <?php foreach ($proposals as $proposal) : ?>
            <div class="proposal">
                <h3><?php echo $proposal['name']; ?></h3>
                <p><strong>Location:</strong> <?php echo $proposal['location']; ?></p>
                <p><?php echo $proposal['description']; ?></p>
                <div class="actions">
                    <button class="btn btn-message">Message</button>
                    <br></br>
                    <button class="btn btn-hire">Hire</button>
                    <br></br>
                    <button class="btn btn-profile">Profile</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>