<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>View Past Paper</title>
    <link rel="stylesheet" href="libs/main.css" type="text/css">
</head>
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
  </body>
  </html> 