<?php include 'view/partials/home_header.php';?>
                        <!-- Scedule meeting Content -->
                        <div class="container bg-dblue col-6-item" style='height:100%;'>
                            <div>
                                <h2>Send complain</h2>

                                <form action="http://localhost/Main/homeindex.php?page=complain.php">
                                    <div class="element">
                                        <label for="receiver">To: </label>
                                        <input type="text" id="receiver" name="receiver" placeholder="Enter name / email of the Lecturer" style="width:90%;"><br>
                                    </div>

                                    <div class="element">
                                        <label for="message">Message: </label>
                                        <textarea name="message" rows="10" placeholder="type your message here" style="width:100%;"></textarea>
                                    </div>

                                    <div class="element">
                                        <button class="bg-blue border-dblue" type="button" style='width:200px;float:right;'>Send Complain</button>
                                    </div>
                                </form>
                            </div>
                        </div>
<?php include 'view/partials/home_footer.php';?>