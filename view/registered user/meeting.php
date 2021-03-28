<?php include 'view/partials/home_header.php';?>
                        <!-- Scedule meeting Content -->
                        <div class="scedulemeetingcomponent">
                            <div class="sheduledmeets">
                                <h2>Requsted Meetings</h2> <!--if available-->
                                    <ul>
                                    <?php 
                                    $flag=0;
                                        if(!empty($meetingdetails)){
                                            foreach($meetingdetails as $day){
                                                if(!empty($day['meeting_time'])){
                                                    echo '<li>Meeting on '.$day['meeting_date'].' with lecturer '.$day['first_name'].' '.$day['last_name'].' - Confirmed time '.$day['meeting_time'].' </li>';
                                                }elseif(!empty($day['deny'])){
                                                    echo '<li>Meeting on '.$day['meeting_date'].' with lecturer '.$day['first_name'].' '.$day['last_name'].' - Has been cancled </li>';
                                                }else{
                                                    echo '<li>Meeting on '.$day['meeting_date'].' with lecturer '.$day['first_name'].' '.$day['last_name'].' - Pending request </li>';
                                                }
                                            }
                                        }else{
                                            echo '<h3>No Meetings Requested</h3>';
                                        }
                                    ?>
                                    </ul>

                                    
                            </div>

                            <div class="requestform">
                                <form action="http://localhost/Main/homeindex.php?page=meeting.php" method="post">
                                    <input list="lecturers" name="lecturer" id="lecturer" placeholder="Select Lecturer..." class="inputlecturer">
                                    <datalist id="lecturers">
                                        <?php
                                            if(!empty($lectureidname)){
                                                foreach($lectureidname as $lecturer){
                                                    echo '<option value="'.$lecturer['user_id'].'">'.$lecturer['first_name'].' '.$lecturer['last_name'].' - '.$lecturer['email'].'</option>';
                                                }
                                            }
                                        ?>
                                    </datalist>

                                    <button class="selectlecturer" name="selectlecturer" type="submit">Select Lecturer</button>
                                </form>

                                <?php 
                                if(isset($_GET['lecturer'])){
                                    if(isset($_GET['days'])){
                                        $dayarr=[];
                                        $dayarr=unserialize($_GET['days']);
                                        if(!empty($dayarr)){
                                            $meetdays=['Monday','Tuesday','Wednesday','Thursday','Friday','Saterday','Sunday'];
                                            echo '<h2>Available Days</h2>';
                                            echo '<ul>';
                                            foreach($dayarr as $day){
                                                echo '<li>'.$meetdays[$day].'</li>';
                                            }
                                            echo '</ul>';

                                            echo '<form action="http://localhost/Main/homeindex.php?page=meeting.php" method="post">';
                                            echo '<input type="date" name="reqdate" class="inputlecturer inputdate">';
                                            echo '<input type="text" name="lecturerid" style="display:none" value="'.$_GET['lecturer'].'"/>';
                                            echo '<button class="selectlecturer" name="requestmeeting" type="submit">Request Meeting</button>';
                                            echo '</form>';
                                        }
                                        else{
                                            echo '<h2>The lecturer is not available</h2>';
                                        }
                                    }
                            }
                                ?>
                            </div>
                        </div>

                        <div class="alert alert1" style="display:none;" id="alert">
                            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                            Select a lecturer!
                        </div>
                        <div class="alert alert2" style="display:none;" id="alert">
                            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                            Please pick a Date!
                        </div>
                        <div class="alert alert3" style="display:none;" id="alert">
                            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                            Please pick a future date!
                        </div>
                        <?php if(isset($_GET['error'])){
                            if ($_GET['error']==1){
                                echo '<script>var alert=document.querySelector(".alert1"); alert.style.display="block";</script>';
                            }elseif($_GET['error']==2){
                                echo '<script>var alert=document.querySelector(".alert2"); alert.style.display="block";</script>';
                            }elseif($_GET['error']==3){
                                echo '<script>var alert=document.querySelector(".alert3"); alert.style.display="block";</script>';
                            }
                        }?>
<?php include 'view/partials/home_footer.php';?>