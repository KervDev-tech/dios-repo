<div id="content-div">
            <div id="signup-form-div">
                <div id="form-heading-div">
                    <div id="form-heading">
                        REGISTER <span id="user-type">Employee.</span>
                    </div>
                    <span id="form-sub-heading">
                        Fill up the form to register an Admin
                    </span>
                    <div id="query-result-div">
                        <?php
                            if(isset($empCreate)){
                                if($empCreate == "success"){
                                    echo "<p class='success'>Created succesfully, please check your email for your code.</p>";
                                }
                                else if($empCreate == "error"){
                                    echo "<p class='error-query-label'>An error occured, please check your inputs and try again.</p>";
                                }
                                else {
                                    echo "<div class='error-query'>";
                                    echo "<p class='error-query-label'>An error occured, the following error(s) are encountered:</p>";
                                    for($i = 0; $i < count($empCreate); $i++){
                                        if(!empty($empCreate[$i])){
                                            echo "<p class='error-queries'>On textbox #" . $num = $i + 1 . ", " . $empCreate[$i] . "</p>";
                                        }
                                    }
                                    echo "</div>";
                                }
                                    
                            }
                        ?>
                    </div>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="signup-form">
    
                    <span class="inputs-div-label">Account</span>

                    <div class="inputs-div-divider">
                        <div class="inputs-div">
                            <label for="firstName" class="input-label">First Name</label>
                            <input type="text" name="firstName" id="firstName" class="input-field" placeholder="(example. Juan)" minlength="2" onkeyup="letterSpaceOnly('firstName', 'fn-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="fn-error">Please enter a valid name</span>
                        </div>
                        <div class="inputs-div">
                            <label for="middleName" class="input-label">Middle Name</label>
                            <input type="text" name="middleName" id="middleName" class="input-field" placeholder="(example. Tu)" onkeyup="letterSpaceOnly('middleName', 'mn-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="mn-error">Please enter a valid name</span>
                        </div>
                        <div class="inputs-div">
                            <label for="lastName" class="input-label">Last Name</label>
                            <input type="text" name="lastName" id="lastName" class="input-field" placeholder="(example. Thrii)" onkeyup="letterSpaceOnly('lastName', 'ln-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="ln-error">Please enter a valid name</span>
                        </div>
                        <div class="inputs-div">
                            <label for="empEmail" class="input-label">Email</label>
                            <input type="email" name="empEmail" id="empEmail" class="input-field" placeholder="(example. juantutrii@gmail.com)" onkeyup="validateEmail('empEmail', 'empEmail-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="empEmail-error">Please enter a valid email</span>
                        </div>
                        <div class="inputs-div">
                            <label for="empPassword" class="input-label">Password</label>
                            <input type="password" name="empPassword" id="empPassword" class="input-field" placeholder="..." onkeyup="validatePassword('empPassword', 'epw-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="epw-error">No spaces, special characters allowed and mininum of 6 characters</span>
                        </div>
                        <div class="inputs-div">
                            <label for="rePassword" class="input-label">Re-enter Password</label>
                            <input type="password" name="rePassword" id="rePassword" class="input-field" placeholder="..." onkeyup="validateRePassword('empPassword', 'rePassword', 'rpw-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="rpw-error">Password didn't match, try again</span>
                        </div>
                    </div>
    
                    <span class="inputs-div-label">Personal Information</span>

                    <div class="inputs-div-divider">
                        <div class="inputs-div">
                            <label for="empNum" class="input-label">Employee Number</label>
                            <input type="text" name="empNum" id="empNum" class="input-field" placeholder="(your employee number)" onkeyup="letterNumSpaceOnly('empNum', 'empNum-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="empNum-error">No special characters allowed, only letters, numbers and mininum of 6 characters</span>
                        </div>
                        <div class="inputs-div">
                            <label for="gender" class="input-label">Gender</label>
                            <div class="input-field">
                                <input type="radio" name="gender" id="gender" value="Male" onkeyup="letterSpaceOnly('gender', 'gender-error', 'signup-btn')" required="required">
                                <label for="Male" class="input-label">Male</label>
                                <input type="radio" name="gender" id="gender" value="Female" onkeyup="letterSpaceOnly('gender', 'gender-error', 'signup-btn')" required="required">
                                <label for="Male" class="input-label">Female</label>
                            </div>
                            <span class="error hidden" id="gender-error">No special characters allowed, only letters, numbers and mininum of 6 characters</span>
                        </div>
                        <div class="inputs-div">
                            <label for="birthday" class="input-label">Birthday</label>
                            <input type="date" name="birthday" id="birthday" class="input-field" required="required">
                            <span class="error hidden" id="birthday-error">No special characters allowed, only letters, numbers and mininum of 6 characters</span>
                        </div>
                        <div class="inputs-div">
                            <label for="maritalStatus" class="input-label">Marital Status</label>
                            <select name="maritalStatus" id="maritalStatus" class="input-field" onkeyup="letterSpaceOnly('maritalStatus', 'maritalStatus-error', 'signup-btn')" required="required">
                                <option value="">--Select--</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                            <span class="error hidden" id="maritalStatus-error">Please select a valid type</span>
                        </div>
                    </div>
    
                    <span class="inputs-div-label">Contact Information</span>

                    <div class="inputs-div-divider">
                        <div class="inputs-div">
                            <label for="brgyAdd" class="input-label">Brgy Address</label>
                            <input type="text" name="brgyAdd" id="brgyAdd" class="input-field" placeholder="(example. Street number and name, Baranggay)" onkeyup="letterNumSpaceOnly('brgyAdd', 'brgy-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="brgy-error">No special characters allowed, only letters, numbers and mininum of 6 characters</span>
                        </div>
                        <div class="inputs-div">
                            <label for="cityAdd" class="input-label">City Address</label>
                            <input type="text" name="cityAdd" id="cityAdd" class="input-field" placeholder="(example. City(Manila), Province(Metro Manila))" onkeyup="letterNumSpaceOnly('cityAdd', 'city-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="city-error">No spaces, special characters allowed and mininum of 6 characters</span>
                        </div>
                        <div class="inputs-div">
                            <label for="contactNum" class="input-label">Contact Number</label>
                            <input type="text" name="contactNum" id="contactNum" class="input-field" placeholder="(example. 09091234567)" onkeyup="numbersOnly('contactNum', 'contactNum-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="contactNum-error">No spaces, letters and special characters allowed</span>
                        </div>
                    </div>
    
                    <span class="inputs-div-label">Employee Information</span>

                    <div class="inputs-div-divider">
                        <div class="inputs-div">
                            <label for="department" class="input-label">Department</label>
                            <input type="text" name="department" id="department" class="input-field" placeholder="(example. IT Department)" onkeyup="letterNumSpaceOnly('department', 'department-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="department-error">No special characters allowed, only letters, numbers and mininum of 6 characters</span>
                        </div>
                        <div class="inputs-div">
                            <label for="position" class="input-label">Position</label>
                            <input type="text" name="position" id="position" class="input-field" placeholder="(example. Programmer)" onkeyup="letterNumSpaceOnly('position', 'position-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="position-error">No special characters allowed, only letters, numbers and mininum of 6 characters</span>
                        </div>
                        <div class="inputs-div">
                            <label for="telNum" class="input-label">Telephone Number</label>
                            <input type="text" name="telNum" id="telNum" class="input-field" placeholder="(example. xxxxxxxx)" onkeyup="numbersOnly('telNum', 'telNum-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="telNum-error">No spaces, letters and special characters allowed</span>
                        </div>
                    </div>
    
                    <span class="inputs-div-label">In case of Emergency</span>

                    <div class="inputs-div-divider">
                        <div class="inputs-div">
                            <label for="emergName" class="input-label">Contact name</label>
                            <input type="text" name="emergName" id="emergName" class="input-field" placeholder="(name)" onkeyup="letterSpaceOnly('emergName', 'emergName-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="emergName-error">No spaces, special characters allowed and mininum of 6 characters</span>
                        </div>
                        <div class="inputs-div">
                            <label for="emergRel" class="input-label">Relationship with the contact person</label>
                            <input type="text" name="emergRel" id="emergRel" class="input-field" placeholder="(relationship)" onkeyup="letterSpaceOnly('emergRel', 'emergRel-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="emergRel-error">No spaces, special characters allowed and mininum of 6 characters</span>
                        </div>
                        <div class="inputs-div">
                            <label for="emergNum" class="input-label">Contact Number</label>
                            <input type="text" name="emergNum" id="emergNum" class="input-field" placeholder="(contact number)" onkeyup="numbersOnly('emergNum', 'emergNum-error', 'signup-btn')" required="required">
                            <span class="error hidden" id="emergNum-error">No spaces, letters and special characters allowed</span>
                        </div>
                        <div class="inputs-div">
                            <label for="emergAdd" class="input-label">Address</label>
                            <input type="text" name="emergAdd" id="emergAdd" class="input-field" placeholder="(address)" onkeyup="letterNumSpaceOnly('emergAdd', 'emergAdd-error', 'signup-btn')" required="required">
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