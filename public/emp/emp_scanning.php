<?php

session_start();

include_once '../../app/includes/autoLoad.php';

$emp = new empController;

$empSession = $emp->checkSession();

$empLogout = $emp->empLogout();

$admin = new adminController;

$checkStatusWfhScanner = $admin->checkStatusWfhScanner();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMP | Scanner</title>
    <link rel="stylesheet" href="../../app/src/styles/navbar_emp_style.css">
    <link rel="stylesheet" href="../../app/src/styles/emp_home_style.css">
    <link rel="stylesheet" href="../../app/src/styles/scroll_style.css">
    <link rel="stylesheet" href="../../app/src/styles/qr_scanner_style.css">
    <?php
    if($checkStatusWfhScanner == "ON"){
    ?>
        <script src="../../app/src/scripts/instascan.min.js"></script>
    <?php
    }
    
    ?>
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

        <div id="qr-scanner-div">

            <?php
                            
            if($checkStatusWfhScanner == "OFF"){
                ?>
                <h1>WFH QR SCANNING IS DISABLED BY THE ADMIN.</h1>
                <?php
            }
            if($checkStatusWfhScanner == "ON"){
                ?>
                    <div id="scanner-div">
                        <div class="scanner-label">
                            QR Scanner
                        </div>

                        <video id="preview"></video>
                            
                        <div class="scanner-label">
                            Capture Preview
                        </div>

                        <div id="scanned-div">
                            <img src="" alt="capture-preview" id="qr-scanned" />
                        </div>

                    </div>

                    <div id="result-div">
                        
                        <div class="div-label">
                            User Picture
                        </div>
                        <div id="picture-div">
                            <img src="" alt="user-picture" id="user-picture" />
                        </div>

                        <div id="info-div">

                            <div id="lastname-div">
                                <p class="div-label">Lastname</p><p id="user-lastname" class="div-value">...</p>
                            </div> 

                            <div id="type-div">
                                <p class="div-label">User Type</p> <p id="user-type" class="div-value">...</p>
                            </div>

                            <div id="activity-div">
                                <p class="div-label">Activity</p> <p id="user-activity" class="div-value">...</p>
                            </div>

                            <div id="query-div">
                                <p class="div-label">Time</p> <p id="user-time" class="div-value">...</p>
                            </div>

                        </div>
                        <div id="reset-data-div">
                            <button id="reset-data-btn">Data will be cleared 8secs after scanning</button>
                        </div>

                    </div>
                <?php
            }
            
            ?>
        </div>
        <div id="footer">
            Copyright © 2021 | DiOS Web Application | Made with 💗
        </div>

    </div>
    <script src="../../app/src/scripts/qr_scanning.js"></script>
    <script src="../../app/src/scripts/clear_btn_scan.js"></script>
</body>
</html>