<div id="create-account-div">
    <div id="heading-title">Employee Account Management</div>
    <label for="create-btn" id="create-btn-label">Create an Employee Account here!</label>
    <a href="cms_emp_create.php" id="create-btn">Create</a>
        <?php

            if(isset($_GET["session"]) && !empty($_GET["session"])){

                echo '    <div id="session-result-div">';

                if($_GET["session"] == "invalid-approve"){
                    echo "Approval session is invalid, please click the edit button to proceed approval.";
                }

                if($_GET["session"] == "approved"){
                    echo "Approval success.";
                }

                if($_GET["session"] == "invalid-edit"){
                    echo "Editing session is invalid, please click the edit button to proceed editing.";
                }

                if($_GET["session"] == "updated"){
                    echo "Update success.";
                }

                if($_GET["session"] == "no-account"){
                    echo "No data found, the account might be deleted or the emp ID is invalid.";
                }

                if($_GET["session"] == "invalid-delete"){
                    echo "Deleting session is invalid, please click the delete button to proceed deleting.";
                }
                
                if($_GET["session"] == "deleted"){
                    echo "Delete success.";
                }

                echo '</div>';
            }

        ?>
    <a href="cms_export_tb.php?export=emp" id="export-btn">Export Emp Account</a>
</div>
<?php
    echo '<table id="data-tb">';
        echo"<thead>";
            echo "<td>ID</td>";
            echo "<td>EMP Code</td>";
            echo "<td>First name</td>";
            echo "<td>Middle name</td>";
            echo "<td>Last name</td>";
            echo "<td>Email</td>";
            // echo "<td>Password</td>";
            echo "<td>Created At</td>";
            echo "<td>Account Status</td>";
            echo "<td>Approved By</td>";
            echo "<td>Approve</td>";
            echo "<td>Edit</td>";
            echo "<td>Delete</td>";
        echo"</thead>";
        echo"<tbody>";
        if(!empty($empGet)){
            foreach($empGet as $value){
                echo "<tr>";
                    echo "<td>" . $value->empID ."</td>";
                    echo "<td>" . $value->empCode . "</td>";
                    echo "<td>" . $value->empFirstName . "</td>";
                    echo "<td>" . $value->empMiddleName . "</td>";
                    echo "<td>" . $value->empLastName . "</td>";
                    echo "<td>" . $value->empEmail . "</td>";
                    // echo "<td>" . password_hash( $value->empPassword , PASSWORD_DEFAULT) . "</td>";
                    echo "<td>" . $value->createdAt . "</td>";
                    echo "<td>" . $value->accStatus . "</td>";
                    echo "<td>" . $value->approvedBy . "</td>";
                    if($value->accStatus == "pending"){
                        echo '<td><a class="action" href="cms_emp_accounts.php?action=approval&empID=' . $value->empID . '">Approve</a></td>';
                    }
                    else{
                        echo '<td><a class="unavailable"href="">Unavailable</a></td>';
                    }
                    echo '<td><a class="action" href="cms_emp_accounts.php?action=edit&empID=' . $value->empID . '">Edit</a></td>';
                    echo '<td><a class="action" href="cms_emp_accounts.php?action=delete&empID=' . $value->empID . '">Delete</a></td>';
                echo "</tr>";
            }
        }
        echo "</tbody>";
    echo "</table>";
?>