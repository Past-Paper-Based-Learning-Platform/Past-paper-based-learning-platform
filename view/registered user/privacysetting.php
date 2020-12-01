<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>View Past Paper</title>
    <link rel="stylesheet" href="libs/main.css" type="text/css">
</head>

  <div class="container">
    <div class="tab">
        <div class="col-2-item">
        <a href='http://localhost/Main/homeindex.php?page=profilesetting.php&user_id=<?php echo $userId; ?>'><button >Profile Setting</button></a>
        </div>
        <div class="col-2-item">
        <a href='http://localhost/Main/homeindex.php?page=privacysetting.php&user_id=<?php echo $userId; ?>'><button style="background:blue;">Privacy Setting</button></a>
        </div>
        <div class="col-2-item">
        <a href='http://localhost/Main/homeindex.php?page=notificationsetting.php&user_id=<?php echo $userId; ?>'><button >Notification Setting</button></a>
        </div>

        <?php
    echo"
    <form method='POST' action='http://localhost/Main/homeindex.php'>
    
            <p>Change Password</p>
            
            <input type='hidden' name='user_id'required value='".$row['user_id']."'>

            <input type='password' name='current_pw'required value=".$row['password'].">
            
              <br><br>
          
              <input type='password' name='new_pw'placeholder='New Password'>
              <br><br>

              <input type='password' name='confirm_pw' placeholder='Confirm Password'>
         <br><br>

           
              <input type='submit' name='changepassword' value='Change Password'>
      
   
      
    
          </form>
          ";
          ?>
     </div>
  </div>
  </body>
  </html> 
