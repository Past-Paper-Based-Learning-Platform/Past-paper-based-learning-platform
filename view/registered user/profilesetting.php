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
  <div class="container">
    <div class="bg-gray">
      <h3 style="text-align:center;">Interest List</h3>
      <ul style="list-style-type: square;">
        <?php
          while($row = mysqli_fetch_assoc($subjects)) {
            echo "<li>". $row['subject_name']. "</li>";
          }
        ?>
      </ul> 
      <div style="text-align:left; margin-top: 8px;margin-bottom: 8px;">
        <form action="http://localhost/Main/homeindex.php?page=profilesetting.php" method="post" id="addSubjectsForm">
          <div class="custom-select-stu" id="custom-select-stu" style="color:black">Select More..</div>
          <div id="custom-select-option-box-stu" style="height: 100px; overflow: auto;">
            <?php 
              foreach($allSubjects as $subject){
                echo "<div class='custom-select-option'> <input onchange='toggleFillColor(this);'  class='custom-select-option-checkbox' type='checkbox' name='addSubjcts[]' value='".$subject['subject_code']."'> ".$subject['subject_name']." </div>";  
              }
            ?>
          </div>
          <button class="bg-dblue border-dblue" type="submit" style="width:30%;float:right;width:200px;" name='updtintlst' >Add</button>
        </form>            
      </div>
    </div>
  </div>
</body>
</html>


