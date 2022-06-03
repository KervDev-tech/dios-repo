<?php

session_start();

include_once '../../app/includes/autoLoad.php';

$admin = new adminController;

$checkStatusWfhScanner = $admin->checkStatusWfhScanner();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiOS | Scanning</title>
    <link rel="stylesheet" href="../../app/src/styles/login_style.css">
    <link rel="stylesheet" href="../../app/src/styles/navbar_home_style.css">
    <link rel="stylesheet" href="../../app/src/styles/scroll_style.css">
    <link rel="stylesheet" href="../../app/src/styles/qr_scanner_style.css">

    <?php
    if($checkStatusWfhScanner == "ON"){
    ?>
        <script src="../../app/src/scripts/instascan.min.js"></script>
    <?php
    }
    
    ?>
</head>
<body>
    <div id="header">
        <?php
            include_once '../../app/views/pages/navbar_home.php';
        ?>
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
    <script src="../../app/src/scripts/qr_scanning.js"></script>
    <script src="../../app/src/scripts/clear_btn_scan.js"></script>
</body>
</html>