<?php

//made by Kervin Zoren Bonaobra

include_once 'phpqrcode/qrlib.php';

class adminModel extends dbModel{
    
    private $conn;
    private $admin_acc_tb = 'admin_acc_tb';
    private $admin_emerg_tb = 'admin_emerg_tb';
    private $admin_info_tb = 'admin_info_tb';
    private $admin_qr_tb = 'admin_qr_tb';

    public $adminID;
    public $adminFirstName;
    public $adminMiddleName;
    public $adminLastName;
    public $adminEmail;
    public $adminPassword;

    public $createdBy;

    public $brgyAdd;
    public $cityAdd;
    public $contactNum;

    public $emergName;
    public $emergRel;
    public $emergAdd;
    public $emergNum;

    public $adminCode;
    public $adminQr = "";

    public function __construct(){
        $this->conn = $this->connect(); //function connect() from dbModel
    }

    public function read(){

        $query = 'SELECT * FROM 
            ( 
                (
                    admin_acc_tb INNER JOIN admin_info_tb ON admin_acc_tb.adminID = admin_info_tb.adminID
                ) 
                INNER JOIN admin_emerg_tb ON admin_acc_tb.adminID = admin_emerg_tb.adminID 
            ) 
            INNER JOIN admin_qr_tb ON admin_acc_tb.adminID = admin_qr_tb.adminID ';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readOne(){

        $query = 'SELECT * FROM 
        ( 
            ( 
                (admin_acc_tb INNER JOIN admin_info_tb ON admin_acc_tb.adminID = admin_info_tb.adminID) 
                INNER JOIN admin_emerg_tb ON admin_acc_tb.adminID = admin_emerg_tb.adminID 
            ) 
            INNER JOIN admin_qr_tb ON admin_acc_tb.adminID = admin_qr_tb.adminID 
        ) WHERE admin_acc_tb.adminID = :adminID';
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute(
            [
                'adminID' => $this->adminID
            ]
        );

        return $stmt;
    }

