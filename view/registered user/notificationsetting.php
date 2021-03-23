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
        <a href='http://localhost/Main/homeindex.php?page=profilesetting.php&user_id=<?php echo $userId; ?>'><button >Profile Setting</button></a>
        </div>
        <div class="col-2-item">
        <a href='http://localhost/Main/homeindex.php?page=privacysetting.php&user_id=<?php echo $userId; ?>'><button>Privacy Setting</button></a>
        </div>
        <div class="col-2-item">
        <a href='http://localhost/Main/homeindex.php?page=notificationsetting.php&user_id=<?php echo $userId; ?>'><button style="background:blue;">Notification Setting</button></a>
        </div>
      </div>



<h2 style="color:white;">Active Notification :</h2>

<label class="switch">
  <input type="checkbox" checked>
  <span class="slider round"></span>
</label>


      
        
     
  </div>
  </body>
  </html> 
  
              