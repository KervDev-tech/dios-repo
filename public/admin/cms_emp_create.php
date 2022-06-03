<?php

session_start();

include_once '../../app/includes/autoLoad.php';

$admin = new adminController;

$emp = new empController;

$adminSession = $admin->checkSession();

$empCreate = $emp->createEmp();

$adminLogout = $admin->adminLogout();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiOS | Emp Create</title>
    <link rel="stylesheet" href="../../app/src/styles/navbar_admin_style.css">
    <link rel="stylesheet" href="../../app/src/styles/cms_dashboard_style.css">
    <link rel="stylesheet" href="../../app/src/styles/register_style.css">
    <link rel="stylesheet" href="../../app/src/styles/scroll_style.css">

    <script src="https://kit.fontawesome.com/88ac38dcb9.js" crossorigin="anonymous"></script>
    <script defer src="../../app/src/scripts/form_handler.js"></script>
    <script src="../../app/src/scripts/side_nav.js"></script>
</head>
<body>
    <div id="mySidenav"class="sidenav">

    <?php

        include "../../app/views/admin/navbar_admin.php";

    ?>

    </div>
    <div id="main">
        <div id="header">
            <span id="burger-menu"style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        </div>
        <?php
            
            include "../../app/views/admin/create_emp.php";
        
        ?>
        <div id="footer">
            Copyright © 2021 | DiOS Web Application | Made with 💗
        </div>
    </div>
</body>
</html>