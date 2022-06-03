<div id="content-div">
    <div id="signup-form-div">
        <div id="form-heading-div">
            <div id="form-heading">
                CREATE <span id="user-type">Admin.</span>
            </div>
            <span id="form-sub-heading">
                Fill up the form to register an Admin
            </span>
            <div id="query-result-div">
                <?php
                    if(isset($adminCreate)){
                        if($adminCreate == "success"){
                            echo "<p class='success'>Created succesfully, please check the registered email for log-in credentials.</p>";
                        }
                        else if($adminCreate == "error"){
                            echo "<p class='error-query-label'>An error occured, please check your inputs and try again.</p>";
                        }
                        else {
                            echo "<div class='error-query'>";
                            echo "<p class='error-query-label'>An error occured, the following error(s) are encountered:</p>";
                            for($i = 0; $i < count($adminCreate); $i++){
                                if(!empty($adminCreate[$i])){
                                    echo "<p class='error-queries'>On textbox #" . $num = $i + 1 . ", " . $adminCreate[$i] . "</p>";
                                }
                            }
                            echo "</div>";
                        }
                            
                    }
                ?>
            </div>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
            <span class="inputs-div-label">Account</span>

            <div class="inputs-div-divider">
                <div class="inputs-div">
                    <label for="firstName" class="input-label">First Name </label>
                    <input type="text" name="firstName" id="firstName" class="input-field" placeholder="(example. Juan)" minlength="2" onkeyup="letterSpaceOnly('firstName', 'fn-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="fn-error">Please enter a valid name</span>
                </div>
                <div class="inputs-div">
                    <label for="middleName" class="input-label">Middle Name </label>
                    <input type="text" name="middleName" id="middleName" class="input-field" placeholder="(example. Juancho)" onkeyup="letterSpaceOnly('middleName', 'mn-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="mn-error">Please enter a valid name</span>
                </div>
                <div class="inputs-div">
                    <label for="lastName" class="input-label">Last Name </label>
                    <input type="text" name="lastName" id="lastName" class="input-field" placeholder="(example. Dela Cruz)" onkeyup="letterSpaceOnly('lastName', 'ln-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="ln-error">Please enter a valid name</span>
                </div>
                <div class="inputs-div">
                    <label for="adminEmail" class="input-label">Email </label>
                    <input type="email" name="adminEmail" id="adminEmail" class="input-field" placeholder="(example. juandelacruz@gmail.com)" onkeyup="validateEmail('adminEmail', 'ae-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="ae-error">Please enter a valid email</span>
                </div>
                <div class="inputs-div">
                    <label for="adminPassword" class="input-label">Password</label>
                    <input type="password" name="adminPassword" id="adminPassword" class="input-field" placeholder="..." onkeyup="validatePassword('adminPassword', 'apw-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="apw-error">No spaces, special characters allowed and mininum of 6 characters</span>
                </div>
                <div class="inputs-div">
                    <label for="rePassword" class="input-label">Re-enter Password</label>
                    <input type="password" name="rePassword" id="rePassword" class="input-field" placeholder="..." onkeyup="validateRePassword('adminPassword', 'rePassword', 'rpw-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="rpw-error">Password didn't match, try again</span>
                </div>
            </div>

            <span class="inputs-div-label">Contact Information</span>

            <div class="inputs-div-divider">
                <div class="inputs-div">
                    <label for="brgyAdd" class="input-label">Brgy Address  </label>
                    <input type="text" name="brgyAdd" id="brgyAdd" class="input-field" placeholder="(example. 1 Juana St Brgy Anonas)" onkeyup="letterNumSpaceOnly('brgyAdd', 'brgy-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="brgy-error">No special characters allowed, only letters, numbers and mininum of 6 characters</span>
                </div>
                <div class="inputs-div">
                    <label for="cityAdd" class="input-label">City Address  </label>
                    <input type="text" name="cityAdd" id="cityAdd" class="input-field" placeholder="(example. Sta Mesa Manila)" onkeyup="letterSpaceOnly('cityAdd', 'city-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="city-error">No spaces, special characters allowed and mininum of 6 characters</span>
                </div>
                <div class="inputs-div">
                    <label for="contactNum" class="input-label">Contact Number  </label>
                    <input type="text" name="contactNum" id="contactNum" class="input-field" placeholder="(example. 09091234567)" onkeyup="numbersOnly('contactNum', 'contactNum-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="contactNum-error">No spaces, letters and special characters allowed</span>
                </div>
            </div>
            
            <span class="inputs-div-label">In case of Emergency</span>

            <div class="inputs-div-divider">
                <div class="inputs-div">
                    <label for="emergName" class="input-label">Contact name  </label>
                    <input type="text" name="emergName" id="emergName" class="input-field" placeholder="(example. Juana Dela Cruz)" onkeyup="letterSpaceOnly('emergName', 'emergName-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="emergName-error">No spaces, special characters allowed and mininum of 6 characters</span>
                </div>
                <div class="inputs-div">
                    <label for="emergRel" class="input-label">Relationship with the contact person  </label>
                    <input type="text" name="emergRel" id="emergRel" class="input-field" placeholder="(example. Sister)" onkeyup="letterSpaceOnly('emergRel', 'emergRel-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="emergRel-error">No spaces, special characters allowed and mininum of 6 characters</span>
                </div>
                <div class="inputs-div">
                    <label for="emergNum" class="input-label">Contact Number  </label>
                    <input type="text" name="emergNum" id="emergNum" class="input-field" placeholder="(example. 09091234567)" onkeyup="numbersOnly('emergNum', 'emergNum-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="emergNum-error">No spaces, letters and special characters allowed</span>
                </div>
                <div class="inputs-div">
                    <label for="emergAdd" class="input-label">Address  </label>
                    <input type="text" name="emergAdd" id="emergAdd" class="input-field" placeholder="(example. 1 Juana St Brgy Anonas Sta Mesa Manila)" onkeyup="letterNumSpaceOnly('emergAdd', 'emergAdd-error', 'signup-btn')" required="required">
                    <span class="error hidden" id="emergAdd-error">No spaces, special characters allowed and mininum of 6 characters</span>
                </div>
            </div>
            
            <div class="inputs-div-divider">
                <div class="inputs-div">
                    <button type="submit" name="submit" value="submit" id="signup-btn">Create Account</button>
                    <div id="agreement-div">By creating an account you agree to our <a href="#" id="terms-conditions-link">Terms and Conditions</a>.</div>
                </div>
            </div>
            
        </form>
    </div>
</div>