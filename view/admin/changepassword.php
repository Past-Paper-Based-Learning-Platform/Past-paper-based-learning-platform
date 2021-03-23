<?php 
 //   define('BASE_URL','http://localhost/Main/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administrator - Change Password</title>
    <link rel="stylesheet" href="http://localhost/Main/libs/main.css" type="text/css">
    <style>
        div.trans {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-6-item page-title bg-lblue">
            Administrator
            <div style="float:right; font-size:16px">
                <a href="http://localhost/Main/view/admin/adminhome.php" style="text-decoration:none">Back to Home Page</a>&nbsp;
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-5-item bg-gray" style="height: 610px;">
            <div class="container text-white"style="font-size: 24px">
                Change Password<hr>
            </div>
            <div class="col-1-item"></div>
            <div class="col-3-item trans">
                <form action="">
                    <div class="col-2-item strong text-white">Current Password:</div>
                    <div class="col-4-item">
                        <input type="password" name="currentpass" value="">
                    </div>
                    <div class="col-2-item strong text-white">New Password:</div>
                    <div class="col-4-item">
                        <input type="password" name="newpass" value="">
                    </div>
                    <div class="col-2-item strong text-white">Confirm Password:</div>
                    <div class="col-4-item">
                        <input type="password" name="confirmpass" value="">
                    </div>
                    <div class="col-2-item" style="float: right;">
                        <button class="bg-green border-green" type="submit">Change Password</button>  
                    </div>  
                </form>
            </div>
        </div>
        <div class="col-1-item bg-gray" style="height: 610px;">
            <div class="container-fit-vertical bg-lgray strong">
                Notifications
            </div>
            <div class="container-fit-vertical bg-white text-gray auto-scroll" style="height: 530px;">
                &lt;Notification list&gt;
            </div>
        </div>
    </div>
</body>
</html>