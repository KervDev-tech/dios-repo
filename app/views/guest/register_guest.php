<div id="main">
    <div id="signup-form-div">
        <div id="form-heading-div">
            <div id="form-heading">
                SIGN UP <span id="user-type">Guest.</span>
            </div>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="signup-form">

            <span class="inputs-div-label">Account</span>

            <div class="inputs-div-divider">
                <div class="inputs-div">
                    <label for="firstName" class="input-label">First Name</label>
                    <input type="text" name="firstName" id="firstName" class="input-field" placeholder="..." minlength="2" onkeyup="letterSpaceOnly('firstName', 'fn-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="fn-error">Please enter a valid name</span>
                </div>
                <div class="inputs-div">
                    <label for="middleName" class="input-label">Middle Name</label>
                    <input type="text" name="middleName" id="middleName" class="input-field" placeholder="..." onkeyup="letterSpaceOnly('middleName', 'mn-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="mn-error">Please enter a valid name</span>
                </div>
                <div class="inputs-div">
                    <label for="lastName" class="input-label">Last Name</label>
                    <input type="text" name="lastName" id="lastName" class="input-field" placeholder="..." onkeyup="letterSpaceOnly('lastName', 'ln-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="ln-error">Please enter a valid name</span>
                </div>
                <div class="inputs-div">
                    <label for="empEmail" class="input-label">Email</label>
                    <input type="email" name="empEmail" id="empEmail" class="input-field" placeholder="..." onkeyup="validateEmail('empEmail', 'empEmail-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="empEmail-error">Please enter a valid email</span>
                </div>
            </div>

            <span class="inputs-div-label">Contact Information</span>

            <div class="inputs-div-divider">
                <div class="inputs-div">
                    <label for="brgyAdd" class="input-label">Brgy Address</label>
                    <input type="text" name="brgyAdd" id="brgyAdd" class="input-field" placeholder="..." onkeyup="letterNumSpaceOnly('brgyAdd', 'brgy-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="brgy-error">No special characters allowed, only letters, numbers and mininum of 6 characters</span>
                </div>
                <div class="inputs-div">
                    <label for="cityAdd" class="input-label">City Address</label>
                    <input type="text" name="cityAdd" id="cityAdd" class="input-field" placeholder="..." onkeyup="letterSpaceOnly('cityAdd', 'city-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="city-error">No spaces, special characters allowed and mininum of 6 characters</span>
                </div>
                <div class="inputs-div">
                    <label for="contactNum" class="input-label">Contact Number</label>
                    <input type="text" name="contactNum" id="contactNum" class="input-field" placeholder="..." onkeyup="numbersOnly('contactNum', 'contactNum-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="contactNum-error">No spaces, letters and special characters allowed</span>
                </div>
            </div>
            
            <div class="inputs-div-divider">
                <div class="inputs-div">
                    <button type="submit" name="submit" value="submit" id="signup-btn">Register</button>
                </div>
            </div>
        </form>
        <div id="query-result-div">
                <?php
                    if(isset($adminCreate)){
                        if($adminCreate == "success"){
                            echo "Submitted Succesfully";
                        }
                        else if($adminCreate == "error"){
                            echo "An error occured, please check your inputs and try again.";
                        }
                        else {
                            echo "<p>An error occured, the following error(s) are encountered:</p>";
                            for($i = 0; $i <= 12; $i++){
                                echo "<p>On textbox " . $num = $i + 1 . ", " . $adminCreate[$i] . "</p>";
                            }
                        }
                            
                    }
                ?>
        </div>
    </div>
</div>