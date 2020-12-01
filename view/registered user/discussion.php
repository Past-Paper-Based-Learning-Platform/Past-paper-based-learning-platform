<?php
include "view/partials/pastpaper_header.php";
?>

    <div id="discussion" class="tabcontent" style="height: 600px; display: block;">
        <div class="col-3-item bg-gray" style="height: 100%;">
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
    
        <div class="col-3-item bg-gray"style="height: 100%;">
            <h3>Discussion id</h3>

            
           <?php
  foreach($result as $row) {
                 
    $id=$row['user_id'];
    $discussion_id=$row['discussion_id'];
    $parent_resource_id=$row['parent_resource_id'];

    if($discussion_id!=null && $parent_resource_id==null){


      

            echo" <div class='comment-box'>
                    <div class='discussion-area'>
                        <div class='name'>
                        <a href='http://localhost/Main/homeindex.php?page=userprofile.php&user_id=".$row['user_id']."'>".$row['first_name']."</a> 
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
                
                    <form name='delete-form' method='POST'>
                    <input type='hidden' name='uid' value='".$row['resource_id']."'>
                    <input type='hidden' name='dis_id' value='".$row['discussion_id']."'>
                    <input type='hidden' name='res_id' value='".$row['parent_resource_id']."'>
                    <button type='submit' name='delete'>Delete</button>
                   
                    </form>
            
            
                    <form name='edit-form' method='POST' >
                    <input type='hidden' name='uid' value='".$row['resource_id']."'>
                    <input type='hidden' name='date' value='".$row['type']."'>
                    <input type='hidden' name='message' value='".$row['content']."'>
                    <button >Edit</button>
                    <input type='submit' value='test'>
                    </form>
                    
                    <button type='submit' class='open-button' onclick='showForm()'>creat</button>
                    <form class='create-resource' id='myForm' method='POST'>
                    <input type='hidden' name='res_id' value='".$row['resource_id']."'>
                    <input type='hidden' name='dis_id' value='".$row['discussion_id']."'>
                    <input type='hidden' name='user_id' value='".$_SESSION['user_id']."'>



                    



                    <textarea name='message'></textarea><br>
            <div class='submit-part'>
                 <div class='radio-btn'>
                <label>Question</label>
                    <input type='radio' name='type' value='Question'>
                    <label>Answer</label>
                    <input type='radio' name='type' value='Answer'><br>
                </div>
        <div class='submit-btn'>
        
        </div>
        </div>
        <button type='submit' name='createResourse'>Create resourse</button>
        <button type='button' class='btn cancel' onclick='closeForm()'>Close</button>

                    
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
            <form name='delete-form' method='POST' >
            <input type='hidden' name='uid' value='".$row['resource_id']."'>
            <input type='hidden' name='dis_id' value='".$row['discussion_id']."'>
            <input type='hidden' name='res_id' value='".$row['parent_resource_id']."'>
            
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

    <script src="libs/main.js"></script>
</body>
</html>