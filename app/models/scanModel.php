<?php

class scanModel extends dbModel{

    private $conn;
    private $scan_tb = 'scan_tb';

    public function __construct(){
        $this->conn = $this->connect(); //function connect() from dbModel
    }

    public function read(){

        $query = 'SELECT * FROM ' . $this->scan_tb ;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function insertTimeIn($code){

        $query = 'SET time_zone = "+8:00"; INSERT INTO scan_tb(scanCode, scanDate, scanTimeIn) VALUES (:code, CURDATE(), CURTIME())';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'code' => $code
            ]
        );

        return $stmt;
    }

    public function insertTimeOut($code){

        $query = 'SET time_zone = "+8:00"; UPDATE scan_tb SET scanTimeOut = CURTIME() WHERE scanCode = :code && scanDate = CURDATE() && scanTimeOut IS NULL';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'code' => $code
            ]
        );

        return $stmt;
    }

    public function checkTimeInRecord($code){

        $query = 'SELECT * FROM scan_tb WHERE scanCode = :code && scanDate = CURDATE() && scanTimeOut IS NULL';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'code' => $code
            ]
        );

        return $stmt;
    }

    public function getTotalTimeInOneUser($userCode){

        $query = 'SELECT scanTimeIn FROM scan_tb WHERE scanCode = :code';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'code' => $userCode
            ]
        );

        return $stmt;

    }

    public function getTotalTimeOutOneUser($userCode){

        $query = 'SELECT scanTimeOut FROM scan_tb WHERE scanCode = :code && scanTimeOut IS NOT NULL';

        $stmt = $this->conn->prepare($query);

        $stmt->execute(
            [
                'code' => $userCode
            ]
        );

        return $stmt;

    }

    public function getOneRecord($userCode){

        $query = 'SELECT * FROM ' . $this->scan_tb . ' WHERE scanCode = :code';

        $stmt = $this->conn->prepare($query);
        
        $stmt->execute(
            [
                'code' => $userCode
            ]
        );

        return $stmt;
    }


}

?>