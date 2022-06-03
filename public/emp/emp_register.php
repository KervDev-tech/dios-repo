<?php

session_start();

include_once '../../app/includes/autoLoad.php';

$emp = new empController;

$empCreate = $emp->createEmp();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee | Registration</title>
    <link rel="stylesheet" href="../../app/src/styles/navbar_home_style.css">
    <link rel="stylesheet" href="../../app/src/styles/register_style.css">
    <script defer src="../../app/src/scripts/form_handler.js"></script>
</head>
<body>
    <div id="header">
        <?php
            include_once "../../app/views/pages/navbar_home.php";
        ?>
    </div>
    <div id="container">
        <?php
            include_once "../../app/views/emp/register_emp.php"
        ?>
    </div>
</body>
</html>