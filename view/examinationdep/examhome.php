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
                            <input type="text" name="year" value="<?php echo date("Y"); ?>">
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
                            <option value="Subject-V">
                            <option value="Subject-VI">
                            <option value="Subject-VII">
                            <option value="Subject-VIII">
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
                <div class="col-3-item" style="height: 400px; overflow: auto;">
                    <table>
                        <thread>
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Date of Examination</th>
                                <th></th>
                            </tr>
                        </thread>
                        <tbody>
                            <tr>
                                <td>SCS2201</td>
                                <td>Subject-I</td>
                                <td>01/01/2020</td>
                                <td><button class="bg-red border-red" type="submit">Delete Record</button></td>
                            </tr>
                            <tr>
                                <td>SCS2202</td>
                                <td>Subject-II</td>
                                <td>02/01/2020</td>
                                <td><button class="bg-red border-red" type="submit">Delete Record</button></td>
                            </tr>
                            <tr>
                                <td>SCS2203</td>
                                <td>Subject-III</td>
                                <td>03/01/2020</td>
                                <td><button class="bg-red border-red" type="submit">Delete Record</button></td>
                            </tr>
                            <tr>
                                <td>SCS2204</td>
                                <td>Subject-IV</td>
                                <td>04/01/2020</td>
                                <td><button class="bg-red border-red" type="submit">Delete Record</button></td>
                            </tr>
                            <tr>
                                <td>SCS2205</td>
                                <td>Subject-V</td>
                                <td>05/01/2020</td>
                                <td><button class="bg-red border-red" type="submit">Delete Record</button></td>
                            </tr>
                            <tr>
                                <td>SCS2206</td>
                                <td>Subject-VI</td>
                                <td>06/01/2020</td>
                                <td><button class="bg-red border-red" type="submit">Delete Record</button></td>
                            </tr>
                            <tr>
                                <td>SCS2207</td>
                                <td>Subject-VII</td>
                                <td>07/01/2020</td>
                                <td><button class="bg-red border-red" type="submit">Delete Record</button></td>
                            </tr>
                            <tr>
                                <td>SCS2208</td>
                                <td>Subject-VIII</td>
                                <td>08/01/2020</td>
                                <td><button class="bg-red border-red" type="submit">Delete Record</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>  
            
            <div id="uploadpastpapers" class="tabcontent" style="height: 600px;">
                <div class="col-5-item">
                    <div class="col-2-item">
                        <div class="col-2-item strong text-white">Year of Examination:</div>
                        <div class="col-4-item">
                            <input type="text" name="year" value="<?php echo date("Y"); ?>">
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
                            <option value="Subject-V">
                            <option value="Subject-VI">
                            <option value="Subject-VII">
                            <option value="Subject-VIII">
                        </datalist>
                    </div>
                    <div class="col-2-item strong text-white">Select Part:</div>
                    <div class="col-4-item">
                        <input type="text" list="part" name="part">
                        <datalist id="part">
                            <option value="Part A">
                            <option value="Part B">
                            <option value="Part C">
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
                <div class="col-3-item" style="height: 400px; overflow: auto;">
                    <table>
                        <thread>
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Part</th>
                                <th></th>
                            </tr>
                        </thread>
                        <tbody>
                            <tr>
                                <td>SCS2201</td>
                                <td>Subject-I</td>
                                <td>Part A</td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>                            
                            <tr>
                                <td>SCS2201</td>
                                <td>Subject-I</td>
                                <td>Part B</td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2202</td>
                                <td>Subject-II</td>
                                <td>Part A</td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2202</td>
                                <td>Subject-II</td>
                                <td>Part B</td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2202</td>
                                <td>Subject-II</td>
                                <td>Part C</td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2203</td>
                                <td>Subject-III</td>
                                <td>Part A</td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2205</td>
                                <td>Subject-V</td>
                                <td>Part A</td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2205</td>
                                <td>Subject-V</td>
                                <td>Part B</td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2207</td>
                                <td>Subject-VII</td>
                                <td>Part A</td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2207</td>
                                <td>Subject-VII</td>
                                <td>Part B</td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2207</td>
                                <td>Subject-VII</td>
                                <td>Part C</td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>                
            </div>

            <div id="managesubjects" class="tabcontent" style="height: 600px;">
                <div class="col-5-item">
                    <div class="col-2-item">
                        <div class="col-2-item strong text-white">Year of Examination:</div>
                        <div class="col-4-item">
                            <input type="text" name="year" value="<?php echo date("Y"); ?>">
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
                    <button class="bg-blue border-blue" type="submit">Show Subjects</button>
                </div>
                <div class="col-3-item"><hr>
                    <h2>Add Subject</h2>
                    <div class="col-2-item strong text-white">Subject Code:</div>
                    <div class="col-4-item">
                        <input type="text" name="subjectcode">
                    </div>
                    <div class="col-2-item strong text-white">Subject Name:</div>
                    <div class="col-4-item">
                        <input type="text" name="subjectname">
                    </div>
                    <div class="col-2-item" style="float: right;">
                        <button class="bg-green border-green" type="submit">Add Subject</button>  
                    </div>         
                </div>
                <div class="col-3-item" style="height: 400px; overflow: auto;">
                    <table>
                        <thread>
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th></th>
                            </tr>
                        </thread>
                        <tbody>
                            <tr>
                                <td>SCS2201</td>
                                <td>Subject-I</td>
                                <td><button class="bg-red border-red" type="submit">Remove Subject</button></td>
                            </tr>
                            <tr>
                                <td>SCS2202</td>
                                <td>Subject-II</td>
                                <td><button class="bg-red border-red" type="submit">Remove Subject</button></td>
                            </tr>
                            <tr>
                                <td>SCS2203</td>
                                <td>Subject-III</td>
                                <td><button class="bg-red border-red" type="submit">Remove Subject</button></td>
                            </tr>
                            <tr>
                                <td>SCS2204</td>
                                <td>Subject-IV</td>
                                <td><button class="bg-red border-red" type="submit">Remove Subject</button></td>
                            </tr>
                            <tr>
                                <td>SCS2205</td>
                                <td>Subject-V</td>
                                <td><button class="bg-red border-red" type="submit">Remove Subject</button></td>
                            </tr>
                            <tr>
                                <td>SCS2206</td>
                                <td>Subject-VI</td>
                                <td><button class="bg-red border-red" type="submit">Remove Subject</button></td>
                            </tr>
                            <tr>
                                <td>SCS2207</td>
                                <td>Subject-VII</td>
                                <td><button class="bg-red border-red" type="submit">Remove Subject</button></td>
                            </tr>
                            <tr>
                                <td>SCS2208</td>
                                <td>Subject-VIII</td>
                                <td><button class="bg-red border-red" type="submit">Remove Subject</button></td>
                            </tr>
                        </tbody>
                    </table>
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