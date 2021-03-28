<?php include 'view/partials/home_header.php';?>
                        <!-- Scedule meeting Content -->
                        <div class="sheduledmeets">
                            <h2>Requsted Meetings</h2> <!--if available-->
                                <ul>
                                    <li><p>meeting 1 - name lecturer - time</p></li>
                                    <li><p>meeting 2 - name lecturer - time</p></li>
                                    <li><p>meeting 3 - name lecturer - requsted</p></li> <!--not confirmed-->
                                    <li><p>meeting 4 - name lecturer - requsted</p></li>
                                </ul>

                                <form action="http://localhost/Main/homeindex.php?page=meeting.php" method="post">
                                    <input list="lecturers" name="lecturer" id="lecturer" placeholder="Select Lecturer...">
                                    <datalist id="lecturers">
                                        <?php
                                            if(!empty($lectureidname)){
                                               foreach($lectureidname as $lecturer){
                                                    echo '<option value="'.$lecturer['user_id'].'">'.$lecturer['first_name'].' '.$lecturer['last_name'].' - '.$lecturer['email'].'</option>';
                                                }
                                            }
                                        ?>
                                    </datalist>

                                    <button class="selectlecturer" name="selectlecturer" type="submit"></button>
                                </form>
                        </div>

                        <div class="requestform">
                            if($lecturer)

                        </div>






                <!--        <div class=" bg-dblue col-6-item" style='height:100%;'>
                            <div>
                                <h2>Request Meeting</h2>

                                <form action="#">
                                    <div class="element">
                                        <label for="receiver">To: </label>
                                        <input type="text" id="receiver" name="receiver" placeholder="Enter name / email of the Lecturer" style="width:90%;"><br>
                                    </div>

                                    <div class="element">
                                        <label for="Date">Date: </label>
                                        <input type="date" id="Date" name="Date" min="today"><br>
                                    </div>

                                   <?php// include 'view/partials/calender.php'; ?>

                                    <div class="element">
                                        <label for="message">Message: </label>
                                        <textarea name="message" rows="10" placeholder="type your message here" style="width:100%;"></textarea>
                                    </div>

                                    <div class="element">
                                        <button class="bg-blue border-dblue" type="button" style='width:200px;float:right;'>Send Request</button>
                                    </div>
                                </form>
                            </div>
                        </div> -->
<?php include 'view/partials/home_footer.php';?>