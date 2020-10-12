<!DOCTYPE html>
<?php
include '../../model/SignUp.php';
$signup = new SignUp();
$subjects = $signup->getSubjects();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['confirmPW'])){
        include '../../model/SignUp.php';
        //Register
        $signup = new SignUp();
        $signup->signUpMember();
    }else{
        //Login
        if (!empty($_POST["email_un"]) && !empty($_POST["password"])) {
            include '../../model/Login.php';
            $login = new Login();
        
            $username = $login->loginMember($_POST["email_un"], $_POST["password"]);
            if(isset($username)){
                header("Location: ../template.php?username=".$username); 
            }else{
                $loginerr = "Login failed. please try again";
            }
        }
    }
    
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../../libs/main.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body onload="signupDisplay()">
    <div class="row container">
        <div class="col-6-item bg-lblue" style="height: 600px;">
            <div class="tab">
                <div class="col-2-item">
                    <button id="defaulttab" class="tablinks" onclick="openTab(event, 'loginTab')" >Login</button>
                </div>
                <div class="col-2-item">
                    <button class="tablinks" onclick="openTab(event, 'signupTab'); signupDisplay()" >Signup</button>
                </div>
            </div>

            <div id="loginTab" class="tabcontent" style="height: 500px;">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="loginFormId">
                    <div class="col-6-item">
                        <div class="col-2-item"></div>
                        <div class="col-1-item strong text-white">Email/Username</div> 
                        <div class="col-1-item"><input type="text" placeholder="Email/Username" id="email_un_id" name="email_un"></div>
                        <div class="col-2-item"><span style="color:red" id="unValidationId">Email/Username required</span></div>
                    </div>
                    <div class="col-6-item">
                        <div class="col-2-item"></div>
                        <div class="col-1-item strong text-white">Password</div> 
                        <div class="col-1-item"><input class="password" type="password" style="password" placeholder="Password" id="passwordId" name="password"></div>
                        <div class="col-2-item"><span style="color:red" id="pwValidationId">Password required</span></div>
                    </div>
                    <div class="col-5-item">
                        <div class="col-3-item"></div>
                        <div class="col-1-item">
                            <button class="bg-dblue border-dblue" type="submit" name="loginBtn" id="loginBtn">Login</button>
                        </div>
                        <div class="col-1-item"></div>
                    </div>
                    <div class="col-5-item">
                        <div class="col-3-item"></div>
                        <div class="col-2-item">
                         <input style="background: transparent; border: none;color:red;width:100%" type"text" name="loginerr" id="loginerrId" value = "<?php echo (isset($loginerr))?$loginerr:'';?>">
                        </div>
                    </div>
                </form>
                <div class="col-6-item">
                    <div class="col-2-item"></div>
                    <div class="col-2-item">
                        <a href="forgotPassword.php">Forgot Password</a>
                    </div>
                    <div class="col-1-item">
                        <a href="#" onclick="openTab(event, 'signupTab'); signupDisplay()">Sign up</a>   
                    </div>
                </div>
            </div>
            
            <div id="signupTab" class="tabcontent" style="height: 500px;">
            <form action="" method="post" id="signupFormId">
                <div id="commonDataId">
                        <div class="col-6-item" style="padding-botton:2px">
                            <div class="col-2-item"></div>
                            <div class="col-1-item strong text-white">Username</div> 
                            <div class="col-1-item"><input type="text" placeholder="Username" id="un_id" name="uname"></div>
                            <div class="col-2-item"><span style="color:red" id="usernameValidId">Username required</span></div>
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
                   <div id="lecturerDataId">
                        <div class="col-6-item" style="padding-botton:2px">
                            <div class="col-2-item"></div>
                            <div class="col-1-item strong text-white">Designation</div> 
                            <div class="col-1-item">
                                <select name="designation" id="cars">
                                    <option value="volvo">des1</option>
                                    <option value="saab">des2</option>
                                    <option value="opel">des3</option>
                                    <option value="audi">des4</option>
                                </select>
                            </div>
                            <div class="col-2-item"></div>
                        </div>
                        <div class="col-6-item" style="padding-botton:2px">
                            <div class="col-2-item"></div>
                            <div class="col-1-item strong text-white">Subjects</div> 
                            <div class="col-1-item">
                                <select name="subject" id="cars">
                                    <?php 
                                    foreach($subjects as $subject){
                                        echo "<option value='".$subject['subject_code']."'>".$subject['subject_name']."</option>";
                                        
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-2-item"></div>
                        </div>
                        <div class="col-5-item">
                            <div class="col-3-item"></div>
                            <div class="col-1-item">
                                <button class="bg-dblue border-dblue" type="submit" id="lecSignUp" name="signUpBtnLec">Sign Ups</button>
                            </div>
                        </div>
                    </div>

                    <div id="stuDataId">
                        <div class="col-6-item" style="padding-botton:2px">
                            <div class="col-2-item"></div>
                                <div class="col-1-item strong text-white">Academic Year</div> 
                                <div class="col-1-item">
                                    <select name="year" id="cars">
                                        <option value="volvo">2020</option>
                                        <option value="saab">2019</option>
                                        <option value="opel">2018</option>
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
                            <div class="col-6-item" style="padding-botton:2px">
                                <div class="col-2-item"></div>
                                <div class="col-1-item strong text-white">Subjects</div> 
                                <div class="col-1-item">
                                    <select name="subject" id="cars">
                                        <?php 
                                        foreach($subjects as $subject){
                                            echo "<option value='".$subject['subject_code']."'>".$subject['subject_name']."</option>";
                                            
                                        }
                                        ?>
                                    </select>
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
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- The actual snackbar -->
    <div id="snackbar">User Successfully Signed up...</div> 

    <script src="../../libs/main.js"></script>
    <script>
        function signupDisplay(){
            var studentData = document.getElementById("stuDataId");
            studentData.style.display = "none";
            var lecturerData = document.getElementById("lecturerDataId");
            lecturerData.style.display = "none";
            var commonData = document.getElementById("commonDataId");
            commonData.style.display = "block";
            var unValidationId = document.getElementById("unValidationId");
            unValidationId.style.display = "none";
            var pwValidationId = document.getElementById("pwValidationId");
            pwValidationId.style.display = "none";
            var usernameValidId = document.getElementById("usernameValidId");
            usernameValidId.style.display = "none";
            var emailValidId = document.getElementById("emailValidId");
            emailValidId.style.display = "none";
            var passwordValidId = document.getElementById("passwordValidId");
            passwordValidId.style.display = "none";
            var confirmpasswordValidId = document.getElementById("confirmpasswordValidId");
            confirmpasswordValidId.style.display = "none";
            var indexNumValidId = document.getElementById("indexNumValidId");
            indexNumValidId.style.display = "none";
        }
        function continueBtnFunc() {
            var studentData = document.getElementById("stuDataId");
            studentData.style.display = "none";
            var lecturerData = document.getElementById("lecturerDataId");
            lecturerData.style.display = "none";
            var username = document.getElementById("un_id").value;
            var password = document.getElementById("pwId").value;
            var reenterpw = document.getElementById("confirmPWId").value;

            var email = document.getElementById("email_id").value; 
            
            if(!email.includes("lec") && !email.includes("stu")){
                var emailValidId = document.getElementById("emailValidId");
                emailValidId.style.display = "block";
                return;
            }

            //check email valid
            if(!validateEmail(email)){
                var emailValidId = document.getElementById("emailValidId");
                emailValidId.style.display = "block";
                return;
            }

            //check username, password and re-enter password empty
            if(!username){
                var usernameValidId = document.getElementById("usernameValidId");
                usernameValidId.style.display = "block";
                return;
            }
            if(!password){
                var passwordValidId = document.getElementById("passwordValidId");
                passwordValidId.style.display = "block";
                return;
            }
            if(!reenterpw){
                var confirmpasswordValidId = document.getElementById("confirmpasswordValidId");
                confirmpasswordValidId.style.display = "block";
                return;
            }

            //check password and re-enter password are similar
            if(password!=reenterpw){
                alert("password and re-enter password does not match");
                return;
            }
            
            var commonData = document.getElementById("commonDataId");
            commonData.style.display = "none";

            if(email.includes("lec")){
                var lecturerData = document.getElementById("lecturerDataId");
                lecturerData.style.display = "block";
            }else if(email.includes("stu")){
                var studentData = document.getElementById("stuDataId");
                studentData.style.display = "block";
            }
        }
       
        $("#loginFormId").submit(function(e) {
            var email = document.getElementById("email_un_id").value; 
            var pw =document.getElementById("passwordId").value;
             if(!email){
                var unValidationId = document.getElementById("unValidationId");
                unValidationId.style.display = "block";
                var pwValidationId = document.getElementById("pwValidationId");
                pwValidationId.style.display = "none";
                e.preventDefault();
                return;
            }
            if(!pw){
                var unValidationId = document.getElementById("unValidationId");
                unValidationId.style.display = "none";
                var pwValidationId = document.getElementById("pwValidationId");
                pwValidationId.style.display = "block";
                e.preventDefault();
                return;
            }
        });
        $(document).ready(function(){
            $("#email_un_id").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#email_un_id").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var unValidationId = document.getElementById("unValidationId");
                    unValidationId.style.display = "none";
                    var loginerr = document.getElementById("loginerrId");
                    loginerr.style.display = "none";
                }
            });

            $("#passwordId").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#passwordId").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var pwValidationId = document.getElementById("pwValidationId");
                    pwValidationId.style.display = "none";
                    var loginerr = document.getElementById("loginerrId");
                    loginerr.style.display = "none";
                }
            });

            $("#un_id").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#passwordId").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var usernameValidId = document.getElementById("usernameValidId");
                    usernameValidId.style.display = "none";
                }
            });
            
            $("#email_id").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#passwordId").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var emailValidId = document.getElementById("emailValidId");
                    emailValidId.style.display = "none";
                }
            });
            
            $("#pwId").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#pwId").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var passwordValidId = document.getElementById("passwordValidId");
                    passwordValidId.style.display = "none";
                }
            });
            
            $("#confirmPWId").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#passwordId").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var confirmpasswordValidId = document.getElementById("confirmpasswordValidId");
                    confirmpasswordValidId.style.display = "none";
                }
            });

            $("#indexNum_id").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#indexNum_id").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var indexNumValidId = document.getElementById("indexNumValidId");
                    indexNumValidId.style.display = "none";
                }
            });
        });

        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }

        $("#signupFormId").submit(function(e) {
            var index = document.getElementById("indexNum_id").value; 
            var email = document.getElementById("email_id").value; 
            if(!index && email.includes("stu")){
                var indexNumValidId = document.getElementById("indexNumValidId");
                indexNumValidId.style.display = "block";
                e.preventDefault();
                return;
            }

            toasFunction();
            e.preventDefault();
        });

        function toasFunction() {
            
            // Get the snackbar DIV
            var x = document.getElementById("snackbar");
        
            // Add the "show" class to DIV
            x.className = "show";
        
            // After 3 seconds, remove the show class from DIV
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
            location.reload(); 
        } 
    </script>
    </div>
 </body>
</html>    