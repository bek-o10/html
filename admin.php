<?php 
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
    exit();
}
?>
<div class="robotmanku">
<a href="index.php" class="alohida"><img src="images/sala.png" class="ortaga" >Главная страница</a><br><br>
</div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #F4F4F4;
        }
    
        .alohida {
            text-decoration: none;
            color: #007BFF;
            padding: 10px;
        }
        .alohida:hover {
            background-color: #f0f0f0;
            border-radius: 8px;

        }
        .ortaga{
            width: 33px;
            position: relative;
            top: 13px;
            right: 10px;
        }

        nav {
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            padding: 10px;
            display: inline-block;
        }

        a:hover {
            background-color: #f0f0f0;
            border-radius: 5px;
        }

        form {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <nav>
        <?php
        $links = [
            'Carusel_qushish' => 'junatish/carusel.php',
            'Computer_qushish' => 'junatish/computer.php',
            'Mobile_qushish' => 'junatish/mobile.php',
            'Koknav_qushish' => 'junatish/koknav.php',
            'mobileWatch_qushish' => 'junatish/mobileWatch.php'
        ];

        foreach ($links as $text => $url) {
            echo '<a href="' . $url . '">' . $text . '</a><br>';
        }
        ?>
    </nav>

    
</body>

</html>