<?php

session_start();

include_once '../../app/includes/autoLoad.php';

$admin = new adminController;

$emp = new empController;

$scan = new scanController;

$toggleWfhScanner = $admin->toggleWfhScanner();

$adminSession = $admin->checkSession();

$adminLogout = $admin->adminLogout();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiOS | Dashboard</title>
    <link rel="stylesheet" href="../../app/src/styles/navbar_admin_style.css">
    <link rel="stylesheet" href="../../app/src/styles/cms_dashboard_style.css">
    <script src="https://kit.fontawesome.com/88ac38dcb9.js" crossorigin="anonymous"></script>
    <script src="../../app/src/scripts/side_nav.js"></script>
</head>
<body>
    <div id="mySidenav"class="sidenav">

        <?php
        
            include "../../app/views/admin/navbar_admin.php";
        

        ?>
    </div>
    <div id="main">

        <?php
            
            include "../../app/views/admin/dashboard_admin.php";
        
        ?>
        
        <div id="footer">
            Copyright © 2021 | DiOS Web Application | Made with 💗
        </div>
    </div>
</body>
</html>