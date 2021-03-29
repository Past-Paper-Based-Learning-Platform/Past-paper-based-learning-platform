<?php include 'view/partials/lecturer_header.php';?>
                        <!-- Scedule meeting Content -->
                        <div class="lecturemeetingcompnt">
                            <div class = "schedule">
                                <h2>Meetings</h2>
                                    <?php //echo '<pre>'.print_r($meetingdetails).'</pre>'; ?>
                                    <?php 
                                    $flag=0;
                                        if(!empty($meetingdetails)){
                                            foreach($meetingdetails as $day){
                                                
                                                if(empty($day['deny']) && empty($day['meeting_time'])){
                                                    $flag=1;
                                                    echo  '<form action="http://localhost/Main/lecturerindex.php?page=meeting.php" method="post">';
                                                    echo  '<li><p>Student '.$day['first_name'].' '.$day['last_name'].' requested a meeting on '.$day['meeting_date'].' </li>';
                                                    echo  '<input type="text" name="meetid" value="'.$day['meeting_id'].'" style="display:none;"/>';
                                                    echo  '<input type="time" name="meettime"/><br>';
                                                    echo  '<button name="confirm" type="submit" class="settime">Confirm</button>';
                                                    echo  '<button name="deny" type="submit" class="settime">Deny</button>';
                                                    echo  '</form>';
                                                }
                                            }
                                        }

                                        if($flag==0){
                                            echo '<h3>No pending requests</h3>';
                                        }
                                    ?>
                            </div>
                            <div class="setavailable" style="display:block">
                                <div id="available">
                                <?php
                                    if(!empty($available)){
                                        echo '<h2>Available Days</h2>';
                                        echo '<form action="http://localhost/Main/lecturerindex.php?page=meeting.php" method="post">';
                                        $meetdays=['Monday','Tuesday','Wednesday','Thursday','Friday','Saterday','Sunday'];
                                        foreach($available as $index){
                                            echo '<input type="checkbox" name="'.$meetdays[$index].'" id="'.$meetdays[$index].'" value="'.$index.'"></input>';
                                            echo '<label for="'.$meetdays[$index].'">'.$meetdays[$index].'</label><br>';
                                        }
                                        echo '<button name="setnotavailable" type="submit" class="setbusy">Remove</button>';
                                    }
                                ?>
                                    
                                </form>
                                </div>
                                <hr>
                                <div>
                                <?php

                                    $notavailable=[0,1,2,3,4,5,6];
                                    $notavailable=array_diff($notavailable,$available);

                                    if(!empty($notavailable)){
                                        echo '<h2>Select Available Days</h2>';
                                        echo '<form action="http://localhost/Main/lecturerindex.php?page=meeting.php" method="post">';
                                        $meetdays=['Monday','Tuesday','Wednesday','Thursday','Friday','Saterday','Sunday'];
                                        foreach($notavailable as $index){
                                            echo '<input type="checkbox" name="'.$meetdays[$index].'" id="'.$meetdays[$index].'" value="'.$index.'"></input>';
                                            echo '<label for="'.$meetdays[$index].'">'.$meetdays[$index].'</label><br>';
                                        }
                                        echo '<button name="setavailable" type="submit" class="setbusy">Set Available</button>';
                                    }
                                ?>
                                    
                                </form>
                                </div>
                            </div>
                            <div class="alert alert1" style="display:none;" id="alert">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                Plese Select a Time to Confirm.!
                            </div>
                            <?php 
                            if(isset($_GET['error'])){
                                if ($_GET['error']==1){
                                    echo '<script>var alert=document.querySelector(".alert1"); alert.style.display="block";</script>';
                                }
                            }
                            ?>
                        </div>  
<?php include 'view/partials/lecturer_footer.php';?>  