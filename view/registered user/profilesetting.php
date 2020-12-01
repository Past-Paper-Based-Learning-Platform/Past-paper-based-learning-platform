<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Setting</title>
    <link rel="stylesheet" href="libs/main.css" type="text/css">
</head>

<div class="container">
<div class="tab">
        <div class="col-2-item">
        <a href='http://localhost/Main/homeindex.php?page=profilesetting.php&user_id=<?php echo $userId; ?>'><button style="background:blue;">Profile Setting</button></a>
        </div>
        <div class="col-2-item">
        <a href='http://localhost/Main/homeindex.php?page=privacysetting.php&user_id=<?php echo $userId; ?>'><button>Privacy Setting</button></a>
        </div>
        <div class="col-2-item">
        <a href='http://localhost/Main/homeindex.php?page=notificationsetting.php&user_id=<?php echo $userId; ?>'><button>Notification Setting</button></a>
        </div>
  </div>

  <div>
<?php
    
  
    echo "<form method='POST' action='http://localhost/Main/homeindex.php'>
  
      <input type='hidden' name='user_id'required value='".$row['user_id']."'>
  
          <table class='setting-table'>
            <tr>
              <td>First Name</td>
              <td>
                <input type='text' name='f_name'required value='".$row['first_name']."'>
              </td>
            </tr>
  
            <tr>
              <td>Middel Name</td>
              <td>
                <input type='text' name='m_name'required value='".$row['middle_name']."'>
              </td>
            </tr>
  
            <tr>
              <td>Last Name</td>
              <td>
                <input type='text' name='l_name'required value='".$row['last_name']."'>
              </td>
            </tr>
  
            <tr>
              <td>Email</td>
              <td>
                <input type='email' name='email' style='width: 100%;
                height: 2rem;
                border-radius: 5px;
                color: rgb(0, 0, 0);
                border-color: midnightblue;' required value=".$row['email'].">
              </td>
            </tr>

          </table>

          <input type='hidden' name='password'required value=".$row['password'].">

          <div class='tab'style='float:right; width:200px;'>
                  <button name='updateuser'>Change Password</button>
          </div>
  
      </form>
    ";
  
    
      
    ?>
    </div>
  </div>
  
</body>
</html>


