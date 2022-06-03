<?php

session_start();

include_once '../../app/includes/autoLoad.php';

$emp = new empController;

$scan = new scanController;

$empSession = $emp->checkSession();

$empData = $emp->getOneEmp($_SESSION["empID"]);

$empLogout = $emp->empLogout();

$attendaceList = $scan->getOneRecordEmp($empData->empCode);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMP | Dashboard</title>
    <link rel="stylesheet" href="../../app/src/styles/navbar_emp_style.css">
    <link rel="stylesheet" href="../../app/src/styles/cms_accounts_style.css">
    <link rel="stylesheet" href="../../app/src/styles/emp_home_style.css">
    <link rel="stylesheet" href="../../app/src/styles/scroll_style.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script defer src="../../app/src/scripts/datatables.js"></script>
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

        <div id="attendance-div">
            <div id="create-account-div">
                <div id="heading-title">Daily Time In & Out Management</div>
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