<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
<a class="nav-btn" href="#"><img class="logo-pic" src="../../app/src/img/dios_logo.png" alt="DIOS LOGO"></a>
<a class="nav-btn" href="cms_admin_dashboard.php"> <i class="fas fa-chalkboard-teacher"></i> Dashboard </a>
<a class="nav-btn" href="cms_emp_accounts.php"> <i class="fas fa-user-circle"></i> Employee Management </a>
<a class="nav-btn" href="cms_admin_accounts.php"> <i class="fas fa-user-circle"></i> Admin Management</a>
<a class="nav-btn" href="cms_attendance_record.php"> <i class="fas fa-user-circle"></i> DTR Management</a>
<a class="nav-btn" href="cms_scanning.php"> <i class="fas fa-qrcode"></i> QR Code Scanning</a>
<a class="nav-btn" href="cms_admin_profile.php?id=<?php echo $_SESSION['adminID'];?>" id="admin-name"> <i class="fas fa-user-lock"></i> My Profile </a>
<div class="nav-btn" id="admin-logout">
    <form method="post">
        <i class="fas fa-sign-out-alt"></i><input type="submit" name="logout" id="logout-btn" value="Logout">
    </form>
</div>