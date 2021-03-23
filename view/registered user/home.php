<?php include 'view/partials/home_header.php';?>
                        <!-- HOME default content -->
      
    <?php
                foreach($result_user_discussion as $row) {
                                
                    $id=$row['user_id'];
                    $discussion_id=$row['discussion_id'];
                    $parent_resource_id=$row['parent_resource_id'];

                    if($discussion_id!=null && $parent_resource_id==null){

                            echo" <div class='comment-box' style='color:black;'>
                                    <div class='discussion-area'>
                                        <div class='name'>
                                        <a style='text-decoration:null;' href='http://localhost/Main/homeindex.php?page=userprofile.php&user_id=".$row['user_id']."'>".$row['first_name']." ".$row['last_name']."</a> 
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
   
<?php include 'view/partials/home_footer.php';?>             