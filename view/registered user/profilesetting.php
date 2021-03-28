<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Setting</title>
    <link rel="stylesheet" href="libs/main.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input { 
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: red;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
    </style>
</head>

<div class="container">
<section class = 'logohead'>
            <a href='http://localhost/Main/homeindex.php?page=home.php'><img src= 'pictures/logoPPB.png' class='logoimg'></a>
            <h1 class="sitename">Past Paper Base Learning PlatForm</h1>
        </section>
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

            <tr>
              <td>Disable Account</td>
              <td>
              <label class='switch'>
                <input name='checkboxslide' type='checkbox' value='D' >
                <span class='slider round'></span>
              </label>
              </td>
            </tr>

          </table>

          <input type='hidden' name='password'required value=".$row['password'].">
          
          <div>
          
          </div>

          <div class='tab'style='float:right; width:200px;'>
                  <button name='updateuser'>Change</button>
          </div>

  
      </form>
    ";

    ?>

    </div>

    <form method="POST" enctype="multipart/form-data">
      <p><input type="file" name="image" accept="image/*"  /></p>
      <input type="submit" name="uploadImage" value="Upload" />
    </form>
      
 

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


