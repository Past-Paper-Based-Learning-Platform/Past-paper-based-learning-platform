
  
  <div id="notification" class="tabcontent bg-white">
    <h3>Notification</h3>
    <label class="switch">
      <input type="checkbox">
      <span class="slider round"></span>
    </label>
  </div>
  
  <div id="profile" class="tabcontent bg-white">
    <h3>Profile Setting</h3>
    
  <?php
    
    $row=$result->fetch_assoc();
  echo "<form method='POST' action='http://localhost/mvcStructure/mvc.php'>

    <input type='hidden' name='user_id'required value='".$row['user_id']."'>

        <table class='setting-table'>
          <tr>
            <td>First Name</td>
            <td>
              <input type='text' name='f_name'required value='".$row['name']."'>
            </td>
          </tr>

          <tr>
            <td>Middel Name</td>
            <td>
              <input type='text' name='m_name'required value='".$row['middel_name']."'>
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
              <input type='email' name='email'required value=".$row['email'].">
            </td>
          </tr>
            
            <td>
              <input type='submit' value='update' name='u_update'>
            </td>
            <input type='hidden' name='password'required value=".$row['password'].">
          </tr>


        </table>

    </form>
  ";

  
    
  ?>
  </div>
  
  <div id="privacy" class="tabcontent bg-white">
    <h3>Privacy Setting</h3>
    <?php
    echo"
    <form method='POST' action='http://localhost/mvcStructure/mvc.php'>
    
            <p>Change Password</p>
            
            <input type='hidden' name='user_id'required value='".$row['user_id']."'>

              <input type='password' name='current_pw'required value=".$row['password'].">
            
              <br><br>
          
              <input type='password' name='new_pw' placeholder='New Password'>
              <br><br>

              <input type='password' name='confirm_pw' placeholder='Confirm Password'>
         <br><br>

           
              <input type='submit' name='change_pw' value='Change Password'>
      
   
      
    
          </form>
          ";
          ?>

  </div>
</div>
  <script>
    document.getElementById("defaultOpen").click();
    
    function opentab(evt, cityName) {

    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
  
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";

  }

  
  </script>
</body>
</html>
