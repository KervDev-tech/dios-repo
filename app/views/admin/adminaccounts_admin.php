<div id="create-account-div">
    <div id="heading-title">Admin Account Management</div>
    <label for="create-btn" id="create-btn-label">Create an Admin Account here!</label>
    <a href="cms_admin_create.php" id="create-btn">Create</a>
        <?php

            if(isset($_GET["session"]) && !empty($_GET["session"])){

                echo '    <div id="session-result-div">';

                if($_GET["session"] == "invalid-edit"){
                    echo "Editing session is invalid, please click the edit button to proceed editing.";
                }

                if($_GET["session"] == "updated"){
                    echo "Update success.";
                }

                if($_GET["session"] == "no-account"){
                    echo "No data found, the account might be deleted or the admin ID is invalid.";
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
    <a href="cms_export_tb.php?export=admin" id="export-btn">Export Admin Account</a>
</div>
<?php
    echo '<table id="data-tb">';
        echo"<thead>";
            echo "<td>ID</td>";
            echo "<td>Admin Code</td>";
            echo "<td>First name</td>";
            echo "<td>Middle name</td>";
            echo "<td>Last name</td>";
            echo "<td>Email</td>";
            // echo "<td>Password</td>";
            echo "<td>Created By</td>";
            echo "<td>Created At</td>";
            echo "<td>Edit</td>";
            echo "<td>Delete</td>";
        echo"</thead>";
        echo"<tbody>";
        if(!empty($adminGet)){
            foreach($adminGet as $value){
                echo "<tr>";
                    echo "<td>" . $value->adminID ."</td>";
                    echo "<td>" . $value->adminCode. "</td>";
                    echo "<td>" . $value->adminFirstName . "</td>";
                    echo "<td>" . $value->adminMiddleName . "</td>";
                    echo "<td>" . $value->adminLastName . "</td>";
                    echo "<td>" . $value->adminEmail . "</td>";
                    // echo "<td>" . password_hash( $value->adminPassword , PASSWORD_DEFAULT) . "</td>";
                    echo "<td>" . $value->createdBy . "</td>";
                    echo "<td>" . $value->createdAt . "</td>";
                    echo '<td><a class="action" href="cms_admin_accounts.php?action=edit&adminID=' . $value->adminID . '">Edit</a></td>';

                    if($value->adminID == $_SESSION['adminID']){
                        echo '<td><a class="unavailable" href="">Unavailable</a></td>';
                    }
                    else{
                        echo '<td><a class="action" href="cms_admin_accounts.php?action=delete&adminID=' . $value->adminID . '">Delete</a></td>';
                    }
                echo "</tr>";
            }
        }
        echo "</tbody>";
    echo "</table>";
?>