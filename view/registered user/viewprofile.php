<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="http://localhost/Main/libs/js/jquery.min.js"></script>
    <link rel="stylesheet" href="http://localhost/Main/libs/main.css" type="text/css">
    <title>Profile</title>
</head>
<body>
    <div class='container'>

    <div class='details' style="display:flex;">

        <div class="profile_pic" style='width:20%; height:200px; background:white; margin:30px;'>
        <?php if(is_null($row['image'])){?>
            <img style="width:100%; height:100%;" src="uploads/default.png">
        <?php }else{?>
            <img src="uploads/<?php echo $row[image] ?>">
        <?php } ?>
            
        </div>

        <div class="details" style='width:80%; height:200px; background:white; margin:30px 30px 30px 0px'>
            <div style="font-size:40px; font-weight:700; margin-left:5%;">
            
                <?php 
                $name=$row['first_name'].' '.$row['middle_name'].' '.$row['last_name'];
                echo $name; ?>
            </div>
            <div style="margin-left:5%;">
                <P><?php echo $row['email'];  ?></P>
            </div>
        </div>
        </div>
        <div class="interst-list" style="width:96%; height:350px; background:white; margin:0px 30px 30px 30px">

        </div>
    </div>
</body>
</html>