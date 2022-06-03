<?php


session_start();

include_once '../../app/includes/autoLoad.php';

$admin = new adminController;

$scan = new scanController;

$adminSession = $admin->checkSession();

$emp = new empController;


if ($_SERVER["REQUEST_METHOD"] == "GET") {
            
    if(isset($_GET["export"])){

        $exportData = $_GET["export"];

        if($exportData == "admin"){

            $adminData = $admin->getAdmin();

            $fileName = "admin_accounts_" . date('Y-m-d') . ".xls";

            $output = '';

            $output .='<table id="data-tb" border="1">
                <tr>
                    <th>ID</th>
                    <th>Admin Code</th>
                    <th>First name</th>
                    <th>Middle name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Created By</th>
                    <th>Created At</th>
                </tr>';
                if(!empty($adminData)){
                    foreach($adminData as $value){
                        $output .='<tr>
                            <td>' . $value->adminID . '</td>
                            <td>' . $value->adminCode. '</td>
                            <td>' . $value->adminFirstName . '</td>
                            <td>' . $value->adminMiddleName . '</td>
                            <td>' . $value->adminLastName . '</td>
                            <td>' . $value->adminEmail . '</td>
                            <td>' . $value->createdBy . '</td>
                            <td>' . $value->createdAt . '</td>
                        </tr>';
                    }
                }
                $output .='</table>';
    

    
            header("Content-Type: application/vnd.ms-excel"); 
            header("Content-Disposition: attachment; filename=\"$fileName\"");
            echo $output;
        }

        if($exportData == "emp"){

            $empData = $emp->getEmp();

            $fileName = "emp_accounts_" . date('Y-m-d') . ".xls";

            $output = '';

            $output .='<table id="data-tb" border="1">
                <tr>
                    <th>ID</th>
                    <th>EMP Code</th>
                    <th>First name</th>
                    <th>Middle name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Account Status</th>
                    <th>Approved By</th>
                </tr>';
                if(!empty($empData)){
                    foreach($empData as $value){
                        $output .='<tr>
                            <td>' . $value->empID . '</td>
                            <td>' . $value->empCode . '</td>
                            <td>' . $value->empFirstName . '</td>
                            <td>' . $value->empMiddleName . '</td>
                            <td>' . $value->empLastName . '</td>
                            <td>' . $value->empEmail . '</td>
                            <td>' . $value->createdAt . '</td>
                            <td>' . $value->accStatus . '</td>
                            <td>' . $value->approvedBy . '</td>
                        </tr>';
                    }
                }
                $output .='</table>';
    

    
            header("Content-Type: application/vnd.ms-excel"); 
            header("Content-Disposition: attachment; filename=\"$fileName\"");
            echo $output;
        }

        if($exportData == "dtr"){

            $dtrData = $scan->getAttendace();

            $fileName = "dtr_records_" . date('Y-m-d') . ".xls";

            $output = '';

            $output .='<table id="data-tb" border="1">
                <tr>
                    <th>ID</th>
                    <th>User Code</th>
                    <th>Scan Date</th>
                    <th>Scan Time In</th>
                    <th>Scan Time Out</th>
                </tr>';
                if(!empty($dtrData)){
                    foreach($dtrData as $value){
                        $output .='<tr>
                            <td>' . $value->scanID . '</td>
                            <td>' . $value->scanCode . '</td>
                            <td>' . $value->scanDate . '</td>
                            <td>' . $value->scanTimeIn . '</td>
                            <td>' . $value->scanTimeOut . '</td>
                        </tr>';
                    }
                }
                $output .='</table>';
    

    
            header("Content-Type: application/vnd.ms-excel"); 
            header("Content-Disposition: attachment; filename=\"$fileName\"");
            echo $output;
        }

    }
}

?>