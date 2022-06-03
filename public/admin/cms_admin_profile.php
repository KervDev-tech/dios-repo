<?php

session_start();

include_once '../../app/includes/autoLoad.php';

$admin = new adminController;

$adminSession = $admin->checkSession();

$adminData = $admin->getOneAdmin($_SESSION["adminID"]);

$adminLogout = $admin->adminLogout();

$uploadPic = $admin->uploadProfilePic($_SESSION["adminID"]);

$code = $adminData->adminCode;

$qr = $adminData->adminQR;

$Lastname = $adminData->adminLastName;

$ctgry = "ADMIN";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DiOS | Profile</title>
    <link rel="stylesheet" href="../../app/src/styles/navbar_admin_style.css">
    <link rel="stylesheet" href="../../app/src/styles/cms_dashboard_style.css">
    <link rel="stylesheet" href="../../app/src/styles/profile_style.css">
    <script src="https://kit.fontawesome.com/88ac38dcb9.js" crossorigin="anonymous"></script>
    <script src="../../app/src/scripts/html2canvas.js"></script>
    <script src="../../app/src/scripts/side_nav.js"></script>
    <script>
        var imageDataURL;
        var qrcode = "<?php echo $code; ?>";

        function doCapture() {
			window.scrollTo(0, 0);
		
			html2canvas(document.getElementById("id-div")).then(function (canvas) {
	
				var ajax = new XMLHttpRequest();
				ajax.open("POST", "generate_id.php", true);
				ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				ajax.send("image=" + canvas.toDataURL("image/jpeg", 0.9) + "&code=" + qrcode);
				ajax.onreadystatechange = function () {
					if (this.readyState == 4 && this.status == 200) {
						console.log(this.responseText);
                        alert(this.responseText);
                    }
				};
			});
        }

        function showPwd() {
            var x = document.getElementById("user-password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
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
        <div id="main-container">
            <div id="info-div">
                <div class="div-divider-label">
                    Account Information
                </div>
                <div class="div-info-group">
                    <div class="div-info">
                        <div id="profile-pic-div">
                            <div id="picture-div">
                                <img id="user-pic" src="<?php if(isset($uploadPic[1])){ echo $uploadPic[1];} else{echo $adminData->adminPic;} ?>" alt="user-picture">
                            </div>
                            <?php

                            if(empty($adminData->adminPic) && !isset($uploadPic)){
                                echo '<form action="'. htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post" enctype="multipart/form-data">
                                    <input type="file" name="upImage" required="required">
                                    <input type="submit" value="upload" name="upload">
                                </form>';
                            }
                            ?>
                            <div class="div-label">
                                Admin Picture
                            </div>
                            <div class="error-div">
                                <div class="error">
                                <?php
                                
                                if(isset($uploadPic)){
                                    if($uploadPic[0] == "uploaded"){
                                        echo "Uploaded!.";
                                    }
                                    if($uploadPic == "error"){
                                        echo "An error occured, please try again.";
                                    }
                                }
                                
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="div-info">
                        <div id="qr-id-div">
                            <div id="id-div">
                                <a href="<?php echo $qr; ?>" download="qr_code"><img id="qr-code" src="<?php echo $qr; ?>" alt="qr_code"></a>
                                <p id="name"><?php echo $Lastname; ?></p>
                                <p id="ctgry"><?php echo $ctgry; ?></p>
                            </div>
                            <div id="id-btns">
                                <button id="generate-btn" onclick="doCapture();">
                                Generate ID
                                </button>
                                <?php
                                
                                $filepath = "../../app/src/id_dir/admin_id/QRID-" . $code . ".jpeg";
                                if(file_exists($filepath)){
                                    echo '<a href=" '. $filepath.' " id="download-btn" download="qr_ID">
                                            Download ID
                                        </a>';
                                }
                                else{
                                    echo '<p id="download-btn" >
                                            Unavailable
                                        </p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Admin Code
                        </div>
                        <div class="div-value">
                            <?php echo $adminData->adminCode; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Fullname
                        </div>
                        <div class="div-value">
                            <?php echo $adminData->adminFirstName . " " . $adminData->adminMiddleName . " " . $adminData->adminLastName; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Email
                        </div>
                        <div class="div-value">
                            <?php echo $adminData->adminEmail; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Password
                        </div>
                        <div class="div-value">
                            <input type="password" value="<?php echo $adminData->adminPassword; ?>" id="user-password" readonly="readonly">
                            <button onclick="showPwd()" id="show-btn"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Created At
                        </div>
                        <div class="div-value">
                            <?php echo $adminData->createdAt; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Created By
                        </div>
                        <div class="div-value">
                            <?php echo $adminData->createdBy; ?>
                        </div>
                    </div>

                </div>
                <div class="div-divider-label">
                    Contact Information
                </div>
                <div class="div-info-group">
                    <div class="div-info">
                        <div class="div-label">
                            Address
                        </div>
                        <div class="div-value">
                            <?php echo $adminData->brgyAdd . " " . $adminData->cityAdd; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Contact Number
                        </div>
                        <div class="div-value">
                            <?php echo $adminData->contactNum; ?>
                        </div>
                    </div>
                </div>
                <div class="div-divider-label">
                    In Case of Emergency
                </div>
                <div class="div-info-group">
                    <div class="div-info">
                        <div class="div-label">
                            Contact Person
                        </div>
                        <div class="div-value">
                            <?php echo $adminData->emergName; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Relationship
                        </div>
                        <div class="div-value">
                            <?php echo $adminData->emergRel; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Contact Number
                        </div>
                        <div class="div-value">
                            <?php echo $adminData->emergNum; ?> 
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Address
                        </div>
                        <div class="div-value">
                            <?php echo $adminData->emergAdd; ?>
                        </div>
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