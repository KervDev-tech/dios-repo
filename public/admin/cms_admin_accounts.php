<?php

session_start();

include_once '../../app/includes/autoLoad.php';

$admin = new adminController;

$adminGet = $admin->getAdmin();

$adminSession = $admin->checkSession();

$adminAction = $admin->actionAdmin();

$adminLogout = $admin->adminLogout();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiOS | Admin Accounts</title>
    <link rel="stylesheet" href="../../app/src/styles/navbar_admin_style.css">
    <link rel="stylesheet" href="../../app/src/styles/cms_dashboard_style.css">
    <link rel="stylesheet" href="../../app/src/styles/cms_accounts_style.css">
    <link rel="stylesheet" href="../../app/src/styles/scroll_style.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script src="https://kit.fontawesome.com/88ac38dcb9.js" crossorigin="anonymous"></script>
    <script src="../../app/src/scripts/side_nav.js"></script>
    <script defer src="../../app/src/scripts/datatables.js"></script>
    <script src="../../app/src/scripts/cms_buttons.js"></script>

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
            
            include "../../app/views/admin/adminaccounts_admin.php";
        
        ?>

        <div id="footer">
            Copyright © 2021 | DiOS Web Application | Made with 💗
        </div>
    </div>
</body>
</html>