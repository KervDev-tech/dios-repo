<?php

session_start();

include_once '../../app/includes/autoLoad.php';

$admin = new adminController();

$admin->adminLogin();

// $admin->isLoggedIn();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login</title>
    <link rel="stylesheet" href="../../app/src/styles/login_style.css">
    <link rel="stylesheet" href="../../app/src/styles/navbar_home_style.css">
    <link rel="stylesheet" href="../../app/src/styles/scroll_style.css">
</head>
<body>
    <div id="header">
        <?php
            include_once '../../app/views/pages/navbar_home.php';
        ?>
    </div>
    <div class="container">
        <?php
            include_once '../../app/views/admin/login_admin.php';
        ?>
    </div>
    <div id="footer">
        Copyright © 2021 | DiOS Web Application | Made with 💗
    </div>
</body>
</html>