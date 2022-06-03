<?php

//made by Kervin Zoren Bonaobra

include_once 'phpqrcode/qrlib.php';

class empModel extends dbModel{

    private $conn;
    private $emp_acc_tb = 'emp_acc_tb';
    private $emp_emerg_tb = 'emp_emerg_tb';
    private $emp_info_tb = 'emp_info_tb';
    private $emp_qr_tb = 'emp_qr_tb';

    public $empID;
    public $empFirstName;
    public $empMiddleName;
    public $empLastName;
    public $empEmail;
    public $empPassword;

    public $createdBy;
    public $approvedBy;
    public $accStatus;

    public $empNum;
    public $empPic;
    public $gender;
    public $birthday;
    public $maritalStatus;
    public $brgyAdd;
    public $cityAdd;
    public $contactNum;
    public $department;
    public $position;
    public $telNum;

    public $emergName;
    public $emergRel;
    public $emergAdd;
    public $emergNum;

    public $empCode;
    public $empQr = "";

    public function __construct(){
        $this->conn = $this->connect(); //function connect() from dbModel
    }

    public function read(){

        $query = 'SELECT * FROM 
            ( 
                (
                    emp_acc_tb INNER JOIN emp_info_tb ON emp_acc_tb.empID = emp_info_tb.empID
                ) 
                INNER JOIN emp_emerg_tb ON emp_acc_tb.empID = emp_emerg_tb.empID 
            ) 
            INNER JOIN emp_qr_tb ON emp_acc_tb.empID = emp_qr_tb.empID ';
            
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readAccOnly(){

        $query = 'SELECT * FROM emp_acc_tb';
            
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;

    }

    public function readOne(){

        $query = 'SELECT * FROM 
        ( 
            ( 
                (emp_acc_tb INNER JOIN emp_info_tb ON emp_acc_tb.empID = emp_info_tb.empID) 
                INNER JOIN emp_emerg_tb ON emp_acc_tb.empID = emp_emerg_tb.empID 
            ) 
            INNER JOIN emp_qr_tb ON emp_acc_tb.empID = emp_qr_tb.empID 
        ) WHERE emp_acc_tb.empID = :empID';
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute(
            [
                'empID' => $this->empID
            ]
        );

        return $stmt;
    }

    public function create(){

        try{

            $this->conn->beginTransaction();

            $query = 'INSERT INTO ' .  $this->emp_acc_tb . 
            '(
                empFirstName,
                empMiddleName,
                empLastName,
                empEmail,
                empPassword
            ) 
            VALUES (
                :empFirstName,
                :empMiddleName,
                :empLastName,
                :empEmail,
                :empPassword
            )';
                
            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'empFirstName'  => $this->empFirstName,
                    'empMiddleName' => $this->empMiddleName,
                    'empLastName'   => $this->empLastName,
                    'empEmail'      => $this->empEmail,
                    'empPassword'   => $this->empPassword
                ]
            );

            $this->empID = $this->conn->lastInsertId();

            $query =

