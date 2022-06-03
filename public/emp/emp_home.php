<?php

session_start();

include_once '../../app/includes/autoLoad.php';

$emp = new empController;

$scan = new scanController;

$empData = $emp->getOneEmp($_SESSION["empID"]);

$empSession = $emp->checkSession();

$empLogout = $emp->empLogout();

$scanTimeIn = $scan->getTotalTimeIn($empData->empCode);

$scanTimeOut = $scan->getTotalTimeOut($empData->empCode);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMP | Dashboard</title>
    <link rel="stylesheet" href="../../app/src/styles/navbar_emp_style.css">
    <link rel="stylesheet" href="../../app/src/styles/emp_home_style.css">
    <link rel="stylesheet" href="../../app/src/styles/scroll_style.css">
    <script src="https://kit.fontawesome.com/88ac38dcb9.js" crossorigin="anonymous"></script>
    <script src="../../app/src/scripts/side_nav.js"></script>
</head>
<body>
    <div id="mySidenav"class="sidenav">

        <?php
        
            include "../../app/views/emp/navbar_emp.php";
        
        ?>
    </div>

    <div id="main">
        <div id="header">
            <span id="burger-menu"style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        </div>
        <div id="dashboard-title-div">
            <div id="dashboard-heading">
                <i class="fas fa-users-cog"></i> Dashboard
            </div>
            <div id="dashboard-subheading">
                Welcome EMP
                <?php
                    echo $_SESSION['empLastName'] . "!";
                ?>
            </div>
        </div>
        <div id="dashboard-section">
            <div class="dashboard-section-item" id="dashboard-overview">
                <div class="panel-title" id="dashboard-overview-title">Data Overview</div>
                <div id="dashboard-overview-items">
                    <div class="overview-item">
                        <i class="fas fa-clock"> Total Time In </i> <div class="total-number"><?php echo $scanTimeIn?></div>
                    </div>
                    <div class="overview-item">
                        <i class="fas fa-clock"> Total Time Out </i> <div class="total-number"><?php echo $scanTimeOut?></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer">
            Copyright © 2021 | DiOS Web Application | Made with 💗
        </div>
    </div>
</body>
</html>