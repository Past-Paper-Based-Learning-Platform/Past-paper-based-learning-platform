
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="libs/main.css" type="text/css">
    <link rel="stylesheet" href="libs/css/discussionForm.css" type="text/css">
    <title>Profile</title>
    <style>
        .contin{
            
            

            
        }

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
        .flex-container {
  display: flex;
  background-color: DodgerBlue;
}

.flex-container  div {
  
  margin: 10px;
  padding: 2px;
 
}
    </style>
</head>
<body>

</style>
</head>
<body>


    
    <div class="container" >
        <div class=".flex-container ">
        
        <div class="details" style="display:block; width=20px; heigh:20px;">
        
            <?php
                    
                 echo" 
                 
                <div class='flex-container'>
                <div>
                <div style='width:200px; height:200px; border-radius:50%; background:white;'></div>
                </div>
                  <div>
                            <div class='name''>
                            
                                <p>".$row['first_name']." ".$row['last_name']."</p>
                            
                                <div class='email' style='padding-left:10px; padding-right:10px; border-radius:100%;'>
                                    <p>".$row['email']."</p>
                                
                                </div>
                            </div>
                        </div>
                        </div> 
                        </div>";
            ?>
        </div>
    </div>
<div class="discussion">
        <?php
                foreach($result_user_discussion as $row) {
                                
                    $id=$row['user_id'];
                    $discussion_id=$row['discussion_id'];
                    $parent_resource_id=$row['parent_resource_id'];

                    if($discussion_id!=null && $parent_resource_id==null){


                    

                            echo" <div class='comment-box'>
                                    <div class='discussion-area'>
                                        <div class='name'>
                                        <a style='text-decoration: none' href='http://localhost/Main/homeindex.php?page=userprofile.php&user_id=".$row['user_id']."'>".$row['first_name']." ".$row['last_name']."</a> 
                                        </div>
                                        <div class='type'>
                                            ".$row['type']."
                                        </div>
                                        <div class='content'>
                                            ".nl2br($row['content'])." 
                                        </div>
                                    </div>";
                            
                            
                                echo"
                                <div class='getComment'>
                                    <div class='likebtn'>
                                    <div class='like'>
                                    <button type='submit' name='edit'>Like</button>
                                    </div>
                                    <div class='unlike'>
                                    <button type='submit' name='edit'>Dislike</button>
                                    </div>
                                    </div>

                             
                                
                                    
                        
                                    
                                </div>
                                ";
                            
                        
                            echo"</div> ";
                            
                        
                    }else{
                        
                        echo"<div> 
                        <div class='comment-box-1' style='position: relative;'>
                        <p>
                            <div class='name'>
                            <a href='viewprofile.php?user_id=".$row['user_id']."'>".$row['first_name']."</a> 
                            </div>
                            <div class='type'>
                                ".$row['type']."
                            </div>
                            <div class='content'>
                                ".nl2br($row['content'])." 
                            </div>
                        </p>";


                            echo"
                            <div class='getComment'>
                            
                            </div>
                            ";
                            }
                        
                        echo "</div>";
                    }
                
            ?>
        
        </div>
        
    </div>
</body>
</html>