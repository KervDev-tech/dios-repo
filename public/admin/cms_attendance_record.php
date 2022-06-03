<?php

session_start();

include_once '../../app/includes/autoLoad.php';

$admin = new adminController;

$scan = new scanController;

$attendaceList = $scan->getAttendace();

$adminSession = $admin->checkSession();

$adminLogout = $admin->adminLogout();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS | DTR</title>
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

        <div id="attendance-div">
            <div id="create-account-div">
                <div id="heading-title">Daily Time In & Out Management</div>
                <a href="cms_export_tb.php?export=dtr" id="export-btn">Export DTR</a>
            </div>
            
            <table id="data-tb">
                <thead>
                    <td>ID</td>
                    <td>User Code</td>
                    <td>Scan Date</td>
                    <td>Scan Time In</td>
                    <td>Scan Time Out</td>
                </thead>
                <tbody>
                    <?php
                    if(!empty($attendaceList)){
                        foreach ($attendaceList as $value){
                            echo "<tr>          ";
                            echo "    <td>" . $value->scanID . "</td>";
                            echo "    <td>" . $value->scanCode . "</td>";
                            echo "    <td>" . $value->scanDate . "</td>";
                            echo "    <td>" . $value->scanTimeIn . "</td>";
                            echo "    <td>" . $value->scanTimeOut . "</td>";
                            echo "</tr>         ";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div id="footer">
            Copyright © 2021 | DiOS Web Application | Made with 💗
        </div>

    </div>
</body>
</html>