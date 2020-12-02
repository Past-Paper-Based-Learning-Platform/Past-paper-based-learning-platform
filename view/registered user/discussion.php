
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>View Past Paper</title>
    <link rel="stylesheet" href="libs/main.css" type="text/css">
    <link rel="stylesheet" href="libs/css/discussionForm.css" type="text/css">
</head>

<body>

<div class='container' style="">
<section class = 'logohead'>
            <a href='http://localhost/Main/homeindex.php?page=home.php'><img src= 'pictures/logoPPB.png' class='logoimg'></a>
            <h1 class="sitename">Past Paper Base Learning PlatForm</h1>
        </section>
    <div class="tab">
        <div class="col-3-item" style='margin:auto;'>
        <a href='http://localhost/Main/homeindex.php?page=pastpaper.php&paper_id=<?php echo $paper_id; ?>'><button>Past Paper</button></a>
        </div>
        <div class="col-3-item" style='margin:auto;'>
        <a href='http://localhost/Main/homeindex.php?page=discussion.php&paper_id=<?php echo $paper_id; ?>'><button style="background:blue;">Discussion</button></a>
        </div>
    </div>



    <div id="discussion" class="tabcontent" style="height: 550px; display: block; margin:auto;">
        <div class="col-3-item bg-gray" style="height: 95%; width:48.25%; margin:10px;">
            <h3>View Discussion</h3>
            <label for="question">Select question: </label>
            <input list="question" name="path">
            <datalist id="question">
                <option value="custom">custom</option>
                <option value="1>b>i">1 -> b -> i</option>
                <option value="1>a">1 -> a</option> 
                <option value="1>b>ii">1 -> b -> ii</option>
                <option value="2>a>i">2 -> a -> i</option>
                <option value="2>a>i">2 -> a -> ii</option>
            </datalist><br>
            <!--add js-->
    
            <label for="discussion">Search discussion: </label>
            <input list="discussion" name="discussion">
            <datalist id="discussion">
                <option value="discussion 1">discussion 1</option>
                <option value="discussion 2">discussion 2</option> 
                <option value="discussion 3">discussion 3</option>
                <option value="discussion 4">discussion 4</option>
                <option value="discussion 5">discussion 5</option>
            </datalist><br>
            <!--add js-->
    
            <button type="submit" class="bg-blue border-blue" style="width: 20%;">View</button>
    
        </div> 
    
        <div class="col-3-item bg-gray"style="height: 95%; width:48.25%; margin:10px;">
        
         <div style="width: 100%; height: 500px; overflow:auto; margin:0;">   
           <?php
                foreach($result as $row) {
                                
                    $id=$row['user_id'];
                    $discussion_id=$row['discussion_id'];
                    $parent_resource_id=$row['parent_resource_id'];

                    if($discussion_id!=null && $parent_resource_id==null){


                    

                            echo" <div class='comment-box'>
                                    <div class='discussion-area'>
                                        <div class='name'>
                                        <a style='text-decoration:none;' href='http://localhost/Main/homeindex.php?page=userprofile.php&user_id=".$row['user_id']."'>".$row['first_name']." ".$row['last_name']."</a> 
                                        </div>
                                        <div class='type'>
                                            ".$row['type']."
                                        </div>
                                        <div class='content'>
                                            ".nl2br($row['content'])." 
                                        </div>
                                    </div>";
                            

                            if(isset($_SESSION['user_id'])){
                                if($_SESSION['user_id']==$row['user_id']){
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

                                <form action='http://localhost/Main/homeindex.php' name='delete-form' method='POST' >
                                    <input type='hidden' name='uid' value='".$row['resource_id']."'>
                                    <input type='hidden' name='dis_id' value='".$row['discussion_id']."'>
                                    <input type='hidden' name='res_id' value='".$row['parent_resource_id']."'>
                                    <input type='hidden' name='paper_id' value='".$row['paper_id']."'>
                                    
                                    <button class='deletebtn' type='submit'  onclick ='return confirm('Proceed to Delete the Discussion?')'
                                    name='delete'>X </button>
                                    </form>
                                
                                    </form>
                            
                            
                                    <form action='http://localhost/Main/homeindex.php?page=paperedit.php&paper_id='".$row['paper_id']."'' name='edit-form' method='POST' >
                                    <input type='hidden' name='uid' value='".$row['resource_id']."'>
                                    <input type='hidden' name='discussion_id' value='".$row['discussion_id']."'>
                                    <input type='hidden' name='message' value='".$row['content']."'>
                                    <input type='hidden' name='paper_id' value='".$row['paper_id']."'>
                                    <button class='editbtn' type='submit' name='edit'>Edit</button>
                                    
                                    </form>
                                    
                        
                                    
                                </div>
                                ";
                                }else{
                                echo"
                                <div>
                                </form>
                                
                                <form name='edit-form' method='POST' >
                                <input type='hidden' name='res_id' value='".$row['resource_id']."'>
                                <input type='hidden' name='dis_id' value='".$row['discussion_id']."'>
                                <button type='submit' name='createResourse' >Create resourse</button>
                                </form>
                                </div>";
                                }
                    
                            }else{
                                echo "<p class='commentMessage'>You need to logged in to reply</p>";
                            }
                            
                        
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

                        if(isset($_SESSION['user_id'])){
                            if($_SESSION['user_id']==$row['user_id']){
                            echo"
                            <div class='getComment'>
                            <form action='http://localhost/Main/homeindex.php' name='delete-form' method='POST' >
                            <input type='hidden' name='uid' value='".$row['resource_id']."'>
                            <input type='hidden' name='dis_id' value='".$row['discussion_id']."'>
                            <input type='hidden' name='res_id' value='".$row['parent_resource_id']."'>
                            <input type='hidden' name='paper_id' value='".$row['paper_id']."'>
                            
                            <button type='submit' name='delete'>Delete</button>
                            </form>
                            
                    
                            <form name='edit-form' method='POST' action='editComment.php'>
                            <input type='hidden' name='uid' value='".$row['resource_id']."'>
                            <input type='hidden' name='date' value='".$row['type']."'>
                            <input type='hidden' name='message' value='".$row['content']."'>
                            <button>Edit</button>
                            </form>
                            <form name='edit-form' method='POST'>
                            <input type='hidden' name='res_id' value='".$row['resource_id']."'>
                            <input type='hidden' name='dis_id' value='".$row['discussion_id']."'>
                            <button type='submit' name='createResourse' >Create resourse</button>
                            </form>
                            </div>
                            ";
                            }else{
                            echo"
                            <div>
                            </form>
                            
                            <form name='edit-form' method='POST'>
                            <input type='hidden' name='res_id' value='".$row['resource_id']."'>
                            <input type='hidden' name='dis_id' value='".$row['discussion_id']."'>
                            <button type='submit' name='createResourse' >Create resourse</button>
                            </form>
                            </div>";
                            }
                        }else{
                        echo "<p class='commentMessage'>You need to logged in to reply</p>";         
                        }
                        echo "</div>";
                    }
                }
            ?>
           </div>
        </div>
    </div>

    <script src="libs/main.js"></script>
</body>
</html>