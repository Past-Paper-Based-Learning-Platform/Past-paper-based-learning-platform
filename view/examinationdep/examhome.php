<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Examination Department Home</title>
    <link rel="stylesheet" href="../../libs/main.css" type="text/css">
</head>
<body>
    <div class="container">
        <div class="col-6-item page-title bg-lblue">
            Examination Department
        </div>
    </div>
    <div class="row container">
        <div class="col-5-item bg-lblue" style="height: 700px;">
            <div class="tab">
                <div class="col-2-item">
                    <button id="defaulttab" class="tablinks" onclick="openTab(event, 'examinationdetails')" >Examination Details</button>
                </div>
                <div class="col-2-item">
                    <button class="tablinks" onclick="openTab(event, 'uploadpastpapers')">Upload Past Papers</button>
                </div>
                <div class="col-2-item">
                    <button class="tablinks" onclick="openTab(event, 'managesubjects')">Manage Subjects</button>
                </div>
            </div>

            <div id="examinationdetails" class="tabcontent" style="height: 600px;">
            <div class="col-5-item">
                    <div class="col-2-item">
                        <div class="col-2-item strong text-white">Year of Examination:</div>
                        <div class="col-4-item">
                            <input type="text" name="year" placeholder="<?php echo date("Y"); ?>">
                        </div>
                    </div>
                    <div class="col-2-item">
                        <div class="col-2-item strong text-white">Semester:</div>
                        <div class="col-4-item">
                            <input type="text" list="semester" name="semester">
                            <datalist id="semester">
                                <option value="Semester-I">
                                <option value="Semester-II">
                            </datalist>
                        </div> 
                    </div>
                    <div class="col-2-item">
                        <div class="col-2-item strong text-white">Year of Study:</div>
                        <div class="col-4-item">
                            <input type="text" list="studyyear" name="studyyear">
                            <datalist id="studyyear">
                                <option value="First Year">
                                <option value="Second Year">
                                <option value="Third Year">
                                <option value="Fourth Year">
                            </datalist>
                        </div>
                    </div>
                </div>
                <div class="col-1-item"></br></br>
                    <button class="bg-blue border-blue" type="submit">Show Details</button>
                </div>
                <div class="col-3-item"><hr>
                    <h2>Update Details</h2>
                    <div class="col-2-item strong text-white">Select Subject:</div>
                    <div class="col-4-item">
                        <input type="text" list="subject" name="subject">
                        <datalist id="subject">
                            <option value="Subject-I">
                            <option value="Subject-II">
                            <option value="Subject-III">
                            <option value="Subject-IV">
                        </datalist>
                    </div>
                    <div class="col-2-item strong text-white"></br>Choose Examination Date:</div>                        
                    <div class="col-4-item">
                        <div class="date-picker">
                            <div class="selected-date"></div>
                            <div class="dates">
                                <div class="month">
                                    <div class="arrows prev-mth">&lt;</div>
                                    <div class="mth"></div>
                                    <div class="arrows next-mth">&gt;</div>
                                </div>
                                <div class="days"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2-item" style="float: right;">
                        <button class="bg-green border-green" type="submit">Update Record</button>
                    </div>                        
                </div>
                <div class="col-3-item">
                    <div class="container-fit-vertical bg-white text-gray auto-scroll" style="height: 370px;">&lt;Show Details Here&gt;</div>
                </div>
            </div>  
            
            <div id="uploadpastpapers" class="tabcontent" style="height: 600px;">
                <div class="col-5-item">
                    <div class="col-2-item">
                        <div class="col-2-item strong text-white">Year of Examination:</div>
                        <div class="col-4-item">
                            <input type="text" name="year" placeholder="<?php echo date("Y"); ?>">
                        </div>
                    </div>
                    <div class="col-2-item">
                        <div class="col-2-item strong text-white">Semester:</div>
                        <div class="col-4-item">
                            <input type="text" list="semester" name="semester">
                            <datalist id="semester">
                                <option value="Semester-I">
                                <option value="Semester-II">
                            </datalist>
                        </div> 
                    </div>
                    <div class="col-2-item">
                        <div class="col-2-item strong text-white">Year of Study:</div>
                        <div class="col-4-item">
                            <input type="text" list="studyyear" name="studyyear">
                            <datalist id="studyyear">
                                <option value="First Year">
                                <option value="Second Year">
                                <option value="Third Year">
                                <option value="Fourth Year">
                            </datalist>
                        </div>
                    </div>
                </div>
                <div class="col-1-item"></br></br>
                    <button class="bg-blue border-blue" type="submit">Enter</button>
                </div>                             
                <div class="col-3-item"><hr>
                    <h2>Upload Papers</h2>
                    <div class="col-2-item strong text-white">Select Subject:</div>
                    <div class="col-4-item">
                        <input type="text" list="subject" name="subject">
                        <datalist id="subject">
                            <option value="Subject-I">
                            <option value="Subject-II">
                            <option value="Subject-III">
                            <option value="Subject-IV">
                        </datalist>
                    </div>
                    <div class="col-2-item strong text-white">Responsible Lecturer:</div>
                    <div class="col-4-item">
                        <input type="text" list="lecturer" name="lecturer">
                        <datalist id="lecturer">
                            <option value="Lecturer-I">
                            <option value="Lecturer-II">
                            <option value="Lecturer-III">
                            <option value="Lecturer-IV">
                        </datalist>
                    </div> 
                    <div class="col-1-item strong text-white">Import File:</div>
                    <div class="col-3-item">
                        <input type="text" name="paperpdf">  
                    </div>
                    <div class="col-2-item">
                        <button class="bg-blue border-blue" type="submit">Browse..</button>  
                    </div> 
                    <div class="col-2-item" style="float: right;">
                        <button class="bg-green border-green" type="submit">Upload File</button>
                    </div>         
                </div>
                <div class="col-3-item">
                    <div class="container-fit-vertical bg-white text-gray auto-scroll" style="height: 370px;">&lt;Show Uploaded Papers&gt;</div>
                </div>                
            </div>

            <div id="managesubjects" class="tabcontent" style="height: 600px;">
                <div class="col-5-item">
                    <div class="col-2-item strong text-white">Enter Post ID:</div>
                    <div class="col-4-item"><input type="text" placeholder="Post ID" id="postid"></div>
                    <div class="col-2-item strong text-white">Content:</div>
                    <div class="col-4-item bg-white text-gray" style="height: 300px;">&lt;Display Content Here&gt;</div>
                    <div class="col-4-item" style="float: right;">
                        <div class="col-3-item"><button class="bg-green border-green" type="submit">Ignore Repot & Keep the Post</button></div>
                        <div class="col-3-item"><button class="bg-red border-red" type="submit">Remove Post</button></div>
                    </div>
                </div>
                <div class="col-1-item">
                    <div class="col-4-item"><button class="bg-dblue border-dblue" type="submit">Search Post</button></div>
                </div>
            </div>
        </div>
        <div class="col-1-item bg-gray" style="height: 700px;">
            <div class="container-fit-vertical bg-lgray strong">
                Notifications
            </div>
            <div class="container-fit-vertical bg-white text-gray auto-scroll" style="height: 620px;">
                &lt;Notification list&gt;
            </div>
        </div>
    </div>

    <script src="../../libs/main.js"></script>
</body>
</html>