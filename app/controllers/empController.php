<?php

// Made by Kervin Zoren S. BOnaobra

// security keys for ciphering

define('EMPFIRSTKEY','1YM1x8Wu0mmkVvesDF5u2yCNQ/OzeXffr7GCp2I0ICk=');

define('EMPSECONDKEY','Orqc9TdH15qoSXjyITHgVqApYaDifNoRjbsHu4TpZD8ZocmbS9PZVzxwgyqHfZePVOtKZ4VlgRSi7W8jyk0Pmg==');

//php mailer

include_once 'phpmailer/Exception.php';
include_once 'phpmailer/PHPMailer.php';
include_once 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class empController extends formController{

    public $empModel;

    public function __construct(){
        $this->empModel = new empModel;
    }

    public function getTest(){

        if($_SERVER['REQUEST_METHOD'] = 'POST'){

            if(isset($_POST['submit'])){
                
                echo $_POST['firstName'];
                echo $_POST['middleName'];
                echo $_POST['lastName'];
                echo $_POST['empEmail'];
                echo $_POST['empPassword'];
                echo $_POST['rePassword'];
                echo $_POST['empNum'];
                echo $_POST['gender'];
                echo $_POST['birthday'];
                echo $_POST['maritalStatus'];
                echo $_POST['brgyAdd'];
                echo $_POST['cityAdd'];
                echo $_POST['contactNum'];
                echo $_POST['department'];
                echo $_POST['position'];
                echo $_POST['telNum'];
                echo $_POST['emergName'];
                echo $_POST['emergRel'];
                echo $_POST['emergNum'];
                echo $_POST['emergAdd'];
            }
        }
    }

    public function checkSession(){

        if(!isset($_SESSION['empLastName']) || !isset($_SESSION['empID'])){

            header("location:emp_login.php?error=loginfirst");
            exit();
        }
    }

    public function getEmp(){

        $result = $this->empModel->read();
        $row_num = $result->rowCount();
        $arr_emp = [];
    
        if($row_num > 0){
            $arr_emp = $result->fetchAll();
        }
    
        return $arr_emp;
    }

    public function getTotalNumEmps(){

        $result = $this->empModel->read();
        $row_num = $result->rowCount();

        return $row_num;
    }

    public function getTotalNumPendingAcc(){

        $totalEmp = $this->getEmp();
        $totalPendingAcc = 0;
        $totalEmpCode = [];

        foreach($totalEmp as $value){
            if($value->accStatus == "pending"){
                $totalPendingAcc++;
                array_push($totalEmpCode ,"EMAIL: " . $value->empEmail . " - LASTNAME: " . $value->empLastName . " - REGISTERED AT: " . $value->createdAt);
            }
        }

        return $totalEmpCode;
    }

    public function getTotalNumDeletedAcc(){

        $result = $this->empModel->trashBin();
        $row_num = $result->rowCount();

        return $row_num;
    }

    public function createEmp(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(isset($_POST['submit'])){

                $empFirstName     =   $_POST['firstName'];
                $empMiddleName    =   $_POST['middleName'];
                $empLastName      =   $_POST['lastName'];
                $empEmail         =   $_POST['empEmail'];
                $empPassword      =   $_POST['empPassword'];
                $rePassword       =   $_POST['rePassword'];
                $empNum           =   $_POST['empNum'];
                $gender           =   $_POST['gender'];
                $birthday         =   $_POST['birthday'];
                $maritalStatus    =   $_POST['maritalStatus'];
                $brgyAdd          =   $_POST['brgyAdd'];
                $cityAdd          =   $_POST['cityAdd'];
                $contactNum       =   $_POST['contactNum'];
                $department       =   $_POST['department'];
                $position         =   $_POST['position'];
                $telNum           =   $_POST['telNum'];
                $emergName        =   $_POST['emergName'];
                $emergRel         =   $_POST['emergRel'];
                $emergNum         =   $_POST['emergNum'];
                $emergAdd         =   $_POST['emergAdd'];

                $empFirstNameErr    =   ( empty( $empFirstName   ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $empFirstName   ) );
                $empMiddleNameErr   =   ( empty( $empMiddleName  ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $empMiddleName  ) );
                $empLastNameErr     =   ( empty( $empLastName    ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $empLastName    ) );
                $empEmailErr        =   ( empty( $empEmail       ) ) ? "required" : $this->emailExist( $this->test_input( $empEmail ), 0 );
                $empPasswordErr     =   ( empty( $empPassword    ) ) ? "required" : $this->is_num_lett_spechar_only( $this->test_input( $empPassword      ) );
                $rePasswordErr      =   ( $empPassword != $rePassword ) ? "password didn't match" : "";
                $empNumErr          =   ( empty( $empNum           ) ) ? "required" : $this->is_num_lett_only( $this->test_input( $empNum ) );   
                $genderErr          =   ( empty( $gender           ) ) ? "required" : $this->is_lett_space_only( $this->test_input( $gender ) );
                $birthdayErr        =   ( empty( $birthday         ) ) ? "required" : $this->is_valid_date( $this->test_input( $birthday ) );
                $maritalStatusErr   =   ( empty( $maritalStatus    ) ) ? "required" : $this->is_lett_space_only( $this->test_input( $maritalStatus ) );
                $brgyAddErr         =   ( empty( $brgyAdd          ) ) ? "required" : $this->is_num_lett_space_only( $this->test_input( $brgyAdd              ) );
                $cityAddErr         =   ( empty( $cityAdd          ) ) ? "required" : $this->is_num_lett_space_only( $this->test_input( $cityAdd              ) );
                $contactNumErr      =   ( empty( $contactNum       ) ) ? "required" : $this->is_num_only( $this->test_input( $contactNum                      ) );
                $departmentErr      =   ( empty( $department       ) ) ? "required" : $this->is_lett_space_only( $this->test_input( $department ) );    
                $positionErr        =   ( empty( $position         ) ) ? "required" : $this->is_lett_space_only( $this->test_input( $position ) );
                $telNumErr          =   ( empty( $telNum           ) ) ? "required" : $this->is_num_only( $this->test_input( $telNum ) );      
                $emergNameErr       =   ( empty( $emergName        ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $emergName        ) );
                $emergRelErr        =   ( empty( $emergRel         ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $emergRel         ) );
                $emergNumErr        =   ( empty( $emergNum         ) ) ? "required" : $this->is_num_only( $this->test_input( $emergNum                        ) );
                $emergAddErr        =   ( empty( $emergAdd         ) ) ? "required" : $this->is_num_lett_space_only( $this->test_input( $emergAdd             ) );

                $arrErr = array(
                    $empFirstNameErr  , 
                    $empMiddleNameErr , 
                    $empLastNameErr   ,
                    $empEmailErr      , 
                    $empPasswordErr   ,
                    $rePasswordErr    ,
                    $empNumErr        ,
                    $genderErr        ,
                    $birthdayErr      ,
                    $maritalStatusErr ,
                    $brgyAddErr       ,
                    $cityAddErr       ,
                    $contactNumErr    ,
                    $departmentErr    ,
                    $positionErr      ,
                    $telNumErr        ,
                    $emergNameErr     ,
                    $emergRelErr      ,
                    $emergNumErr      ,
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

                    $this->empModel->empFirstName   =  $empFirstName;
                    $this->empModel->empMiddleName  =  $empMiddleName;
                    $this->empModel->empLastName    =  $empLastName;
                    $this->empModel->empEmail       =  $empEmail;
                    $this->empModel->empPassword    =  $empPassword;
                    $this->empModel->empNum         =  $empNum;
                    $this->empModel->gender         =  $gender;
                    $this->empModel->birthday       =  $birthday;
                    $this->empModel->maritalStatus  =  $maritalStatus;
                    $this->empModel->brgyAdd        =  $brgyAdd;
                    $this->empModel->cityAdd        =  $cityAdd;
                    $this->empModel->contactNum     =  $contactNum;
                    $this->empModel->department     =  $department;
                    $this->empModel->position       =  $position;  
                    $this->empModel->telNum         =  $telNum;    
                    $this->empModel->emergName      =  $emergName;
                    $this->empModel->emergRel       =  $emergRel;
                    $this->empModel->emergNum       =  $emergNum;
                    $this->empModel->emergAdd       =  $emergAdd;

                    if($this->empModel->create()){

                        $mail = new PHPMailer(true);

                        $this->empModel->empEmail = $empEmail;
                        $empEmailCodePassword = $this->empModel->getCodeFromEmail()->fetch(PDO::FETCH_OBJ);

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
                            $mail->addAddress($empEmailCodePassword->empEmail);     //Add a recipient
                            $mail->addReplyTo('dios.webapp@gmail.com', 'Dios Web Support');
                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = "Account Login Credentials for Dios WebApp Account";
                            $mail->Body    = "<p>Greetings User! You have successfully created an employee account for DIOS Web Application. 
                                                This e-mail contains your Employee Code and Password to login into our Website, do not show this to others to keep your account safe. 
                                                Wait for your account to get verified first before logging in, we will notify you once your account has been verified. </p><br>
                                                <b>CODE:</b><br><h1>" . $empEmailCodePassword->empCode . "</h1><br>
                                                <b>PASSWORD:</b><br><h1>" . $empEmailCodePassword->empPassword . "</h1>";
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

    public function emailExist($email, $empID){

        $result = $this->empModel->emailExist($email)->fetchAll();

        if($result == false){

            return $this->is_valid_email($email);
        }
        else if($result == true){

            $isTheOwner = $this->empModel->emailOwner($email, $empID)->fetchAll();

            if($isTheOwner == true){

                return $this->is_valid_email($email);

            }
            
            if($isTheOwner == false){

                return $error = "email is already taken.";

            }
        }
    }

    public function actionEmp(){

        if($_SERVER["REQUEST_METHOD"] == "GET"){

            if(isset($_GET["action"]) && isset($_GET["empID"])){

                $empID = $_GET["empID"];

                if($_GET["action"] == "approval"){

                    $_SESSION["approveAccount"] = "approval";
                    $_SESSION["approveID"] = $empID;
                    $approvedBy = $_SESSION['adminLastName'];
                    $this->approveEmp($empID, $approvedBy);
                }

                if($_GET["action"] == "edit"){

                    $_SESSION["editAccount"] = "edit";
                    $_SESSION["editID"] = $empID;
                    header("location: cms_emp_edit.php?session=edit");
                    exit();

                }

                if($_GET["action"] == "delete"){

                    $_SESSION["deleteAccount"] = "delete";
                    $_SESSION["deleteID"] = $empID;
                    $this->deleteEmp($empID);

                }
            }
        }
    }

    public function getOneEmp($empID){

        $this->empModel->empID = $empID;

        $result = $this->empModel->readOne()->fetch(PDO::FETCH_OBJ);

        return $result;

    }

    public function approveEmp($empID, $approvedBy){

        if(isset($_SESSION["approveAccount"])){

            if(empty($_SESSION["approveAccount"])){

                $this->approveRedirect("invalid-approve");

            }

            if(isset($_SESSION["approveID"])){

                $isValidId = $this->getOneEmp($empID); 

                if(!$isValidId){

                    $this->approveRedirect("no-account");
        
                }
                if($isValidId){

                    $this->empModel->empID = $empID;
                    $this->empModel->approvedBy = $approvedBy;
                    $isApproved = $this->empModel->approve();

                    if($isApproved){

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
                            $mail->addAddress($isValidId->empEmail);     //Add a recipient
                            $mail->addReplyTo('dios.webapp@gmail.com', 'Dios Web Support');
                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = "Account Verification for Dios WebApp Account";
                            $mail->Body    = "<p>Greetings User! Your account has been verified and approved by the Admin, you can now log-in using your Employee Code and Password. 
                                                This e-mail contains your log-in credentials, do not show this to others to keep your account safe.</p><br>
                                                <b>CODE:</b><br><h1>" . $isValidId->empCode . "</h1><br>
                                                <b>PASSWORD:</b><br><h1>" . $isValidId->empPassword . "</h1>";
                            $mail->send();

                            $this->approveRedirect("approved");

                        } catch (Exception $e) {

                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                    }
                }
            }
        }
        if(!isset($_SESSION["approveAccount"])){

            $this->approveRedirect("invalid-approve");

        }
    }

    private function approveRedirect($sessionValue){

        unset($_SESSION["approveAccount"]);
        unset($_SESSION["approveID"]);
        $sessionFinalValue = ($sessionValue == "no-account") ? "no-account" : 
                                    (
                                        ($sessionValue == "approved") ? "approved" : 
                                        (
                                            ($sessionValue == "invalid-approve") ? "invalid-approve" : ''
                                        )
                                    );
        header("location: cms_emp_accounts.php?session=" . $sessionFinalValue);
        exit();

    }

    public function editEmp(){

        if(isset($_SESSION["editAccount"])){

            if(empty($_SESSION["editAccount"])){

                $this->editRedirect("invalid-edit");

            }

            if(isset($_SESSION["editID"])){

                $empID = $_SESSION["editID"];

                $isValidId = $this->getOneEmp($empID); 

                if(!$isValidId){

                    $this->editRedirect("no-account");
        
                }
                if($isValidId){

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        if(isset($_POST['submit'])){
            
                            $empFirstName     =   $_POST['firstName'];
                            $empMiddleName    =   $_POST['middleName'];
                            $empLastName      =   $_POST['lastName'];
                            $empEmail         =   $_POST['empEmail'];
                            $empPassword      =   $_POST['empPassword'];
                            $rePassword       =   $_POST['rePassword'];
                            $empNum           =   $_POST['empNum'];
                            $gender           =   $_POST['gender'];
                            $birthday         =   $_POST['birthday'];
                            $maritalStatus    =   $_POST['maritalStatus'];
                            $brgyAdd          =   $_POST['brgyAdd'];
                            $cityAdd          =   $_POST['cityAdd'];
                            $contactNum       =   $_POST['contactNum'];
                            $department       =   $_POST['department'];
                            $position         =   $_POST['position'];
                            $telNum           =   $_POST['telNum'];
                            $emergName        =   $_POST['emergName'];
                            $emergRel         =   $_POST['emergRel'];
                            $emergNum         =   $_POST['emergNum'];
                            $emergAdd         =   $_POST['emergAdd'];
            
                            $empFirstNameErr    =   ( empty( $empFirstName   ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $empFirstName   ) );
                            $empMiddleNameErr   =   ( empty( $empMiddleName  ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $empMiddleName  ) );
                            $empLastNameErr     =   ( empty( $empLastName    ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $empLastName    ) );
                            $empEmailErr        =   ( empty( $empEmail       ) ) ? "required" : $this->emailExist( $this->test_input( $empEmail ), $empID );
                            $empPasswordErr     =   ( empty( $empPassword    ) ) ? "required" : $this->is_num_lett_spechar_only( $this->test_input( $empPassword      ) );
                            $rePasswordErr      =   ( $empPassword != $rePassword ) ? "password didn't match" : "";
                            $empNumErr          =   ( empty( $empNum           ) ) ? "required" : $this->is_num_lett_only( $this->test_input( $empNum ) );   
                            $genderErr          =   ( empty( $gender           ) ) ? "required" : $this->is_lett_space_only( $this->test_input( $gender ) );
                            $birthdayErr        =   ( empty( $birthday         ) ) ? "required" : $this->is_valid_date( $this->test_input( $birthday ) );
                            $maritalStatusErr   =   ( empty( $maritalStatus    ) ) ? "required" : $this->is_lett_space_only( $this->test_input( $maritalStatus ) );
                            $brgyAddErr         =   ( empty( $brgyAdd          ) ) ? "required" : $this->is_num_lett_space_only( $this->test_input( $brgyAdd              ) );
                            $cityAddErr         =   ( empty( $cityAdd          ) ) ? "required" : $this->is_num_lett_space_only( $this->test_input( $cityAdd              ) );
                            $contactNumErr      =   ( empty( $contactNum       ) ) ? "required" : $this->is_num_only( $this->test_input( $contactNum                      ) );
                            $departmentErr      =   ( empty( $department       ) ) ? "required" : $this->is_lett_space_only( $this->test_input( $department ) );    
                            $positionErr        =   ( empty( $position         ) ) ? "required" : $this->is_lett_space_only( $this->test_input( $position ) );
                            $telNumErr          =   ( empty( $telNum           ) ) ? "required" : $this->is_num_only( $this->test_input( $telNum ) );      
                            $emergNameErr       =   ( empty( $emergName        ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $emergName        ) );
                            $emergRelErr        =   ( empty( $emergRel         ) ) ? "required" : $this->is_lett_space_spechar_only( $this->test_input( $emergRel         ) );
                            $emergNumErr        =   ( empty( $emergNum         ) ) ? "required" : $this->is_num_only( $this->test_input( $emergNum                        ) );
                            $emergAddErr        =   ( empty( $emergAdd         ) ) ? "required" : $this->is_num_lett_space_only( $this->test_input( $emergAdd             ) );
            
                            $arrErr = array(
                                $empFirstNameErr  , 
                                $empMiddleNameErr , 
                                $empLastNameErr   ,
                                $empEmailErr      , 
                                $empPasswordErr   ,
                                $rePasswordErr    ,
                                $empNumErr        ,
                                $genderErr        ,
                                $birthdayErr      ,
                                $maritalStatusErr ,
                                $brgyAddErr       ,
                                $cityAddErr       ,
                                $contactNumErr    ,
                                $departmentErr    ,
                                $positionErr      ,
                                $telNumErr        ,
                                $emergNameErr     ,
                                $emergRelErr      ,
                                $emergNumErr      ,
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
            
                                $this->empModel->empFirstName   =  $empFirstName;
                                $this->empModel->empMiddleName  =  $empMiddleName;
                                $this->empModel->empLastName    =  $empLastName;
                                $this->empModel->empEmail       =  $empEmail;
                                $this->empModel->empPassword    =  $empPassword;
                                $this->empModel->empNum         =  $empNum;
                                $this->empModel->gender         =  $gender;
                                $this->empModel->birthday       =  $birthday;
                                $this->empModel->maritalStatus  =  $maritalStatus;
                                $this->empModel->brgyAdd        =  $brgyAdd;
                                $this->empModel->cityAdd        =  $cityAdd;
                                $this->empModel->contactNum     =  $contactNum;
                                $this->empModel->department     =  $department;
                                $this->empModel->position       =  $position;  
                                $this->empModel->telNum         =  $telNum;    
                                $this->empModel->emergName      =  $emergName;
                                $this->empModel->emergRel       =  $emergRel;
                                $this->empModel->emergNum       =  $emergNum;
                                $this->empModel->emergAdd       =  $emergAdd;
            
                                if($this->empModel->update()){
            
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
        header("location: cms_emp_accounts.php?session=" . $sessionFinalValue);
        exit();
    }

    public function deleteEmp($empID){

        if(isset($_SESSION["deleteAccount"])){

            if(empty($_SESSION["deleteAccount"])){

                $this->deleteRedirect("invalid-delete");

            }

            if(isset($_SESSION["deleteID"])){

                $isValidId = $this->getOneEmp($empID); 

                if(!$isValidId){

                    $this->deleteRedirect("no-account");
        
                }
                if($isValidId){
                
                    $empInfo = $isValidId;

                    $this->empModel->empID = $empID;
                    $isCopiedToTrash = $this->empModel->copyToTrash();

                    if($isCopiedToTrash){

                        $isDeleted = $this->empModel->delete();

                        if($isDeleted){

                            $qrPath = $empInfo->empQR;
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
        header("location: cms_emp_accounts.php?session=" . $sessionFinalValue);
        exit();

    }

    public function validateCode($code){

        $decryptedData = $this->secured_decrypt($code);

        $isValidCode = $this->empModel->checkAttendance($decryptedData)->fetch(PDO::FETCH_OBJ);

        if($isValidCode){
            $empData = $this->getOneEmp($isValidCode->empID);

            $empPublicData = array('lastName' => $empData->empLastName, 'userType' => 'employee', 'userPic' => $empData->empPic, 'code' => $empData->empCode);

            return $empPublicData;
        }

        else{

            return false;

        }

    }

    private function secured_decrypt($input){

        $first_key = base64_decode(EMPFIRSTKEY);
        $second_key = base64_decode(EMPSECONDKEY);           
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

    public function empLogin(){

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(isset($_POST['login'])){

                $empCode = $this->test_input($_POST['empCode']);
                $empPassword = $this->test_input($_POST['empPassword']);
    
                $this->empModel->empCode = $empCode;
                $this->empModel->empPassword = $empPassword;

                $isVerified = $this->empModel->verifyAccount();

                $result = $isVerified->fetch(PDO::FETCH_OBJ);

                if($result){

                    $accStatus = $result->accStatus;

                    if($accStatus == "pending"){

                        header('location:emp_login.php?error=pending');
                        exit();
                    }

                    if($accStatus == "Approved"){

                        $_SESSION['empLastName'] = $result->empLastName;
                        $_SESSION['empID'] = $result->empID;
    
                        // echo "success";
                        header('location:emp_home.php');
                        exit();
                    }
                }
                else{
                    // echo "fail";
                    header('location:emp_login.php?error=invalidaccount');
                    exit();
                }
            }
        }
    }

    public function uploadProfilePic($empID){

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(isset($_POST['upload'])){

                $dir = '../../app/src/pic_dir/pic_emp/' . basename($_FILES['upImage']['name']);

                $image = $_FILES['upImage']['name'];

                $isUploaded = $this->empModel->uploadImage($dir, $empID);

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

    public function empLogout(){

        if(isset($_POST['logout'])){
            // session_start();
            session_unset();
            session_destroy();
    
            header('location:emp_login.php?logout=success');
            exit;
        }
    }

    public function tryMailer(){

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
            $mail->addAddress('kervinzorenbonaobra@gmail.com');     //Add a recipient
            $mail->addReplyTo('dios.webapp@gmail.com', 'Dios Web Support');
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Reset password confirmation code for Dios WebApp Account";
            $mail->Body    = "<p>Greetings User! We received a reset password request. Use the code below to confirm your reset. password request</p><br>
                                <b>RESET PASSOWORD CODE</b><br><h1>WOHOI LODS</h1>";
            $mail->send();
            echo "sent!";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            // header("location:forgot_password.php?request=failed");
            // exit;
        }
    }

    public function empResetPassword(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(isset($_POST['submitEmail'])){
            
                $random_num = random_int(0, 999999);
                $verificationCode = str_pad($random_num, 6, 0, STR_PAD_LEFT);
    
                $empEmail = $_POST['empEmail'];
    
                $accountExist = $this->empModel->emailExist($empEmail)->fetch(PDO::FETCH_OBJ);
    
                if($accountExist){
    
                    // // echo "tama ka lods";
                    $isDeleted = $this->empModel->deletePwdResetData($empEmail);
    
                    $isInserted = $this->empModel->insertPwdResetData($empEmail, $verificationCode);
                    
    
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
                            $mail->addAddress($empEmail);     //Add a recipient
                            $mail->addReplyTo('dios.webapp@gmail.com', 'Dios Web Support');
    
    
                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = "Reset Password Verification code for Dios WebApp Account";
                            $mail->Body    = "<p>Greetings User! We received a reset password request for your account. Use the code below to confirm your reset password request.</p><br>
                                                <b>VERIFICATION CODE: </b><br><h1>" . $verificationCode ."</h1>";
    
                            $mail->send();
    
                            $resultArray = array( $empEmail, "success" );
                            
                            return $resultArray;
    
                            // header("location:forgot_password.php?request=success&email=" . $empEmail);
                            // exit;
                        } catch (Exception $e) {
    
                            $resultArray = array( $empEmail, "error" );
                            
                            return $resultArray;
                            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                            // header("location:forgot_password.php?request=failed");
                            // exit;
                        }
                    }
                }
                else {
    
                    $resultArray = array( $empEmail, "invalid" );
                            
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

                $isValidVerificationCode = $this->empModel->verifyCode($verificationCode)->fetch(PDO::FETCH_OBJ);

                if($isValidVerificationCode){
                    
                    $empConfirmedEmail = $isValidVerificationCode->rstEmail;

                    $newPasswordErr = (empty( $newPassword    ) ) ? "required" : $this->is_num_lett_spechar_only( $this->test_input( $newPassword ) );

                    $confirmPasswordErr = ( $newPassword != $confirmPassword ) ? "password didn't match" : "";

                    if(!empty($newPasswordErr)) {

                        return $resultArray = array($empConfirmedEmail, "success", "invalid-password");

                    }

                    if(!empty($confirmPasswordErr)){

                        return $resultArray = array($empConfirmedEmail, "success", "mismatch");
                    
                    }

                    if(empty($newPasswordErr) && empty($confirmPasswordErr)){

                        $isPasswordUpdated = $this->empModel->updatePassword($empConfirmedEmail, $newPassword);
                        
                        $isDeleted = $this->empModel->deletePwdResetData($empConfirmedEmail);

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
                                $mail->addAddress($empConfirmedEmail);     //Add a recipient
                                $mail->addReplyTo('dios.webapp@gmail.com', 'Dios Web Support');
        
        
                                //Content
                                $mail->isHTML(true);                                  //Set email format to HTML
                                $mail->Subject = "Password Changed!";
                                $mail->Body    = "<p>Greetings User! We wanted to let you know that your password has been updated.</p><br>";
        
                                $mail->send();
        
                                return $resultArray = array($empConfirmedEmail, "reset");
        
                            } catch (Exception $e) {
        
                                return $resultArray = array( $empConfirmedEmail, "success", "error" );
                                
                            }

                        }
                        else{

                            return $resultArray = array($empConfirmedEmail, "success", "error");

                        }
                    }
                }
                else{

                    return $resultArray = array($empConfirmedEmail = "", "success", "invalid-code");

                }
            }
        }
    }
}

?>