            'INSERT INTO ' . $this->emp_info_tb .
                '(
                    empID,
                    empNum,
                    gender,
                    birthday,
                    maritalStatus, 
                    brgyAdd, 
                    cityAdd, 
                    contactNum,
                    department,
                    position,
                    telNum
                )
                VALUES (
                    :empID,
                    :empNum,
                    :gender,
                    :birthday,
                    :maritalStatus, 
                    :brgyAdd, 
                    :cityAdd, 
                    :contactNum,
                    :department,
                    :position,
                    :telNum
                );
            ';

            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'empID'           => $this->empID,
                    'empNum'          => $this->empNum,
                    'gender'          => $this->gender,
                    'birthday'        => $this->birthday,
                    'maritalStatus'   => $this->maritalStatus,
                    'brgyAdd'         => $this->brgyAdd,
                    'cityAdd'         => $this->cityAdd,
                    'contactNum'      => $this->contactNum,
                    'department'      => $this->department,
                    'position'        => $this->position,
                    'telNum'          => $this->telNum
                ]
            );

            $query =

            'INSERT INTO '. $this->emp_emerg_tb . 
                '(
                    empID, 
                    emergName, 
                    emergRel, 
                    emergAdd, 
                    emergNum
                )
                VALUES(
                    :empID, 
                    :emergName, 
                    :emergRel, 
                    :emergAdd, 
                    :emergNum
                );
            ';

            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'empID'           => $this->empID,
                    'emergName'       => $this->emergName,
                    'emergRel'        => $this->emergRel,  
                    'emergAdd'        => $this->emergAdd,
                    'emergNum'        => $this->emergNum
                ]
            );

            $query =

            'INSERT INTO '. $this->emp_qr_tb . 
                '(
                    empID, 
                    empCode, 
                    empQR 
                )
                VALUES(
                    :empID, 
                    CONCAT(YEAR(CURDATE()), "-EMP-", LPAD(:empCode, 5, "0"), "-",  UPPER(SUBSTR(MD5(RAND()), 1, 5))), 
                    :empQR
                );
            ';
                
            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'empID'         => $this->empID,
                    'empCode'       => $this->empID,
                    'empQR'         => $this->empQr
                ]
            );

            $query = 
            
            'SELECT empCode FROM ' . $this->emp_qr_tb . ' WHERE empID = :empID ';

            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'empID'         => $this->empID
                ]
            );

            $result = $this->getEmpCode()->fetch(PDO::FETCH_OBJ);

            $empCode = $result->empCode;

            $this->generateQR( $this->secured_encrypt( $empCode ) );

            $this->conn->commit();

        }
        catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
            $this->conn->rollback();
        }

        return $stmt;
    }

    private function getEmpCode(){

        $query = 'SELECT empCode FROM ' . $this->emp_qr_tb . ' WHERE empID = :empID ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'empID'         => $this->empID
            ]
        );

        return $stmt;
    }

    private function secured_encrypt($empCode){

        $first_key = base64_decode(EMPFIRSTKEY);
        $second_key = base64_decode(EMPSECONDKEY);   
        
        $method = "aes-256-cbc";   
        $iv_length = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($iv_length);
            
        $first_encrypted = openssl_encrypt($empCode,$method,$first_key, OPENSSL_RAW_DATA ,$iv);   
        $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
                
        $output = base64_encode($iv.$second_encrypted.$first_encrypted);   

        return $output;       
    }

    private function generateQR($encryptedData){

        $path = "../../app/src/qr_dir/emp/";

        $empQr = $path . uniqid() . "-". $this->empID . ".png";
        
        $ecc = 'H';
        $pixel_Size = 10;
        $frame_size = 5;
        
        QRcode::png($encryptedData, $empQr, $ecc, $pixel_Size, $frame_size);

        $query = 'UPDATE ' . $this->emp_qr_tb . ' SET empQR = :empQR WHERE empID = :empID';
        $stmt = $this->conn->prepare($query);
        $stmt->execute(
            [
                'empID'         => $this->empID, 
                'empQR'         => $empQr
            ]
        );

        return $stmt;
    }

    public function update(){

        try{

            $this->conn->beginTransaction();

            $query = 'UPDATE ' .  $this->emp_acc_tb .'  
                SET 
                    empFirstName = :empFirstName,
                    empMiddleName = :empMiddleName,
                    empLastName = :empLastName,
                    empEmail = :empEmail,
                    empPassword = :empPassword
                WHERE empID = :empID
            ';
                
            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'empFirstName'  => $this->empFirstName,
                    'empMiddleName' => $this->empMiddleName,
                    'empLastName'   => $this->empLastName,
                    'empEmail'      => $this->empEmail,
                    'empPassword'   => $this->empPassword,
                    'empID'         => $this->empID,
                ]
            );

            $query = 'UPDATE ' . $this->emp_info_tb .
                ' SET 
                    empNum = :empNum,
                    gender = :gender,
                    birthday = :birthday,
                    maritalStatus = :maritalStatus, 
                    brgyAdd = :brgyAdd, 
                    cityAdd = :cityAdd, 
                    contactNum = :contactNum,
                    department = :department,
                    position = :position,
                    telNum = :telNum
                WHERE empID = :empID
            ';

            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'empID'           => $this->empID,
                    'empNum'          => $this->empNum,
                    'gender'          => $this->gender,
                    'birthday'        => $this->birthday,
                    'maritalStatus'   => $this->maritalStatus,
                    'brgyAdd'         => $this->brgyAdd,
                    'cityAdd'         => $this->cityAdd,
                    'contactNum'      => $this->contactNum,
                    'department'      => $this->department,
                    'position'        => $this->position,
                    'telNum'          => $this->telNum
                ]
            );

            $query = 'UPDATE '. $this->emp_emerg_tb . 
                ' SET
                    emergName = :emergName, 
                    emergRel = :emergRel, 
                    emergAdd = :emergAdd, 
                    emergNum = :emergNum
                WHERE empID = :empID
            ';

            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'empID'         => $this->empID,
                    'emergName'       => $this->emergName,
                    'emergRel'        => $this->emergRel,  
                    'emergAdd'        => $this->emergAdd,
                    'emergNum'        => $this->emergNum
                ]
            );

            $this->conn->commit();

        }
        catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
            $this->conn->rollback();
        }

        return $stmt;

    }

    public function copyToTrash(){

        $query = 'INSERT INTO emp_trash_tb
        (
            empID,
            empFirstName,
            empMiddleName,
            empLastName,
            empEmail,
            empPassword,
            createdAt,
            approvedBy,
            accStatus
        )
        SELECT * FROM emp_acc_tb WHERE empID = :empID';
            
        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'empID' => $this->empID
            ]
        );

        return $stmt;
    }

    public function delete(){

        $query = 'DELETE FROM ' . $this->emp_acc_tb . ' WHERE empID = :empID';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'empID' => $this->empID
            ]
        );

        return $stmt;
    }

    public function trashBin(){

        $query = 'SELECT * FROM emp_trash_tb';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function emailExist($email){

        $query = 'SELECT * FROM ' . $this->emp_acc_tb . ' WHERE empEmail = :empEmail';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(['empEmail' =>$email]);

        return $stmt;
    }

    public function emailOwner($email, $empID){

        $query = 'SELECT * FROM ' . $this->emp_acc_tb . ' WHERE empEmail = :empEmail && empID = :empID';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'empEmail' =>$email,
                'empID'    =>$empID 
            ]
        );

        return $stmt;
    }

    public function approve(){

        $query = 'UPDATE ' . $this->emp_acc_tb . ' SET accStatus = "Approved", approvedBy = :approvedBy WHERE empID = :empID';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'empID' => $this->empID,
                'approvedBy' => $this->approvedBy
            ]
        );

        return $stmt;
    }

    public function verifyAccount(){

        // $query = 'SELECT * FROM ' . $this->emp_qr_tb . ', ' . $this->emp_acc_tb . ' WHERE empCode = :empCode && empPassword = :empPassword';
        $query = 'SELECT * FROM ( emp_acc_tb INNER JOIN emp_qr_tb ON emp_acc_tb.empID = emp_qr_tb.empID ) WHERE emp_acc_tb.empPassword = :empPassword && emp_qr_tb.empCode = :empCode';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'empCode'         => $this->empCode,
                'empPassword'     => $this->empPassword
            ]
        );

        return $stmt;
    }

    public function getCodeFromEmail(){

        $query = 'SELECT * FROM ( emp_acc_tb INNER JOIN emp_qr_tb ON emp_acc_tb.empID = emp_qr_tb.empID ) WHERE emp_acc_tb.empEmail = :empEmail';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'empEmail'         => $this->empEmail
            ]
        );

        return $stmt;
    }

    public function deletePwdResetData($empEmail){

        $query = 'DELETE FROM emp_pwd_reset_tb WHERE rstEmail =:rstEmail';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'rstEmail' => $empEmail
            ]
        );

        return $stmt;
    }

    public function insertPwdResetData($empEmail, $verificationCode){

        $query = 'INSERT INTO emp_pwd_reset_tb (rstEmail, rstCode) VALUES (:rstEmail, :rstCode)';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'rstEmail' => $empEmail, 
                'rstCode'  => $verificationCode
            ]
        );

        return $stmt;
    }

    public function verifyCode($verificationCode){

        $query = 'SELECT * FROM emp_pwd_reset_tb WHERE rstCode =:rstCode';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'rstCode' => $verificationCode
            ]
        );

        return $stmt;
    }

    public function updatePassword($empConfirmedEmail, $newPassword){

        $query = 'UPDATE emp_acc_tb
                    set empPassword = :empPassword
                    WHERE empEmail = :empEmail';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'empPassword' =>$newPassword, 
                'empEmail'    => $empConfirmedEmail 
            ]
        );
        
        return $stmt;
    }

    public function checkAttendance($code){

        $query = 'SELECT * FROM ' . $this->emp_qr_tb . ' WHERE empCode = :empCode';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'empCode' => $code
            ]
        );

        return $stmt;

    }

    public function uploadImage($empPic, $empID){

        $query = 'UPDATE emp_qr_tb SET empPic = :empPic WHERE empID = :empID';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'empPic' => $empPic,
                'empID' => $empID
            ]
        );

        return $stmt;
    }

}

?>