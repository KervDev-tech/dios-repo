<?php

//made by Kervin Zoren Bonaobra 

// security keys for ciphering

define('ADMINFIRSTKEY','kVL0bGJ4uybILcIcJGkGsvf2E3k08fNsWKnIshEsG5Q=');

define('ADMINSECONDKEY','ETFA7iYPrL/Gem8ZvgdNJrPzQZMr7Rl0WjX40doQb//Q8DO8fKMwB3kAsGa+iXpqU+ib4C17RQ/jqBKz+9hWnw==');

//php mailer

include_once 'phpmailer/Exception.php';
include_once 'phpmailer/PHPMailer.php';
include_once 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class adminController extends formController{

    public $adminModel;

    public function __construct(){
        $this->adminModel = new adminModel;
    }

    public function getTest(){

        if($_SERVER['REQUEST_METHOD'] = 'POST'){

            if(isset($_POST['submit'])){
                
                echo $_POST['firstName'];
                echo $_POST['middleName'];
                echo $_POST['lastName'];
                echo $_POST['adminEmail'];
                echo $_POST['adminPassword'];
                echo $_POST['rePassword'];
                echo $_POST['brgyAdd'];
                echo $_POST['cityAdd'];
                echo $_POST['contactNum'];
                echo $_POST['emergName'];
                echo $_POST['emergRel'];
                echo $_POST['emergNum'];
                echo $_POST['emergAdd'];
            }
        }
    }

    public function checkSession(){

        if(!isset($_SESSION['adminLastName']) || !isset($_SESSION['adminID'])){

            header("location:cms_admin_login.php?error=loginfirst");
            exit();
        }

    }

    public function isLoggedIn(){

        if(isset($_SESSION['adminLastName']) || !isset($_SESSION['adminID'])){

            header("location:cms_admin_dashboard.php");
            exit();
        }
    }

    public function getAdmin(){

        $result = $this->adminModel->read();
        $row_num = $result->rowCount();
        $arr_admin = [];
    
        if($row_num > 0){
            $arr_admin = $result->fetchAll();
        }
    
        return $arr_admin;
    }

    public function getTotalNumAdmins(){

        $result = $this->adminModel->read();
        $row_num = $result->rowCount();

        return $row_num;
    }

    public function getTotalNumDeletedAcc(){

        $result = $this->adminModel->trashBin();
        $row_num = $result->rowCount();

        return $row_num;
    }

    public function createAdmin(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(isset($_POST['submit'])){

                $adminFirstName   =   $_POST['firstName'];
                $adminMiddleName  =   $_POST['middleName'];
                $adminLastName    =   $_POST['lastName'];
                $adminEmail       =   $_POST['adminEmail'];
                $adminPassword    =   $_POST['adminPassword'];
                $rePassword       =   $_POST['rePassword'];
                $brgyAdd          =   $_POST['brgyAdd'];
                $cityAdd          =   $_POST['cityAdd'];
                $contactNum       =   $_POST['contactNum'];
                $emergName        =   $_POST['emergName'];
                $emergRel         =   $_POST['emergRel'];
                $emergNum         =   $_POST['emergNum'];
                $emergAdd         =   $_POST['emergAdd'];

                $createdBy        =  $_SESSION['adminLastName'];

                $adminFirstNameErr    =   ( empty( $adminFirstName   ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $adminFirstName   ) );
                $adminMiddleNameErr   =   ( empty( $adminMiddleName  ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $adminMiddleName  ) );
                $adminLastNameErr     =   ( empty( $adminLastName    ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $adminLastName    ) );
                $adminEmailErr        =   ( empty( $adminEmail       ) ) ? "required" : $this->emailExist( $this->test_input( $adminEmail ), 0 );
                $adminPasswordErr     =   ( empty( $adminPassword    ) ) ? "required" : $this->is_num_lett_spechar_only( $this->test_input( $adminPassword      ) );
                $rePasswordErr        =   ( $adminPassword != $rePassword ) ? "password didn't match" : "";
                $brgyAddErr           =   ( empty( $brgyAdd          ) ) ? "required" : $this->is_num_lett_space_only( $this->test_input( $brgyAdd              ) );
                $cityAddErr           =   ( empty( $cityAdd          ) ) ? "required" : $this->is_num_lett_space_only( $this->test_input( $cityAdd              ) );
                $contactNumErr        =   ( empty( $contactNum       ) ) ? "required" : $this->is_num_only( $this->test_input( $contactNum                      ) );
                $emergNameErr         =   ( empty( $emergName        ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $emergName        ) );
                $emergRelErr          =   ( empty( $emergRel         ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $emergRel         ) );
                $emergNumErr          =   ( empty( $emergNum         ) ) ? "required" : $this->is_num_only( $this->test_input( $emergNum                        ) );
                $emergAddErr          =   ( empty( $emergAdd         ) ) ? "required" : $this->is_num_lett_space_only( $this->test_input( $emergAdd             ) );

                $arrErr = array(
                    $adminFirstNameErr  , 
                    $adminMiddleNameErr , 
                    $adminLastNameErr   ,
                    $adminEmailErr      , 
                    $adminPasswordErr   ,
                    $rePasswordErr      ,
                    $brgyAddErr         ,
                    $cityAddErr         ,
                    $contactNumErr      ,
                    $emergNameErr       ,
                    $emergRelErr        ,
                    $emergNumErr        ,
                    $emergAddErr       
                );

                $errCounter = 0;

                $arrErrCount = count($arrErr);

                for( $i = 0; $i < $arrErrCount; $i++ ){

                    if(empty($arrErr[$i])){
                        $errCounter++;
                    }
                }

                if($errCounter == $arrErrCount){

                    $this->adminModel->adminFirstName = $_POST['firstName'];
                    $this->adminModel->adminMiddleName = $_POST['middleName'];
                    $this->adminModel->adminLastName = $_POST['lastName'];
                    $this->adminModel->adminEmail = $_POST['adminEmail'];
                    $this->adminModel->adminPassword = $_POST['adminPassword'];
                    $this->adminModel->brgyAdd = $_POST['brgyAdd'];
                    $this->adminModel->cityAdd = $_POST['cityAdd'];
                    $this->adminModel->contactNum = $_POST['contactNum'];
                    $this->adminModel->emergName = $_POST['emergName'];
                    $this->adminModel->emergRel = $_POST['emergRel'];
                    $this->adminModel->emergNum = $_POST['emergNum'];
                    $this->adminModel->emergAdd = $_POST['emergAdd'];
                    $this->adminModel->createdBy = $createdBy;

                    if($this->adminModel->create()){

                        $mail = new PHPMailer(true);

                        $this->adminModel->adminEmail = $adminEmail;
                        $adminEmailCodePassword = $this->adminModel->getCodeFromEmail()->fetch(PDO::FETCH_OBJ);

                        try {
                            //Server settings                 
                            $mail->isSMTP();   
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'dios.webapp@gmail.com';                     //SMTP username
                            $mail->Password   = 'diosBCP21';                               //SMTP password
                            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                            //Recipients
                            $mail->setFrom('dios.webapp@gmail.com', 'Dios Web Support');
                            $mail->addAddress($adminEmailCodePassword->adminEmail);     //Add a recipient
                            $mail->addReplyTo('dios.webapp@gmail.com', 'Dios Web Support');
                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = "Account Login Credentials for Dios WebApp Account";
                            $mail->Body    = "<p>Greetings User! An Admin have successfully created your Admin account for DIOS Web Application. 
                                                This e-mail contains your Admin Code and Password to login into our Website, do not show this to others to keep your account safe. 
                                                You can now log-in using the listed credentials below. </p><br>
                                                <b>CODE:</b><br><h1>" . $adminEmailCodePassword->adminCode . "</h1><br>
                                                <b>PASSWORD:</b><br><h1>" . $adminEmailCodePassword->adminPassword . "</h1>";
                            $mail->send();

                            return $message = "success";

                        } catch (Exception $e) {

                            return $message = "error";
                        }
            
                    }
                    else {

                        return $message = "error";

                    }
                }
                else{

                    return $message = $arrErr;

                }
            }
        }
    }

    public function profileAdmin(){

        $adminID = $_SESSION["adminID"];

        $isValidId = $this->getOneAdmin($adminID);

        if($isValidId){

            $adminInfo = $isValidId;
        }
    }

    public function actionAdmin(){

        if($_SERVER["REQUEST_METHOD"] == "GET"){

            if(isset($_GET["action"]) && isset($_GET["adminID"])){

                $adminID = $_GET["adminID"];

                if($_GET["action"] == "edit"){

                    $_SESSION["editAccount"] = "edit";
                    $_SESSION["editID"] = $adminID;
                    header("location: cms_admin_edit.php?session=edit");
                    exit();

                }

                if($_GET["action"] == "delete"){

                    $_SESSION["deleteAccount"] = "delete";
                    $_SESSION["deleteID"] = $adminID;
                    $this->deleteAdmin($adminID);

                }
            }
        }
    }

    public function getOneAdmin($adminID){

        $this->adminModel->adminID = $adminID;

        $result = $this->adminModel->readOne()->fetch(PDO::FETCH_OBJ);

        return $result;

    }

    public function editAdmin(){

        if(isset($_SESSION["editAccount"])){

            if(empty($_SESSION["editAccount"])){

                $this->editRedirect("invalid-edit");

            }

            if(isset($_SESSION["editID"])){

                $adminID = $_SESSION["editID"];

                $isValidId = $this->getOneAdmin($adminID); 

                if(!$isValidId){
        
                    $this->editRedirect("no-account");
        
                }
        
                if($isValidId){
        
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        if(isset($_POST['submit'])){
            
                            $adminFirstName   =   $_POST['firstName'];
                            $adminMiddleName  =   $_POST['middleName'];
                            $adminLastName    =   $_POST['lastName'];
                            $adminEmail       =   $_POST['adminEmail'];
                            $adminPassword    =   $_POST['adminPassword'];
                            $rePassword       =   $_POST['rePassword'];
                            $brgyAdd          =   $_POST['brgyAdd'];
                            $cityAdd          =   $_POST['cityAdd'];
                            $contactNum       =   $_POST['contactNum'];
                            $emergName        =   $_POST['emergName'];
                            $emergRel         =   $_POST['emergRel'];
                            $emergNum         =   $_POST['emergNum'];
                            $emergAdd         =   $_POST['emergAdd'];
        
                            $adminFirstNameErr    =   ( empty( $adminFirstName   ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $adminFirstName   ) );
                            $adminMiddleNameErr   =   ( empty( $adminMiddleName  ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $adminMiddleName  ) );
                            $adminLastNameErr     =   ( empty( $adminLastName    ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $adminLastName    ) );
                            $adminEmailErr        =   ( empty( $adminEmail       ) ) ? "required" : $this->emailExist( $this->test_input( $adminEmail ), $adminID );
                            $adminPasswordErr     =   ( empty( $adminPassword    ) ) ? "required" : $this->is_num_lett_spechar_only( $this->test_input( $adminPassword      ) );
                            $rePasswordErr        =   ( $adminPassword != $rePassword ) ? "password didn't match" : "";
                            $brgyAddErr           =   ( empty( $brgyAdd          ) ) ? "required" : $this->is_num_lett_space_only( $this->test_input( $brgyAdd              ) );
                            $cityAddErr           =   ( empty( $cityAdd          ) ) ? "required" : $this->is_num_lett_space_only( $this->test_input( $cityAdd              ) );
                            $contactNumErr        =   ( empty( $contactNum       ) ) ? "required" : $this->is_num_only( $this->test_input( $contactNum                      ) );
                            $emergNameErr         =   ( empty( $emergName        ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $emergName        ) );
                            $emergRelErr          =   ( empty( $emergRel         ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $emergRel         ) );
                            $emergNumErr          =   ( empty( $emergNum         ) ) ? "required" : $this->is_num_only( $this->test_input( $emergNum                        ) );
                            $emergAddErr          =   ( empty( $emergAdd         ) ) ? "required" : $this->is_num_lett_space_only( $this->test_input( $emergAdd             ) );
        
                            $arrErr = array(
                                $adminFirstNameErr  , 
                                $adminMiddleNameErr , 
                                $adminLastNameErr   ,
                                $adminEmailErr      , 
                                $adminPasswordErr   ,
                                $rePasswordErr      ,
                                $brgyAddErr         ,
                                $cityAddErr         ,
                                $contactNumErr      ,
                                $emergNameErr       ,
                                $emergRelErr        ,
                                $emergNumErr        ,
                                $emergAddErr       
                            );
        
                            $errCounter = 0;
        
                            $arrErrCount = count($arrErr);
        
                            for( $i = 0; $i < $arrErrCount; $i++ ){
        
                                if(empty($arrErr[$i])){
                                    $errCounter++;
                                }
                            }
        
                            if($errCounter == $arrErrCount){
        
                                $this->adminModel->adminID = $adminID;
                                $this->adminModel->adminFirstName = $adminFirstName;
                                $this->adminModel->adminMiddleName = $adminMiddleName;
                                $this->adminModel->adminLastName = $adminLastName;
                                $this->adminModel->adminEmail = $adminEmail;
                                $this->adminModel->adminPassword = $adminPassword;
                                $this->adminModel->brgyAdd = $brgyAdd;
                                $this->adminModel->cityAdd = $cityAdd;
                                $this->adminModel->contactNum = $contactNum;
                                $this->adminModel->emergName = $emergName;
                                $this->adminModel->emergRel = $emergRel;
                                $this->adminModel->emergNum = $emergNum;
                                $this->adminModel->emergAdd = $emergAdd;
        
                                if($this->adminModel->update()){
        
                                    $this->editRedirect("updated");
                        
                                }
                                else {
        
                                    return $message = "error";
        
                                }
                            }
                            else{
        
                                return $message = $arrErr;
        
                            }
                        }
                    }
                }
            }
        }
        if(!isset($_SESSION["editAccount"])){

            $this->editRedirect("invalid-edit");

        }
    }

    private function editRedirect($sessionValue){

        unset($_SESSION["editAccount"]);
        unset($_SESSION["editID"]);
        $sessionFinalValue = ($sessionValue == "no-account") ? "no-account" : 
                                    (
                                        ($sessionValue == "updated") ? "updated" : 
                                        (
                                            ($sessionValue == "invalid-edit") ? "invalid-edit" : ''
                                        )
                                    );
        header("location: cms_admin_accounts.php?session=" . $sessionFinalValue);
        exit();
    }

    public function deleteAdmin($adminID){

        if(isset($_SESSION["deleteAccount"])){

            if(empty($_SESSION["deleteAccount"])){

                $this->deleteRedirect("invalid-delete");

            }

            if(isset($_SESSION["deleteID"])){

                $isValidId = $this->getOneAdmin($adminID); 

                if(!$isValidId){

                    $this->deleteRedirect("no-account");
        
                }
                if($isValidId){
                
                    $adminInfo = $isValidId;

                    $this->adminModel->adminID = $adminID;
                    $isCopiedToTrash = $this->adminModel->copyToTrash();

                    if($isCopiedToTrash){

                        $isDeleted = $this->adminModel->delete();

                        if($isDeleted){

                            $qrPath = $adminInfo->adminQR;
                            @unlink($qrPath);
                            $this->deleteRedirect("deleted");
                        }
                    }
                }
            }
        }
        if(!isset($_SESSION["deleteAccount"])){

            $this->deleteRedirect("invalid-delete");
            exit();

        }
    }

    private function deleteRedirect($sessionValue){

        unset($_SESSION["deleteAccount"]);
        unset($_SESSION["deleteID"]);
        $sessionFinalValue = ($sessionValue == "no-account") ? "no-account" : 
                                    (
                                        ($sessionValue == "deleted") ? "deleted" : 
                                        (
                                            ($sessionValue == "invalid-delete") ? "invalid-delete" : ''
                                        )
                                    );
        header("location: cms_admin_accounts.php?session=" . $sessionFinalValue);
        exit();

    }

    public function emailExist($email, $adminID){

        $result = $this->adminModel->emailExist($email)->fetchAll();

        if($result == false){

            return $this->is_valid_email($email);
        }
        else if($result == true){

            $isTheOwner = $this->adminModel->emailOwner($email, $adminID)->fetchAll();

            if($isTheOwner == true){

                return $this->is_valid_email($email);

            }
            
            if($isTheOwner == false){

                return $error = "email is already taken.";

            }
        }
    }

    public function validateCode($code){

        $decryptedData = $this->secured_decrypt($code);

        $isValidCode = $this->adminModel->checkAttendance($decryptedData)->fetch(PDO::FETCH_OBJ);

        if($isValidCode){
            $adminData = $this->getOneAdmin($isValidCode->adminID);

            $adminPublicData = array('lastName' => $adminData->adminLastName, 'userType' => 'admin', 'userPic' => $adminData->adminPic, 'code' => $adminData->adminCode);

            return $adminPublicData;
        }

        else{

            return false;

        }

    }

    private function secured_decrypt($input){

        $first_key = base64_decode(ADMINFIRSTKEY);
        $second_key = base64_decode(ADMINSECONDKEY);           
        $mix = base64_decode($input);
            
        $method = "aes-256-cbc";   
        $iv_length = openssl_cipher_iv_length($method);
                
        $iv = substr($mix,0,$iv_length);
        $second_encrypted = substr($mix,$iv_length,64);
        $first_encrypted = substr($mix,$iv_length+64);
                
        $data = openssl_decrypt($first_encrypted,$method,$first_key,OPENSSL_RAW_DATA,$iv);
        $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
        
        if (hash_equals($second_encrypted,$second_encrypted_new))
            return $data;
        
        return false;
    }

    public function adminLogin(){

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(isset($_POST['login'])){

                $adminCode = $this->test_input($_POST['adminCode']);
                $adminPassword = $this->test_input($_POST['adminPassword']);
    
                $this->adminModel->adminCode = $adminCode;
                $this->adminModel->adminPassword = $adminPassword;

                $isVerified = $this->adminModel->verifyAccount();

                $result = $isVerified->fetch(PDO::FETCH_OBJ);

                if($result){
                    
                    $_SESSION['adminLastName'] = $result->adminLastName;
                    $_SESSION['adminID'] = $result->adminID;

                    // echo "success";
                    header('location:cms_admin_dashboard.php');
                    exit();
                }
                else{
                    // echo "fail";
                    header('location:cms_admin_login.php?error=invalidaccount');
                    exit();
                }
            }
        }
    }

    public function uploadProfilePic($adminID){

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(isset($_POST['upload'])){

                $dir = '../../app/src/pic_dir/pic_admin/' . basename($_FILES['upImage']['name']);

                $image = $_FILES['upImage']['name'];

                $isUploaded = $this->adminModel->uploadImage($dir, $adminID);

                if($isUploaded){
                    move_uploaded_file($_FILES['upImage']['tmp_name'], $dir);
                    return array("uploaded", $dir);
                }
                else{
                    return "error";
                }
            }
        }
    }

    public function adminLogout(){

        if(isset($_POST['logout'])){
            // session_start();
            session_unset();
            session_destroy();
    
            header('location:cms_admin_login.php?logout=success');
            exit;
        }
    }

    public function adminResetPassword(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(isset($_POST['submitEmail'])){
            
                $random_num = random_int(0, 999999);
                $verificationCode = str_pad($random_num, 6, 0, STR_PAD_LEFT);
    
                $adminEmail = $_POST['adminEmail'];
    
                $accountExist = $this->adminModel->emailExist($adminEmail)->fetch(PDO::FETCH_OBJ);
    
                if($accountExist){
    
                    // // echo "tama ka lods";
                    $isDeleted = $this->adminModel->deletePwdResetData($adminEmail);
    
                    $isInserted = $this->adminModel->insertPwdResetData($adminEmail, $verificationCode);
                    
    
                    if($isInserted){
    
                        $mail = new PHPMailer(true);
    
                        try {
                            //Server settings                 
                            $mail->isSMTP();   
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'dios.webapp@gmail.com';                     //SMTP username
                            $mail->Password   = 'diosBCP21';                               //SMTP password
                            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
                            //Recipients
                            $mail->setFrom('dios.webapp@gmail.com', 'Dios Web Support');
                            $mail->addAddress($adminEmail);     //Add a recipient
                            $mail->addReplyTo('dios.webapp@gmail.com', 'Dios Web Support');
    
    
                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = "Reset Password Verification code for Dios WebApp Account";
                            $mail->Body    = "<p>Greetings User! We received a reset password request for your account. Use the code below to confirm your reset password request.</p><br>
                                                <b>VERIFICATION CODE: </b><br><h1>" . $verificationCode ."</h1>";
    
                            $mail->send();
    
                            $resultArray = array( $adminEmail, "success" );
                            
                            return $resultArray;
    
                            // header("location:forgot_password.php?request=success&email=" . $adminEmail);
                            // exit;
                        } catch (Exception $e) {
    
                            $resultArray = array( $adminEmail, "error" );
                            
                            return $resultArray;
                            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            // header("location:forgot_password.php?request=failed");
                            // exit;
                        }
                    }
                }
                else {
    
                    $resultArray = array( $adminEmail, "invalid" );
                            
                    return $resultArray;
                    // // echo "wala acc lods";
                    // header("location:forgot_password.php?error=invalidaccount");
                    // exit;
                }
            }

            if(isset($_POST['resetPassword'])){

                $verificationCode = $_POST['verificationCode'];

                $newPassword = $_POST['newPassword'];

                $confirmPassword = $_POST['confirmPassword'];

                $isValidVerificationCode = $this->adminModel->verifyCode($verificationCode)->fetch(PDO::FETCH_OBJ);

                if($isValidVerificationCode){
                    
                    $adminConfirmedEmail = $isValidVerificationCode->rstEmail;

                    $newPasswordErr = (empty( $newPassword    ) ) ? "required" : $this->is_num_lett_spechar_only( $this->test_input( $newPassword ) );

                    $confirmPasswordErr = ( $newPassword != $confirmPassword ) ? "password didn't match" : "";

                    if(!empty($newPasswordErr)) {

                        return $resultArray = array($adminConfirmedEmail, "success", "invalid-password");

                    }

                    if(!empty($confirmPasswordErr)){

                        return $resultArray = array($adminConfirmedEmail, "success", "mismatch");
                    
                    }

                    if(empty($newPasswordErr) && empty($confirmPasswordErr)){

                        $isPasswordUpdated = $this->adminModel->updatePassword($adminConfirmedEmail, $newPassword);
                        
                        $isDeleted = $this->adminModel->deletePwdResetData($adminConfirmedEmail);

                        if($isPasswordUpdated && $isDeleted){

                            $mail = new PHPMailer(true);
    
                            try {
                                //Server settings                 
                                $mail->isSMTP();   
                                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                $mail->Username   = 'dios.webapp@gmail.com';                     //SMTP username
                                $mail->Password   = 'diosBCP21';                               //SMTP password
                                $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
                                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
                                //Recipients
                                $mail->setFrom('dios.webapp@gmail.com', 'Dios Web Support');
                                $mail->addAddress($adminConfirmedEmail);     //Add a recipient
                                $mail->addReplyTo('dios.webapp@gmail.com', 'Dios Web Support');
        
        
                                //Content
                                $mail->isHTML(true);                                  //Set email format to HTML
                                $mail->Subject = "Password Changed!";
                                $mail->Body    = "<p>Greetings User! We wanted to let you know that your password has been updated.</p><br>";
        
                                $mail->send();
        
                                return $resultArray = array($adminConfirmedEmail, "reset");
        
                            } catch (Exception $e) {
        
                                return $resultArray = array( $adminConfirmedEmail, "success", "error" );
                                
                            }

                        }
                        else{

                            return $resultArray = array($adminConfirmedEmail, "success", "error");

                        }
                    }
                }
                else{

                    return $resultArray = array($adminConfirmedEmail = "", "success", "invalid-code");

                }
            }
        }
    }

    public function checkStatusWfhScanner(){

        $currenStatus = $this->adminModel->checkStatusWfhScanner()->fetch();

        if($currenStatus->wfhScanStatus == "ON"){
            return "ON";
        }
        if($currenStatus->wfhScanStatus == "OFF"){
            return "OFF";
        }
    }

    public function toggleWfhScanner(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["toggleWfhScanner"])){

                $status = $_POST["toggleWfhScanner"];

                if($status == "TURN OFF"){
                    $isUpdated = $this->adminModel->toggleWfhScanner("OFF");

                }
                if($status == "TURN ON"){
                    $isUpdated = $this->adminModel->toggleWfhScanner("ON");

                }

                if($isUpdated){
                    return "updated";
                }
                else{
                    return "error";
                }
            }
        }
    }
}

?>