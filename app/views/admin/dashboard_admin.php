<div id="header">
    <span id="burger-menu"style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
</div>
<div id="dashboard-title-div">
    <div id="dashboard-heading">
        <i class="fas fa-users-cog"></i> Dashboard
    </div>
    <div id="dashboard-subheading">
        Manage your Site.
    </div>
</div>
<div id="dashboard-section">
    <div class="dashboard-section-item" id="dashboard-overview">
        <div class="panel-title" id="dashboard-overview-title">Website Overview</div>
        <div id="dashboard-overview-items">
            <div class="overview-item">
                <i class="fas fa-user-lock"> Admins </i> <div class="total-number"><?php echo $admin->getTotalNumAdmins();?></div>
            </div>
            <div class="overview-item">
                <i class="fas fa-user"> Employees </i> <div class="total-number"><?php echo $emp->getTotalNumEmps();?></div>
            </div>
            <div class="overview-item">
                <i class="fas fa-spinner"> Pending Accounts </i> <div class="total-number"><?php echo count($emp->getTotalNumPendingAcc());?></div>
            </div>
            <div class="overview-item">
                <i class="fas fa-trash-alt"> Trash Bin </i> <div class="total-number"><?php echo $emp->getTotalNumDeletedAcc() + $admin->getTotalNumDeletedAcc();?></div>
            </div>
            <div class="overview-item">
                <i class="fas fa-clipboard"> Attendance </i> <div class="total-number"><?php echo $scan->getTotalNumAttendance();?></div>
            </div>
            <div class="overview-item">
                <i class="fas fa-paperclip"> QR Codes </i> <div class="total-number"><?php echo $num = count(glob("../../app/src/qr_dir/admin/" . "*")) + count(glob("../../app/src/qr_dir/emp/" . "*")); ?></div>
            </div>
            <div class="overview-item">
                <i class="fas fa-paperclip"> 
                    WFH Scanner Status 
                </i>
                <div class="total-number"> 
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <?php

                            $checkStatusWfhScanner = $admin->checkStatusWfhScanner();
                            
                            if($checkStatusWfhScanner == "ON"){
                                echo '<input type="submit" id="toggle-btn"  name="toggleWfhScanner" value="TURN OFF">';
                            }
                            if($checkStatusWfhScanner == "OFF"){
                                echo '<input type="submit" id="toggle-btn"  name="toggleWfhScanner" value="TURN ON">';
                            }
                        ?>
                    </form>
                    <div class="error-div">
                            <?php
                                if($toggleWfhScanner == "updated"){
                                    echo '<p class="error">Updated!</p>';
                                }
                                if($toggleWfhScanner == "error"){
                                    echo '<p class="error">Error!</p>';
                                }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-section-item" id="dashboard-pending">
        <div class="panel-title" id="dashboard-pending-title">Pending Employee Accounts</div>
        <div id="dashboard-pending-items">
            <?php
                $pendingEmp = $emp->getTotalNumPendingAcc();
                if(!count($pendingEmp) == 0){
                    foreach($pendingEmp as $value){
                        echo '<div class="right-panel-items">' . $value . '</div>';
                    }
                }
                else{
                    echo '<div class="right-panel-items">No pending accounts.</div>';
                }
            ?>
        </div>
    </div>
</div>