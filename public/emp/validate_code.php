<?php

function is_base64($s){
    // Check if there are valid base64 characters
    if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $s)) return false;

    // Decode the string in strict mode and check the results
    $decoded = base64_decode($s, true);
    if(false === $decoded) return false;

    // Encode the string again
    if(base64_encode($decoded) != $s) return false;

    return true;
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if(isset($_POST['code'])){

        include_once '../../app/includes/autoLoad.php';

        $emp = new empController;

        $admin = new adminController;

        $scan = new scanController;

        $userCode = $_POST['code'];

        $plusDecodedString = str_replace("plus", "+", $userCode);

        $isInvalid = array('lastName' => 'invalid', 'userType' => 'invalid', 'userPic' => 'invalid', 'activity' => 'invalid');

        if(is_base64($plusDecodedString)){

            $isValidEmp = $emp->validateCode($plusDecodedString);
        
            $isValidAdmin = $admin->validateCode($plusDecodedString);
    
            if($isValidEmp){
    
                $activity = $scan->checkDailyRecord($isValidEmp['code']);

                array_push($isValidEmp, $isValidEmp['activity'] = $activity);
                
                echo json_encode($isValidEmp);
    
            }
            else if ($isValidAdmin){

                $activity = $scan->checkDailyRecord($isValidAdmin['code']);

                array_push($isValidAdmin, $isValidAdmin['activity'] = $activity);
    
                echo json_encode($isValidAdmin);

            }
            else {
                
                echo json_encode($isInvalid);
            }
        }
        else{

            echo json_encode($isInvalid);

        }
    }
}

?>