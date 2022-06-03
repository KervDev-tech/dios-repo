<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest | Registration</title>
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
            include_once "../../app/views/guest/register_guest.php"
        ?>
    </div>
</body>
</html>