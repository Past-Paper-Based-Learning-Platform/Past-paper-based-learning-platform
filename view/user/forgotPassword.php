<!DOCTYPE html>
<?php
/*if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Register
    include '../../controller/ForgotPassword.php';
    $forgotPassword = new ForgotPassword();
    $forgotPassword->sendRecoveryPassword($_POST["email"]);
}*/
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="libs/main.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body onload="signupDisplay()">
    <div class="row container">
        <div class="col-6-item bg-lblue" style="height: 600px;">
        <div class="tab">
                <div class="col-6-item strong text-white text-center">
                    Forgot Password
                </div>
        </div>
        <div style="height: 500px;background-color: rgb(130, 150, 170)">
        <form action="" method="POST" id="forgotPWFormId">
                <div class="col-6-item">
                    <div class="col-2-item"></div>
                    <div class="col-1-item strong text-white">Email</div> 
                    <div class="col-1-item"><input type="text" placeholder="Email" id="emailid" name="email"></div>
                    <div class="col-2-item"><span style="color:red" id="emailValidationId">Invalid Email</span></div>
                </div>
                <div class="col-6-item">
                    <div class="col-2-item"></div>
                    <div class="col-1-item strong text-white">Re-enter Email</div> 
                    <div class="col-1-item"><input type="text" placeholder="Re-enter Email" id="confirmemailid" name="confirmEmail"></div>
                    <div class="col-2-item"><span style="color:red" id="confirmemailValidationId">Invalid Re-enter Email</span></div>
                </div>
                <div class="col-6-item">
                    <div class="col-2-item"></div>
                    <div class="col-2-item">
                        <button class="bg-dblue border-dblue" type="submit" id="sendRecoverPW" name="sendRecoverPW">Send Recovery Password</button>
                        <span>Check your email account</span>
                    </div>
                </div>
                <div class="col-6-item">
                    <div class="col-2-item"></div>
                    <div class="col-1-item">
                        <a href="http://localhost/Main/index.php?page=login.php">Login</a>
                    </div>
                    <div class="col-1-item">
                        <!-- <a href="#" type="submit" >To Resend Click Here</a>    -->
                        <button class="bg-dblue border-dblue" type="submit" name="sendagain">To Resend Click Here</button>
                    </div>
                </div>
             </form>
        </div>
        </div>
        <script src="libs/main.js"></script>
    <script>
        function signupDisplay(){
            var emailValidationId = document.getElementById("emailValidationId");
            emailValidationId.style.display = "none";
            var confirmemailValidationId = document.getElementById("confirmemailValidationId");
            confirmemailValidationId.style.display = "none";
        }
        
        $("#forgotPWFormId").submit(function(e) {
            var email = document.getElementById("emailid").value; 
            var confirmEmail =document.getElementById("confirmemailid").value;
             if(!email){
                var emailValidationId = document.getElementById("emailValidationId");
                emailValidationId.style.display = "block";
                var confirmemailValidationId = document.getElementById("confirmemailValidationId");
                confirmemailValidationId.style.display = "none";
                e.preventDefault();
                return;
            }
            if(!confirmEmail){
                var emailValidationId = document.getElementById("emailValidationId");
                emailValidationId.style.display = "none";
                var confirmemailValidationId = document.getElementById("confirmemailValidationId");
                confirmemailValidationId.style.display = "block";
                e.preventDefault();
                return;
            }

            //check email valid
            if(!validateEmail(email)){
                var emailValidationId = document.getElementById("emailValidationId");
                emailValidationId.style.display = "block";
                var confirmemailValidationId = document.getElementById("confirmemailValidationId");
                confirmemailValidationId.style.display = "none";
                e.preventDefault();
                return;
            }
            if(!validateEmail(confirmEmail)){
                var emailValidationId = document.getElementById("emailValidationId");
                emailValidationId.style.display = "none";
                var confirmemailValidationId = document.getElementById("confirmemailValidationId");
                confirmemailValidationId.style.display = "block";
                e.preventDefault();
                return;
            }

            //check emails are similar
            if(email!=confirmEmail){
                alter("emails arent similar");
                e.preventDefault();
            }

        });

        $(document).ready(function(){
            $("#emailid").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#emailid").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var emailValidationId = document.getElementById("emailValidationId");
                    emailValidationId.style.display = "none";
                }
            });
            $("#confirmemailid").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#confirmemailid").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var confirmemailValidationId = document.getElementById("confirmemailValidationId");
                    confirmemailValidationId.style.display = "none";
                }
            });
        });

        function validateEmail($email) {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }
    </script>
    </div>
</body>
</html>