    public function create(){

        try{

            $this->conn->beginTransaction();

            $query = 'INSERT INTO ' .  $this->admin_acc_tb . 
            '(
                adminID,
                adminFirstName,
                adminMiddleName,
                adminLastName,
                adminEmail,
                adminPassword,
                createdBy
            ) 
            VALUES (
                :adminID,
                :adminFirstName,
                :adminMiddleName,
                :adminLastName,
                :adminEmail,
                :adminPassword,
                :createdBy
            )';
                
            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'adminID'         => $this->adminID,
                    'adminFirstName'  => $this->adminFirstName,
                    'adminMiddleName' => $this->adminMiddleName,
                    'adminLastName'   => $this->adminLastName,
                    'adminEmail'      => $this->adminEmail,
                    'adminPassword'   => $this->adminPassword,
                    'createdBy'  => $this->createdBy
                ]
            );

            $this->adminID = $this->conn->lastInsertId();

            $query =

            'INSERT INTO ' . $this->admin_info_tb .
                '(
                    adminID, 
                    brgyAdd, 
                    cityAdd, 
                    contactNum
                )
                VALUES (
                    :adminID, 
                    :brgyAdd, 
                    :cityAdd, 
                    :contactNum
                );
            ';

            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'adminID'         => $this->adminID,
                    'brgyAdd'         => $this->brgyAdd,
                    'cityAdd'         => $this->cityAdd,
                    'contactNum'      => $this->contactNum
                ]
            );

            $query =

            'INSERT INTO '. $this->admin_emerg_tb . 
                '(
                    adminID, 
                    emergName, 
                    emergRel, 
                    emergAdd, 
                    emergNum
                )
                VALUES(
                    :adminID, 
                    :emergName, 
                    :emergRel, 
                    :emergAdd, 
                    :emergNum
                );
            ';

            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'adminID'         => $this->adminID,
                    'emergName'       => $this->emergName,
                    'emergRel'        => $this->emergRel,  
                    'emergAdd'        => $this->emergAdd,
                    'emergNum'        => $this->emergNum
                ]
            );

            $query =

            'INSERT INTO '. $this->admin_qr_tb . 
                '(
                    adminID, 
                    adminCode, 
                    adminQR 
                )
                VALUES(
                    :adminID, 
                    CONCAT(YEAR(CURDATE()), "-ADMIN-", LPAD(:adminCode, 5, "0"), "-",  UPPER(SUBSTR(MD5(RAND()), 1, 5))), 
                    :adminQR
                );
            ';
                
            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'adminID'         => $this->adminID,
                    'adminCode'       => $this->adminID,
                    'adminQR'         => $this->adminQr
                ]
            );

            $query = 
            
            'SELECT adminCode FROM ' . $this->admin_qr_tb . ' WHERE adminID = :adminID ';

            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'adminID'         => $this->adminID
                ]
            );

            $result = $this->getAdminCode()->fetch(PDO::FETCH_OBJ);

            $adminCode = $result->adminCode;

            $this->generateQR( $this->secured_encrypt( $adminCode ) );

            $this->conn->commit();

        }
        catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
            $this->conn->rollback();
        }

        return $stmt;
    }

    private function getAdminCode(){

        $query = 'SELECT adminCode FROM ' . $this->admin_qr_tb . ' WHERE adminID = :adminID ';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'adminID'         => $this->adminID
            ]
        );

        return $stmt;
    }

    private function secured_encrypt($adminCode){

        $first_key = base64_decode(ADMINFIRSTKEY);
        $second_key = base64_decode(ADMINSECONDKEY);   
        
        $method = "aes-256-cbc";   
        $iv_length = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($iv_length);
            
        $first_encrypted = openssl_encrypt($adminCode,$method,$first_key, OPENSSL_RAW_DATA ,$iv);   
        $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);
                
        $output = base64_encode($iv.$second_encrypted.$first_encrypted);   

        return $output;       
    }

    private function generateQR($encryptedData){

        $path = "../../app/src/qr_dir/admin/";

        $adminQr = $path . uniqid() . "-". $this->adminID . ".png";
        
        $ecc = 'H';
        $pixel_Size = 10;
        $frame_size = 5;
        
        QRcode::png($encryptedData, $adminQr, $ecc, $pixel_Size, $frame_size);

        $query = 'UPDATE ' . $this->admin_qr_tb . ' SET adminQR = :adminQR WHERE adminID = :adminID';
        $stmt = $this->conn->prepare($query);
        $stmt->execute(
            [
                'adminID'         => $this->adminID, 
                'adminQR'         => $adminQr
            ]
        );

        return $stmt;
    }

    public function update(){

        try{

            $this->conn->beginTransaction();

            $query = 'UPDATE ' .  $this->admin_acc_tb .'  
                SET 
                    adminFirstName = :adminFirstName,
                    adminMiddleName = :adminMiddleName,
                    adminLastName = :adminLastName,
                    adminEmail = :adminEmail,
                    adminPassword = :adminPassword
                WHERE adminID = :adminID
            ';
                
            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'adminFirstName'  => $this->adminFirstName,
                    'adminMiddleName' => $this->adminMiddleName,
                    'adminLastName'   => $this->adminLastName,
                    'adminEmail'      => $this->adminEmail,
                    'adminPassword'   => $this->adminPassword,
                    'adminID'         => $this->adminID,
                ]
            );

            $query = 'UPDATE ' . $this->admin_info_tb .
                ' SET 
                    brgyAdd = :brgyAdd, 
                    cityAdd = :cityAdd, 
                    contactNum = :contactNum
                WHERE adminID = :adminID
            ';

            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'adminID'         => $this->adminID,
                    'brgyAdd'         => $this->brgyAdd,
                    'cityAdd'         => $this->cityAdd,
                    'contactNum'      => $this->contactNum
                ]
            );

            $query = 'UPDATE '. $this->admin_emerg_tb . 
                ' SET
                    emergName = :emergName, 
                    emergRel = :emergRel, 
                    emergAdd = :emergAdd, 
                    emergNum = :emergNum
                WHERE adminID = :adminID
            ';

            $stmt = $this->conn->prepare($query);

            $stmt->execute(
                [
                    'adminID'         => $this->adminID,
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

        $query = 'INSERT INTO admin_trash_tb
        (
            adminID,
            adminFirstName,
            adminMiddleName,
            adminLastName,
            adminEmail,
            adminPassword,
            createdAt,
            createdBy
        )
        SELECT * FROM admin_acc_tb WHERE adminID = :adminID';
            
        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'adminID' => $this->adminID
            ]
        );

        return $stmt;
    }

    public function delete(){

        $query = 'DELETE FROM ' . $this->admin_acc_tb . ' WHERE adminID = :adminID';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'adminID' => $this->adminID
            ]
        );

        return $stmt;
    }

    public function trashBin(){

        $query = 'SELECT * FROM admin_trash_tb';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function emailExist($email){

        $query = 'SELECT * FROM ' . $this->admin_acc_tb . ' WHERE adminEmail = :adminEmail';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(['adminEmail' =>$email]);

        return $stmt;
    }

    public function emailOwner($email, $adminID){

        $query = 'SELECT * FROM ' . $this->admin_acc_tb . ' WHERE adminEmail = :adminEmail && adminID = :adminID';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'adminEmail' =>$email,
                'adminID'    =>$adminID 
            ]
        );

        return $stmt;
    }

    public function verifyAccount(){

        // $query = 'SELECT * FROM ' . $this->admin_qr_tb . ', ' . $this->admin_acc_tb . ' WHERE adminCode = :adminCode && adminPassword = :adminPassword';

        $query = 'SELECT * FROM ( admin_acc_tb INNER JOIN admin_qr_tb ON admin_acc_tb.adminID = admin_qr_tb.adminID ) WHERE admin_acc_tb.adminPassword = :adminPassword && admin_qr_tb.adminCode = :adminCode';

        // SELECT adminCode, adminPassword FROM admin_qr_tb, admin_acc_tb WHERE adminCode = '2021-ADMIN-00001-B7F52' && adminPassword = 'bonaobra_dios'

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'adminCode'         => $this->adminCode,
                'adminPassword'     => $this->adminPassword
            ]
        );

        return $stmt;
    }

    public function getCodeFromEmail(){

        $query = 'SELECT * FROM ( admin_acc_tb INNER JOIN admin_qr_tb ON admin_acc_tb.adminID = admin_qr_tb.adminID ) WHERE admin_acc_tb.adminEmail = :adminEmail';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'adminEmail'         => $this->adminEmail
            ]
        );

        return $stmt;
    }

    public function deletePwdResetData($adminEmail){

        $query = 'DELETE FROM admin_pwd_reset_tb WHERE rstEmail =:rstEmail';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'rstEmail' => $adminEmail
            ]
        );

        return $stmt;
    }

    public function insertPwdResetData($adminEmail, $verificationCode){

        $query = 'INSERT INTO admin_pwd_reset_tb (rstEmail, rstCode) VALUES (:rstEmail, :rstCode)';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'rstEmail' => $adminEmail, 
                'rstCode'  => $verificationCode
            ]
        );

        return $stmt;
    }

    public function verifyCode($verificationCode){

        $query = 'SELECT * FROM admin_pwd_reset_tb WHERE rstCode =:rstCode';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'rstCode' => $verificationCode
            ]
        );

        return $stmt;
    }

    public function updatePassword($adminConfirmedEmail, $newPassword){

        $query = 'UPDATE admin_acc_tb
                    set adminPassword = :adminPassword
                    WHERE adminEmail = :adminEmail';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'adminPassword' =>$newPassword, 
                'adminEmail'    => $adminConfirmedEmail 
            ]
        );
        
        return $stmt;
    }

    public function checkAttendance($code){

        $query = 'SELECT * FROM ' . $this->admin_qr_tb . ' WHERE adminCode = :adminCode';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'adminCode' => $code
            ]
        );

        return $stmt;

    }

    public function uploadImage($adminPic, $adminID){

        $query = 'UPDATE admin_qr_tb SET adminPic = :adminPic WHERE adminID = :adminID';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'adminPic' => $adminPic,
                'adminID' => $adminID
            ]
        );

        return $stmt;
    }

    public function checkStatusWfhScanner(){

        $query = 'SELECT * FROM wfh_status_tb';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
        
    }

    public function toggleWfhScanner($wfhStatus){
        $query = 'UPDATE wfh_status_tb SET wfhScanStatus = :wfhStatus';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'wfhStatus' => $wfhStatus
            ]
        );

        return $stmt;
    }
}

?>