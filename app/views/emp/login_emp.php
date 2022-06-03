<div class="login-form">
    <div class="title">
        LOG IN <span id="user-type">Employee.</span>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="inputs">
        <label for="empCode" class="input-label">
            Employee ID
        </label>
            <input type="text" name="empCode" id="empCode" class="input-area" placeholder="enter your ID..." required="required">
        <label for="empPassword" class="input-label">
            Password
        </label>
            <input type="password" name="empPassword" id="empPassword" class="input-area" placeholder="enter your password..." required="required"> 
        <div class="forgot-pass">
            <a href="emp_forgot_password.php">forgot password?</a>
        </div> 
        <input type="submit" name="login" value="LOG IN" class="submit-button">
        <div class="error-div">
            <?php
                if(isset($_GET['error'])){
                    if($_GET['error'] == "invalidaccount"){
                        echo "<p class='error'>invalid account</p>";
                    }
                    if($_GET['error'] == "loginfirst"){
                        echo "<p class='error'>login first.</p>";
                    }
                    if($_GET['error'] == "pending"){
                        echo "<p class='error'>Account Pending</p>";
                    }
                }
            ?>
        </div>
    </form> 
    <div class="create-acct">
        <span id="form-sub-heading">
            Don't have an account yet? 
        </span>
        <a href="emp_register.php" id="register-btn">
            Sign up!
        </a>
    </div>
</div>
