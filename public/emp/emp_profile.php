<?php

session_start();

include_once '../../app/includes/autoLoad.php';

$emp = new empController;

$empSession = $emp->checkSession();

$empLogout = $emp->empLogout();

$empData = $emp->getOneEmp($_SESSION["empID"]);

$uploadPic = $emp->uploadProfilePic($_SESSION["empID"]);

$code = $empData->empCode;

$qr = $empData->empQR;

$Lastname = $empData->empLastName;

$ctgry = "EMPLOYEE";

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
    <link rel="stylesheet" href="../../app/src/styles/profile_style.css">
    <script src="https://kit.fontawesome.com/88ac38dcb9.js" crossorigin="anonymous"></script>
    <script src="../../app/src/scripts/side_nav.js"></script>
    <script src="../../app/src/scripts/html2canvas.js"></script>
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
        
            include "../../app/views/emp/navbar_emp.php";
        
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
                                <img id="user-pic" src="<?php if(isset($uploadPic[1])){ echo $uploadPic[1];} else{echo $empData->empPic;} ?>" alt="user-picture">
                            </div>
                            <?php

                            if(empty($empData->empPic) && !isset($uploadPic)){
                                echo '<form action="'. htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post" enctype="multipart/form-data">
                                    <input type="file" name="upImage" required="required">
                                    <input type="submit" value="upload" name="upload">
                                </form>';
                            }
                            ?>
                            <div class="div-label">
                                EMP Picture
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
                                
                                $filepath = "../../app/src/id_dir/emp_id/QRID-" . $code . ".jpeg";
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
                            emp Code
                        </div>
                        <div class="div-value">
                            <?php echo $empData->empCode; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Fullname
                        </div>
                        <div class="div-value">
                            <?php echo $empData->empFirstName . " " . $empData->empMiddleName . " " . $empData->empLastName; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Email
                        </div>
                        <div class="div-value">
                            <?php echo $empData->empEmail; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Password
                        </div>
                        <div class="div-value">
                            <input type="password" value="<?php echo $empData->empPassword; ?>" id="user-password" readonly="readonly">
                            <button onclick="showPwd()" id="show-btn"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Created At
                        </div>
                        <div class="div-value">
                            <?php echo $empData->createdAt; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Approved By
                        </div>
                        <div class="div-value">
                            <?php echo $empData->approvedBy; ?>
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
                            <?php echo $empData->brgyAdd . " " . $empData->cityAdd; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Contact Number
                        </div>
                        <div class="div-value">
                            <?php echo $empData->contactNum; ?>
                        </div>
                    </div>
                </div>
                <div class="div-divider-label">
                    Personal Information
                </div>
                <div class="div-info-group">
                    <div class="div-info">
                        <div class="div-label">
                            Employee Number
                        </div>
                        <div class="div-value">
                            <?php echo $empData->empNum?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Gender
                        </div>
                        <div class="div-value">
                            <?php echo $empData->gender; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Marital Status
                        </div>
                        <div class="div-value">
                            <?php echo $empData->maritalStatus; ?>
                        </div>
                    </div>
                </div>
                <div class="div-divider-label">
                    Employee Information
                </div>
                <div class="div-info-group">
                    <div class="div-info">
                        <div class="div-label">
                            Department
                        </div>
                        <div class="div-value">
                            <?php echo $empData->department?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Position
                        </div>
                        <div class="div-value">
                            <?php echo $empData->position; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Telephone Number
                        </div>
                        <div class="div-value">
                            <?php echo $empData->telNum; ?>
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
                            <?php echo $empData->emergName; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Relationship
                        </div>
                        <div class="div-value">
                            <?php echo $empData->emergRel; ?>
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Contact Number
                        </div>
                        <div class="div-value">
                            <?php echo $empData->emergNum; ?> 
                        </div>
                    </div>
                    <div class="div-info">
                        <div class="div-label">
                            Address
                        </div>
                        <div class="div-value">
                            <?php echo $empData->emergAdd; ?>
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