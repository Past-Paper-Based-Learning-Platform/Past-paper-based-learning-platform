<?php include 'view/partials/lecturer_header.php';?>
                        <!-- Scedule meeting Content -->
                        <div class="lecturemeetingcompnt">
                            <div class = "schedule">
                                <h2>Schedule Meeting</h2>
                                <ul>
                                    <li><p>meeting request 1 <a href="#">confirm</a> <a href="#">deny</a></p></li>
                                    <li><p>meeting request 2 <a href="#">confirm</a> <a href="#">deny</a></p></li>
                                    <li><p>meeting request 3 <a href="#">confirm</a> <a href="#">deny</a></p></li>
                                    <li><p>meeting request 4 <a href="#">confirm</a> <a href="#">deny</a></p></li>
                                </ul>
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
                        </div>  
<?php include 'view/partials/lecturer_footer.php';?>  