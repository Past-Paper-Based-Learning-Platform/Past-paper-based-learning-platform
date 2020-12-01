
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/admin.css" >
    <title>Profile</title>
    <style>
        .profile-container{
            padding:20px;
            background-color:white;

            
            
        }
        .name{
            font-weight:500;
            font-size:25px;
            width:fit-content;
        }
        .email{
            font-size:13px;
            font-weight:500;
            margin:auto;
           
            background-color:lightgray;
            border-radius:10px;
            width:fit-content;
            
        }
        .email p{
            padding:0px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-5-item bg-lblue" style="height: 650px;">
            <?php
                    
                    echo" <div class='profile-container'>
                            <div class='name'>
                                <p>".$row['first_name']."</p>
                            
                                <div class='email'>
                                    <p>".$row['email']."</p>
                                </div>
                            </div>
                        </div>";
                    
                
                
            ?>
        </div>
    </div>
</body>
</html>