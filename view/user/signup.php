<?php include 'view/partials/login_header.php'; ?>
    <form action="http://localhost/Main/index.php?page=signup.php" method="post" id="signupFormId">
        <!--Common details-->
        <div id="commonDataId">
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Username</div> 
                <div class="col-1-item"><input type="text" placeholder="Username" id="un_id" name="uname"></div>
                <div class="col-2-item"><span style="color:red" id="usernameValidId">Username required</span></div>
            </div>
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">First name</div> 
                <div class="col-1-item"><input type="text" placeholder="First name" name="first_name"></div>
                <div class="col-2-item"><span style="color:red" id="usernameValidId">First name required</span></div>
            </div>
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Middle name</div> 
                <div class="col-1-item"><input type="text" placeholder="Middle name" name="middle_name"></div>
                <div class="col-2-item"><span style="color:red" id="usernameValidId">Middle name required</span></div>
            </div>
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Last name</div> 
                <div class="col-1-item"><input type="text" placeholder="Last name" name="last_name"></div>
                <div class="col-2-item"><span style="color:red" id="usernameValidId">Last name required</span></div>
            </div>
            <div class="col-6-item">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Email</div> 
                <div class="col-1-item"><input type="text" placeholder="Email" id="email_id" name="email"></div>
                <div class="col-2-item"><span style="color:red" id="emailValidId">Invalid Email</span></div>
            </div>
            <div class="col-6-item">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Password</div> 
                <div class="col-1-item"><input class="password" type="password" style="password" placeholder="Password" id="pwId" name="pw"></div>
                <div class="col-2-item"><span style="color:red" id="passwordValidId">Password required</span></div>
            </div>
            <div class="col-6-item">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Re-enter Password</div> 
                <div class="col-1-item"><input class="password" type="password" style="password" placeholder="Re-enter Password" id="confirmPWId" name="confirmPW"></div>
                <div class="col-2-item"><span style="color:red" id="confirmpasswordValidId">Re-enter Password required</span></div>
            </div>
            <div class="col-5-item">
                <div class="col-3-item"></div>
                <div class="col-1-item"><button class="bg-dblue border-dblue" type="button" onclick="continueBtnFunc()">Continue</button></div>
            </div>
        </div>
        <!--lecturer details-->
        <div id="lecturerDataId">
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Designation</div> 
                <div class="col-1-item">
                    <select name="designation" id="cars">
                        <option value="lecturer">Lecturer</option>
                        <option value="instructor">Instructor</option>
                    </select>
                </div>
                <div class="col-2-item"></div>
            </div>
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Subjects</div> 
                <div class="col-2-item">
                    <div class="custom-select" id="custom-select">Select Subjects..</div>
                    <div id="custom-select-option-box" style="height: 110px; overflow: auto;">
                        <?php 
                            foreach($subjects as $subject){
                                echo "<div class='custom-select-option'> <input onchange='toggleFillColor(this);'  class='custom-select-option-checkbox' type='checkbox' name='lecSubjcts[]' value='".$subject['subject_code']."'> ".$subject['subject_name']." </div>";  
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-5-item">
                <div class="col-3-item"></div>
                <div class="col-1-item">
                    <button class="bg-dblue border-dblue" type="submit" id="lecSignUp" name="signUpBtnLec">Sign Up</button>
                </div>
            </div>
        </div>
        <!--student details-->
        <div id="stuDataId">
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Academic Year</div> 
                <div class="col-1-item">
                    <select name="year" id="cars">
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                    </select>
                </div>
                <div class="col-2-item"></div>
            </div>
            <div class="col-6-item" style="padding-botton:2px">
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Index Number</div> 
                <div class="col-1-item"><input type="text" placeholder="Index Number" id="indexNum_id" name="indexNum"></div>
                <div class="col-2-item"><span style="color:red" id="indexNumValidId">Index Number required</span></div>
            </div>
            <div class="col-6-item" >
                <div class="col-2-item"></div>
                <div class="col-1-item strong text-white">Subjects</div> 
                <div class="col-2-item">
                    <div class="custom-select-stu" id="custom-select-stu">Select Subjects..</div>
                    <div id="custom-select-option-box-stu" style="height: 67px; overflow: auto;">
                        <?php 
                            foreach($subjects as $subject){
                                echo "<div class='custom-select-option-stu'> <input onchange='toggleFillColor(this);'  class='custom-select-option-checkbox-stu' type='checkbox' name='stuSubjcts[]' value='".$subject['subject_code']."'> ".$subject['subject_name']." </div>";  
                            }
                        ?>
                    </div>
                </div>
                <div class="col-2-item"></div>
            </div>
            <div class="col-5-item">
                <div class="col-3-item"></div>
                <div class="col-1-item">
                    <button class="bg-dblue border-dblue" type="submit" id="stuSignUpStu" name="signUpBtnStu">Sign Up</button>
                </div>
            </div>
        </div>
    </form>
<?php include 'view/partials/login_footer.php'; ?>