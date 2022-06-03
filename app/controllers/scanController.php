<?php

class scanController{

    private $scanModel;

    public function __construct(){
        $this->scanModel = new scanModel;
    }

    public function try(){

        $data = $this->scanModel->read()->fetchAll();

        var_dump($data);
    }

    public function getAttendace(){

        $result = $this->scanModel->read();
        $row_num = $result->rowCount();
        $arr_scan = [];
    
        if($row_num > 0){
            $arr_scan = $result->fetchAll();
        }
    
        return $arr_scan;
    }

    public function getTotalNumAttendance(){

        $result = $this->scanModel->read();
        $row_num = $result->rowCount();

        return $row_num;
    }

    public function timeIn($decyptedString){

        $isTimedIn = $this->scanModel->insertTimeIn($decyptedString);

    }

    public function timeOut($decyptedString){

        $isTimedOut = $this->scanModel->insertTimeOut($decyptedString);

    }

    public function checkDailyRecord($code){

        $isCheckedIn = $this->scanModel->checkTimeInRecord($code)->fetch(PDO::FETCH_OBJ);

        if(!$isCheckedIn){

            $this->timeIn($code);

            return "Checked In";
        }
        if($isCheckedIn){

            $this->timeOut($code);

            return "Checked Out";

        }

    }

    public function getTotalTimeIn($userCode){

        $totalTimein = $this->scanModel->getTotalTimeInOneUser($userCode);

        $row_num = $totalTimein->rowCount();

        return $row_num;
    }

    public function getTotalTimeOut($userCode){

        $totalTimeOut = $this->scanModel->getTotalTimeOutOneUser($userCode);

        $row_num = $totalTimeOut->rowCount();

        return $row_num;
    }

    public function getOneRecordEmp($userCode){

        $result = $this->scanModel->getOneRecord($userCode);
        $row_num = $result->rowCount();
        $arr_scan = [];
    
        if($row_num > 0){
            $arr_scan = $result->fetchAll();
        }
    
        return $arr_scan;

    }
}

?>