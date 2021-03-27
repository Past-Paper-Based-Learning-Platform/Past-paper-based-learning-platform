<!DOCTYPE html>
<?php
include_once  'controller/userController.php';		
$controller = new userController();	

if($_SERVER["REQUEST_METHOD"] == "POST"){
   $success = $controller->sendRecoveryPassword($_GET['email'], $_POST["newPw"]);
   
   if(!$success) {
    //echo "Mailer Error: " . $mail->ErrorInfo;
    echo '<script type="text/javascript">'; 
    echo 'alert("Recovery Password failed");'; 
    echo 'window.location.href = "http://localhost/Main/index.php?page=resetPassword.php&email="'.$_GET['email'].';';
    echo '</script>';
 } else {
    echo '<script type="text/javascript">'; 
    echo 'alert("Recovery Password successful");'; 
    echo 'window.location.href = "http://localhost/Main/index.php?page=login.php";';
    echo '</script>';
 }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="libs/main.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body onload="pageLoad()">
    <div class="row container">
        <div class="col-6-item bg-lblue" style="height: 600px;">
        <div class="tab">
                <div class="col-6-item strong text-white text-center">
                    Reset Password
                </div>
        </div>
        <div style="height: 500px;background-color: rgb(130, 150, 170)">
        <form action="" method="POST" id="resetPWFormId">
                <div class="col-6-item">
                    <div class="col-2-item"></div>
                    <div class="col-1-item strong text-white">New Password</div> 
                    <div class="col-1-item"><input type="password" placeholder="New Password" id="newPWId" name="newPw"></div>
                    <div class="col-2-item"><span style="color:red" id="newPWvalidationId">Invalid New Password</span></div>
                </div>
                <div class="col-6-item">
                    <div class="col-2-item"></div>
                    <div class="col-1-item strong text-white">Confirm Password</div> 
                    <div class="col-1-item"><input type="password" placeholder="Confirm Password" id="confirmPwid" name="confirmPW"></div>
                    <div class="col-2-item"><span style="color:red" id="confirmPwValidationId">Invalid Confirm Password</span></div>
                </div>
                <div class="col-6-item">
                    <div class="col-2-item"></div>
                    <div class="col-2-item">
                        <button class="bg-dblue border-dblue" type="submit" id="resetPW" name="resetPW">Reset Password</button>
                    </div>
                </div>
                <input type="text" id="hideTextId" name="emailtext" style="display:none">
             </form>
        </div>
        </div>
        <script src="../../libs/main.js"></script>
    <script>
        function pageLoad(){
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const userMail = urlParams.get('email')
            document.getElementById("hideTextId").value = userMail; 

            var emailValidationId = document.getElementById("newPWvalidationId");
            emailValidationId.style.display = "none";
            var confirmemailValidationId = document.getElementById("confirmPwValidationId");
            confirmemailValidationId.style.display = "none";
        }
        
        $("#resetPWFormId").submit(function(e) {
            var password = document.getElementById("newPWId").value; 
            var confirmPw =document.getElementById("confirmPwid").value;
             if(!password){
                var pwValidationId = document.getElementById("newPWvalidationId");
                pwValidationId.style.display = "block";
                var confirmPwId = document.getElementById("confirmPwValidationId");
                confirmPwId.style.display = "none";
                e.preventDefault();
                return;
            }
            if(!confirmPw){
                var pwValidationId = document.getElementById("newPWvalidationId");
                pwValidationId.style.display = "none";
                var confirmPwId = document.getElementById("confirmPwValidationId");
                confirmPwId.style.display = "block";
                e.preventDefault();
                return;
            }

            //check passwords are similar
            if(password!=confirmPw){
                alert("passwords are not similar");
                e.preventDefault();
            }

        });

        $(document).ready(function(){
            $("#newPWId").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#newPWId").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var emailValidationId = document.getElementById("newPWvalidationId");
                    emailValidationId.style.display = "none";
                }
            });
            $("#confirmPwid").keyup(function(e){
                var c = String.fromCharCode(e.which);
                //process the single character or
                var textValue = $("#confirmPwid").val();
                var fulltext = textValue + c;
                if(fulltext.length>=1){
                    var confirmemailValidationId = document.getElementById("confirmPwValidationId");
                    confirmemailValidationId.style.display = "none";
                }
            });
        });

    </script>
    </div>
</body>
</html>