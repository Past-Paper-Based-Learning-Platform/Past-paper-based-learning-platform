<?php include 'view/partials/home_header.php';?>
                        <!-- Scedule meeting Content -->
                        <div>
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

                                    <div class="element">
                                        <label for="message">Message: </label>
                                        <textarea name="message" rows="10" placeholder="type your message here" style="width:100%;"></textarea>
                                    </div>

                                    <div class="element">
                                        <button class="bg-dblue border-dblue" type="button">Send Request</button>
                                    </div>
                                </form>
                            </div>
                        </div>
<?php include 'view/partials/home_footer.php';?>