<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Setting</title>
    <link rel="stylesheet" href="libs/main.css" type="text/css">
</head>

  <div class="container">
  <section class = 'logohead'>
            <a href='http://localhost/Main/lecturerindex.php?page=lecturerHome.php'><img src= 'pictures/logoPPB.png' class='logoimg'></a>
            <h1 class="sitename">Past Paper Base Learning PlatForm</h1>
        </section>
    <div class="tab">
        <div class="col-2-item">
        <a href='http://localhost/Main/lecturerindex.php?page=profilesetting.php&user_id=<?php echo $userId; ?>'><button >Profile Setting</button></a>
        </div>
        <div class="col-2-item">
        <a href='http://localhost/Main/lecturerindex.php?page=privacysetting.php&user_id=<?php echo $userId; ?>'><button style="background:blue;">Privacy Setting</button></a>
        </div>
        <div class="col-2-item">
        <a href='http://localhost/Main/lecturerindex.php?page=notificationsetting.php&user_id=<?php echo $userId; ?>'><button >Notification Setting</button></a>
        </div>
      </div>
      
        <?php
    echo"
    <form method='POST' action='http://localhost/Main/lecturerindex.php'>
            
         
            
              <div style='background:white; width:300px; margin:auto;'>
              <p style='text-align:center;'>Change Password</p>
              </div>
              
            
                <input type='hidden' name='user_id'required value='".$row['user_id']."'>
              
              <table class='setting-table'>
           
            
            
               <input type='hidden' name='current_pw'required value=".$row['password'].">
            
           

            <tr>
            <td>New Password</td>
                <td>
                 <input type='password' name='new_pw'placeholder='New Password'>
                </td>
              </tr>

              <tr>
              <td>Confirm Password</td>
                <td>
                   <input type='password' name='confirm_pw' placeholder='Confirm Password'>
                </td>
              </tr>
              
          </table>
          <div class='tab'style='float:right; width:200px;'>
          <button name='changepassword'>Change Password</button>
       </div>
          
          </form>
          ";
          ?>
     
  </div>
  </body>
  </html> 
  
              