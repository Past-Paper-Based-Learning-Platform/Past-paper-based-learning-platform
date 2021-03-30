<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Setting</title>
    <link rel="stylesheet" href="libs/css/settings.css" type="text/css">
</head>


<section class = 'logohead'>
    <a href='http://localhost/Main/lecturerindex.php?page=lecturerHome.php'><img src= 'pictures/logoPPB.png' class='logoimg'></a>
    <h1 class="sitename">Past Paper Base Learning PlatForm</h1>
</section>
<h2 class="navigation">Profile Setting</h2>

<div class="content">
  <!--profile settings-->
  <div>
  <h3 class="topic">Change Profile details</h3>
  <hr>
  <?php
    echo "<form method='POST' action='http://localhost/Main/lecturerindex.php?page=profilesetting.php&user_id=". $_SESSION['user_id']."'>
            <input type='hidden' name='user_id'required value='".$row['user_id']."'>
            <table class='setting-table'>
              <tr>
                <td>First Name</td>
                <td>
                  <input type='text' name='f_name'required value='".$row['first_name']."'>
                </td>
              </tr>
  
              <tr>
                <td>Middle Name</td>
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
                  <input type='email' name='email' required value=".$row['email'].">
                </td>
              </tr>
            </table>
            <input type='hidden' name='password'required value=".$row['password'].">

            <div>
                    <button name='updateuser' type='submit' class='submitbtn'>Change</button>
            </div>
          </form>
    ";
  ?>
  </div>

  <!--deactivate account-->
  <h3 class="topic">Deactiavte Account</h3>
    <hr>
    <form action="http://localhost/Main/homeindex.php?page=profilesetting.php&user_id=<?php echo $_SESSION['user_id']; ?>" method="POST" >
      <label for="checkboxslide"> Deactivate:</label>
      <label class='switch'>
        <input name='checkboxslide' type='checkbox' value='D' >
        <span class='slider round'></span>
      </label>
      <button type="submit" name="deactivate" class='submitbtn'>Deactivate</button>
    </form>

  <!--Change password-->
  <div>
    <h3 class="topic">Change Password</h3>
    <hr>
    <?php
    echo"
    <form method='POST' action='http://localhost/Main/lecturerindex.php?page=profilesetting.php&user_id=". $_SESSION['user_id']."'>
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
      <div>
        <button name='changepassword' type='submit' class='submitbtn'>Change Password</button>
      </div>
    </form>
      ";
    ?>
  </div>

  <!--Change Profile Picture-->
  <div>
    <h3 class="topic">Change Profile Picture</h3>
    <hr>
    <form action="http://localhost/Main/lecturerindex.php?page=profilesetting.php&user_id=<?php echo $_SESSION['user_id']; ?>" method="POST" enctype="multipart/form-data">
      <p  class="inputimage"><input type="file" name="image"/></p>
      <button type="submit" name="uploadImage" class='submitbtn'>Upload</button>
    </form>
  </div>
    
  <!--Change Notification Settings-->
  <div>
  <h3 class="topic">Change Notification Settings</h3>
  <hr>
  <form action="http://localhost/Main/lecturerindex.php?page=profilesetting.php&user_id=<?php echo $_SESSION['user_id']; ?>" method="POST" >
    <?php
    if($notification == 1){
    echo '<label for="notificationon"> Turn On Notification:</label>
          <label class="switch">
            <input type="checkbox" name="notificationon">
            <span class="slider round"></span>
          </label>';
    }else{
    echo '<label for="notificationon"> Turn On Notification:</label>
          <label class="switch">
            <input type="checkbox" name="notificationon" checked>
            <span class="slider round"></span>
          </label>';
    }
    ?>
    <button type="submit" name="setnofication" class='submitbtn'>SET</button>
  </form>
  </div>

  <!--Interest List-->
  <div class="container">
    <div class="bg-gray">
      <h3 class="topic">Interest List</h3>
      <hr>

      <div style="text-align:left; margin-top: 8px;margin-bottom: 8px;">
        <form action="http://localhost/Main/lecturerindex.php?page=profilesetting.php" method="post" id="removeInterestSubs">
          <div class="custom-select-stu" id="custom-select-stu" style="color:black">Remove Subjects</div>
          <div id="custom-select-option-box-stu" style="height: 100px; overflow: auto;">
            <?php 
              foreach($subjects as $subject){
                echo "<div class='custom-select-option checkoption'> <input onchange='toggleFillColor(this);'  class='custom-select-option-checkbox' type='checkbox' name='removeSubjcts[]' value='".$subject['subject_code']."'> ".$subject['subject_name']." </div>";  
              }
            ?>
          </div>
          <button class="bg-dblue border-dblue submitbtn" type="submit" name='rmvtintlst' >Remove</button>
        </form>            
      </div>

      <br/><br/>

      <div style="text-align:left; margin-top: 8px;margin-bottom: 8px;">
        <form action="http://localhost/Main/lecturerindex.php?page=profilesetting.php" method="post" id="addSubjectsForm">
          <div class="custom-select-stu" id="custom-select-stu" style="color:black">Select More</div>
          <div id="custom-select-option-box-stu" style="height: 100px; overflow: auto;">
            <?php 
              foreach($allSubjects as $subject){
                echo "<div class='custom-select-option checkoption'> <input onchange='toggleFillColor(this);'  class='custom-select-option-checkbox' type='checkbox' name='addSubjcts[]' value='".$subject['subject_code']."'> ".$subject['subject_name']." </div>";  
              }
            ?>
          </div>
          <button class="bg-dblue border-dblue submitbtn" type="submit" name='updtintlst' >Add</button>
        </form>            
      </div>

    </div>
  </div>

</div>

</body>
</html>


