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
                <div class="container" style="width: 25%; float: left">
                    <div class="col-2-item strong text-white">Year:</div>
                    <div class="col-4-item">
                        <input type="text" name="year" value="<?php echo date("Y"); ?>">
                    </div>
                </div>
                <div class="container" style="width: 25%; float: left">
                    <div class="col-2-item strong text-white">Semester:</div>
                    <div class="col-4-item">
                        <input type="text" list="semester" name="semester">
                        <datalist id="semester">
                            <option value="Semester-I">
                            <option value="Semester-II">
                        </datalist>
                    </div> 
                </div>
                <div class="container" style="width: 25%; float: left">
                    <div class="col-2-item strong text-white">Course:</div>
                    <div class="col-4-item">
                        <input type="text" list="course" name="course">
                        <datalist id="course">
                            <option value="Computer Science">
                            <option value="Information Systems">
                        </datalist>
                    </div> 
                </div>
                <div class="container" style="width: 25%; float: left">
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
                <div class="col-5-item strong" style="font-size: 26px">Update Details</div>
                <div class="col-1-item">
                    <button class="bg-blue border-blue" type="submit">Show Details</button>
                </div>
                <div class="col-3-item bg-body"><hr>
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
                <div class="col-3-item" style="height: 380px; overflow: auto;">
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
                <div class="container" style="width: 25%; float: left">
                    <div class="col-2-item strong text-white">Year:</div>
                    <div class="col-4-item">
                        <input type="text" name="year" value="<?php echo date("Y"); ?>">
                    </div>
                </div>
                <div class="container" style="width: 25%; float: left">
                    <div class="col-2-item strong text-white">Semester:</div>
                    <div class="col-4-item">
                        <input type="text" list="semester" name="semester">
                    </div> 
                </div>
                <div class="container" style="width: 25%; float: left">
                    <div class="col-2-item strong text-white">Course:</div>
                    <div class="col-4-item">
                        <input type="text" list="course" name="course">
                    </div> 
                </div>
                <div class="container" style="width: 25%; float: left">
                    <div class="col-2-item strong text-white">Year of Study:</div>
                    <div class="col-4-item">
                        <input type="text" list="studyyear" name="studyyear">                        
                    </div>
                </div>
                <div class="col-5-item strong" style="font-size: 26px">Upload Papers</div>
                <div class="col-1-item">
                    <button class="bg-blue border-blue" type="submit">Enter</button>
                </div>                            
                <div class="col-3-item"><hr>
                    <div class="bg-lgray" style="height: 300px; overflow: auto;">
                    <table>
                        <tbody>
                            <tr>
                                <td>Paper #1</td>
                                <td><input type="text" list="subject" name="subject" placeholder="subject"></td>
                                <td><input type="text" list="part" name="part" placeholder="part"></td>
                                <td><button class="bg-red border-red" type="submit">-</button></td>  
                            </tr>
                            <tr>
                                <td>Paper #2</td>
                                <td><input type="text" list="subject" name="subject" placeholder="subject"></td>
                                <td><input type="text" list="part" name="part" placeholder="part"></td>
                                <td><button class="bg-red border-red" type="submit">-</button></td> 
                            </tr>
                            <tr>
                                <td>Paper #3</td>
                                <td><input type="text" list="subject" name="subject" placeholder="subject"></td>
                                <td><input type="text" list="part" name="part" placeholder="part"></td>
                                <td><button class="bg-red border-red" type="submit">-</button></td> 
                            </tr>
                            <tr>
                                <td>Paper #4</td>
                                <td><input type="text" list="subject" name="subject" placeholder="subject"></td>
                                <td><input type="text" list="part" name="part" placeholder="part"></td>
                                <td><button class="bg-red border-red" type="submit">-</button></td> 
                            </tr>
                            <tr>
                                <td>Paper #5</td>
                                <td><input type="text" list="subject" name="subject" placeholder="subject"></td>
                                <td><input type="text" list="part" name="part" placeholder="part"></td>
                                <td><button class="bg-red border-red" type="submit">-</button></td> 
                            </tr>
                            <tr>
                                <td>Paper #6</td>
                                <td><input type="text" list="subject" name="subject" placeholder="subject"></td>
                                <td><input type="text" list="part" name="part" placeholder="part"></td>
                                <td><button class="bg-red border-red" type="submit">-</button></td> 
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><button class="bg-blue border-blue" type="submit">+</button></td>  
                            </tr>
                        </tbody>
                        <datalist id="part">
                            <option value="Part A">
                            <option value="Part B">
                            <option value="Part C">
                        </datalist>
                    </table>
                    </div>
                    <div style="float: right; width: 20%">
                        <button class="bg-green border-green" type="submit">Upload Files</button>
                    </div>         
                </div>
                <div class="col-3-item" style="height: 380px; overflow: auto;">
                    <table>
                        <thread>
                            <tr>
                                <th>Subject Code</th>
                                <th>Subject Name</th>
                                <th>Part</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thread>
                        <tbody>
                            <tr>
                                <td>SCS2201</td>
                                <td>Subject-I</td>
                                <td>Part A</td>
                                <td><button class="bg-blue border-blue" type="submit">View Paper</button></td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>                            
                            <tr>
                                <td>SCS2201</td>
                                <td>Subject-I</td>
                                <td>Part B</td>
                                <td><button class="bg-blue border-blue" type="submit">View Paper</button></td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2202</td>
                                <td>Subject-II</td>
                                <td>Part A</td>
                                <td><button class="bg-blue border-blue" type="submit">View Paper</button></td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2202</td>
                                <td>Subject-II</td>
                                <td>Part B</td>
                                <td><button class="bg-blue border-blue" type="submit">View Paper</button></td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2202</td>
                                <td>Subject-II</td>
                                <td>Part C</td>
                                <td><button class="bg-blue border-blue" type="submit">View Paper</button></td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2203</td>
                                <td>Subject-III</td>
                                <td>Part A</td>
                                <td><button class="bg-blue border-blue" type="submit">View Paper</button></td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2205</td>
                                <td>Subject-V</td>
                                <td>Part A</td>
                                <td><button class="bg-blue border-blue" type="submit">View Paper</button></td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2205</td>
                                <td>Subject-V</td>
                                <td>Part B</td>
                                <td><button class="bg-blue border-blue" type="submit">View Paper</button></td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2207</td>
                                <td>Subject-VII</td>
                                <td>Part A</td>
                                <td><button class="bg-blue border-blue" type="submit">View Paper</button></td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2207</td>
                                <td>Subject-VII</td>
                                <td>Part B</td>
                                <td><button class="bg-blue border-blue" type="submit">View Paper</button></td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                            <tr>
                                <td>SCS2207</td>
                                <td>Subject-VII</td>
                                <td>Part C</td>
                                <td><button class="bg-blue border-blue" type="submit">View Paper</button></td>
                                <td><button class="bg-red border-red" type="submit">Delete Paper</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>                
            </div>

            <div id="managesubjects" class="tabcontent" style="height: 600px;">
                <div class="container" style="width: 25%; float: left">
                    <div class="col-2-item strong text-white">Year:</div>
                    <div class="col-4-item">
                        <input type="text" name="year" value="<?php echo date("Y"); ?>">
                    </div>
                </div>
                <div class="container" style="width: 25%; float: left">
                    <div class="col-2-item strong text-white">Semester:</div>
                    <div class="col-4-item">
                        <input type="text" list="semester" name="semester">
                    </div> 
                </div>
                <div class="container" style="width: 25%; float: left">
                    <div class="col-2-item strong text-white">Course:</div>
                    <div class="col-4-item">
                        <input type="text" list="course" name="course">
                    </div> 
                </div>
                <div class="container" style="width: 25%; float: left">
                    <div class="col-2-item strong text-white">Year of Study:</div>
                    <div class="col-4-item">
                        <input type="text" list="studyyear" name="studyyear">
                    </div>
                </div>
                <div class="col-5-item strong" style="font-size: 26px">Add Subject</div>
                <div class="col-1-item">
                    <button class="bg-blue border-blue" type="submit">Show Subjects</button>
                </div>
                <div class="col-3-item bg-body"><hr>
                    <div class="col-2-item strong text-white">Subject Code:</div>
                    <div class="col-4-item">
                        <input type="text" name="subjectcode">
                    </div>
                    <div class="col-2-item strong text-white">Subject Name:</div>
                    <div class="col-4-item">
                        <input type="text" name="subjectname">
                    </div>
                    <div class="col-2-item strong text-white">Previous Subject Name:</div>
                    <div class="col-4-item">
                        <input type="text" list="subject" name="subject" placeholder="Fill this, if the added subject is a revised subject.">
                    </div>
                    <div class="col-2-item" style="float: right;">
                        <button class="bg-green border-green" type="submit">Add Subject</button>  
                    </div>         
                </div>
                <div class="col-3-item" style="height: 380px; overflow: auto;">
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