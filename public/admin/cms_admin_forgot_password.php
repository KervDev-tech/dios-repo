<?php

include_once '../../app/includes/autoLoad.php';

$admin = new adminController;

$resetPassword = $admin->adminResetPassword();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Forgot Password</title>
    <link rel="stylesheet" href="../../app/src/styles/login_style.css">
    <link rel="stylesheet" href="../../app/src/styles/navbar_home_style.css">
</head>
<body>
    <div id="header">
        <?php
            include_once '../../app/views/pages/navbar_home.php';
        ?>
    </div>
    <div class="container">
        <?php
            // include_once '../../app/views/admin/login_admin.php';
        ?>
        <div class="login-form">
            <div class="title">
                RESET PASSWORD <span id="user-type">Admin.</span>
            </div>

            <?php
                if(isset($resetPassword) && $resetPassword[1] == "success"){
                    
                    ?>

                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="inputs">

                        <label for="verificationCode" class="input-label">
                            Verification Code
                        </label>
                            <input type="text" name="verificationCode" id="verificationCode" class="input-area" placeholder="enter verification code..." required="required" autocomplete="off">
                        <label for="newPassword" class="input-label">
                            New Password
                        </label>
                            <input type="password" name="newPassword" id="newPassword" class="input-area" placeholder="enter new password..." required="required" autocomplete="off">
                        <label for="confirmPassword" class="input-label">
                            Confirm Password
                        </label>
                            <input type="password" name="confirmPassword" id="confirmPassword" class="input-area" placeholder="re-enter password..." required="required" autocomplete="off">
                        
                        <input type="submit" name="resetPassword" value="Reset Password" class="submit-button">
                        <div class="error-div">
                            <?php
                                if(isset($resetPassword[2])){

                                    if($resetPassword[2] == "error"){
                                        echo "<p class='error'>An Error occured, please try again.</p>";
                                    }
                                    if($resetPassword[2] =="invalid-code"){
                                        echo "<p class='error'>Invalid code, please try again.</p>";
                                    }
                                    if($resetPassword[2] =="mismatch"){
                                        echo "<p class='error'>Password didn't match, please try again.</p>";
                                    }
                                    if($resetPassword[2] =="invalid-password"){
                                        echo "<p class='error'>Invalid password format, please try again.</p>";
                                    }
                                }
                            ?>
                        </div>
                    </form>

                    <?php

                }

                else if(isset($resetPassword) && $resetPassword[1] == "reset"){
                    
                    ?>

                        <div class="inputs">
                            <div class="input-label">
                                Password changed succesfully! You can now log-in using your new password. <a href="cms_admin_login.php">Log-in?</a>
                            </div>
                        </div>

                    <?php

                }
                else{

                    ?>

                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="inputs">
                        <label for="adminEmail" class="input-label">
                            Email
                        </label>
                            <input type="text" name="adminEmail" id="adminEmail" class="input-area" placeholder="enter your email..." required="required" autocomplete="off">
                        <input type="submit" name="submitEmail" value="Receive Code" class="submit-button">
                        <div class="error-div">

                        <?php

                            if(isset($resetPassword)){

                                if($resetPassword[1] == "error"){
                                    echo "<p class='error'>An Error occured, please try again.</p>";
                                }
                                if($resetPassword[1] =="invalid"){
                                    echo "<p class='error'>No account found, please try again.</p>";
                                }
                            }

                        ?>

                        </div>
                    </form>

                    <?php
                }
            ?>

        </div>
    </div>
</body>
</html>