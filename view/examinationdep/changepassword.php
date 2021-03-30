<?php 
   // define('BASE_URL','http://localhost/Main/');
    if(!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Examination Department - Change Password</title>
    <link rel="stylesheet" href="http://localhost/Main/libs/main.css" type="text/css">
    <style>
        div.trans {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-6-item page-title text-white">
            Examination Department
            <div style="float:right; font-size:16px">
                <a href="http://localhost/Main/examindex.php" style="text-decoration:none; color: white">Back to Home Page</a>&nbsp;
            </div>
        </div>
    </div>
    <div class="row container"><hr>

        <div class="col-5-item" style="height: 610px;">
            <div class="container text-white"style="font-size: 24px">
                Change Password<hr>
            </div>
            <div class="col-1-item"></div>
            <div class="col-3-item trans">
                <form name="frmChange" method="post" action="http://localhost/Main/examindex.php?page=changepassword.php" onSubmit="return validatePassword()">
                    <div class="col-2-item strong text-white">Current Password:</div>
                    <div class="col-4-item">
                        <input type="password" name="currentpass" value="" id="currentPassword">
                    </div>
                    <div class="col-2-item strong text-white">New Password:</div>
                    <div class="col-4-item">
                        <input type="password" name="newpass" value="" id="newPassword">
                    </div>
                    <div class="col-2-item strong text-white">Confirm Password:</div>
                    <div class="col-4-item">
                        <input type="password" name="confirmpass" value="" id="confirmPassword">
                    </div>
                    <div class="col-2-item" style="float: right;">
                        <button class="gradient-green border-green" type="submit" name="changepwd" id="changepwd">Change Password</button>  
                    </div>
                </form>
            </div>
        </div>
        <div class="col-1-item" style="height: 610px;">
            <div class="container-fit-vertical gradient-hot text-white">
                Notifications
            </div>
            <div class="container-fit-vertical trans text-gray auto-scroll" style="height: 540px;">
                &lt;Notification list&gt;
            </div>
        </div>
    </div>
    <script>
        function validatePassword() {
            var currentPassword,newPassword,confirmPassword,output = true;

            currentPassword = document.frmChange.currentPassword;
            newPassword = document.frmChange.newPassword;
            confirmPassword = document.frmChange.confirmPassword;

            if(!currentPassword.value) {
            currentPassword.focus();
            document.getElementById("currentPassword").innerHTML = "required";
            output = false;
            }
            else if(!newPassword.value) {
            newPassword.focus();
            document.getElementById("newPassword").innerHTML = "required";
            output = false;
            }
            else if(!confirmPassword.value) {
            confirmPassword.focus();
            document.getElementById("confirmPassword").innerHTML = "required";
            output = false;
            }
            if(newPassword.value != confirmPassword.value) {
            newPassword.value="";
            confirmPassword.value="";
            newPassword.focus();
            document.getElementById("confirmPassword").innerHTML = "not same";
            output = false;
            alert("Re-entered Password does not match!");
            } 	
            return output;
        }
    </script>
</body>
</html>