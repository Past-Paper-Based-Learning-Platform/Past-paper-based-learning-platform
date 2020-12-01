<?php 
    session_unset();
    define('BASE_URL','http://localhost/Main/');
    session_start();
    if (isset($_GET['enterbtn'])) {
        $_SESSION['year']=$_GET['year'];
        $_SESSION['semester']=$_GET['semester'];
        $_SESSION['course']=$_GET['course'];
        $_SESSION['studyyear']=$_GET['studyyear'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Examination Department Home</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/libs/main.css" type="text/css">
    <link href="<?php echo BASE_URL; ?>/libs/css/jquery.filer.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-3.1.0.min.js"
            crossorigin="anonymous"> 
    </script> 
      
    <script src="<?php echo BASE_URL; ?>/libs/js/jquery.filer.min.js" 
            type="text/javascript"> 
    </script> 
    <script src="<?php echo BASE_URL; ?>/libs/js/custom.js" type="text/javascript"></script> 
    
<body>
    <div class="container">
        <div class="col-6-item page-title bg-lblue">
            Examination Department
            <div style="float:right; font-size:18px">
                <a href="<?php echo BASE_URL;?>view/examinationdep/changepassword.php" style="text-decoration:none">change password</a>&nbsp;&nbsp;&nbsp;|
                <a href style="text-decoration:none">log-out</a>&nbsp;
            </div>
        </div>
    </div>
    <div class="row container">
        <div class="col-5-item bg-lblue" style="height: 700px;">
            <div class="tab">
                <div class="col-2-item">
                    <button class="tablinks" onclick="openTab(event, 'examinationdetails')" >Examination Details</button>
                </div>
                <div class="col-2-item">
                    <button id="defaulttab" class="tablinks" onclick="openTab(event, 'uploadpastpapers')">Upload Past Papers</button>
                </div>
                <div class="col-2-item">
                    <button class="tablinks" onclick="openTab(event, 'managesubjects')">Subject Details</button>
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
                <form action="<?php echo BASE_URL;?>examindex.php" method="post">
                <div class="col-3-item">
                    <div style="width: 50%; float: left">
                        <div class="col-2-item strong text-white">Year:</div>
                        <div class="col-4-item">
                            <input type="text" name="year" id="inputyear" value="<?php echo isset($_POST['year']) ? $_POST['year'] : date('Y'); ?>">
                        </div>
                    </div>
                    <div style="width: 50%; float: left">
                        <div class="col-2-item strong text-white">Semester:</div>
                        <div class="col-4-item">
                            <input type="text" list="semester" name="semester" id="inputsemester" value="<?php echo isset($_POST['semester']) ? $_POST['semester'] : ''; ?>">
                        </div> 
                    </div>
                    <div style="width: 50%; float: left">
                        <div class="col-2-item strong text-white">Course:</div>
                        <div class="col-4-item">
                            <input type="text" list="course" name="course" id="inputcourse" value="<?php echo isset($_POST['course']) ? $_POST['course'] : ''; ?>">
                        </div> 
                    </div>
                    <div style="width: 50%; float: left">
                        <div class="col-2-item strong text-white">Year of Study:</div>
                        <div class="col-4-item">
                            <input type="text" list="studyyear" name="studyyear" id="inputstudyyear" value="<?php echo isset($_POST['studyyear']) ? $_POST['studyyear'] : ''; ?>">                        
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-2-item">
                        <button id="enter" class="bg-blue border-blue" type="submit" name="enterbtn">Show Available Papers</button>
                    </div> 
                    
                    </div>
                    <div class="col-6-item" style="height: 300px; overflow: auto;">
                        <?php
                            if($result->num_rows > 0){
                                echo "<table id='displayPapers'>";
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>Subject Code</th>";                                        
                                            echo "<th>Subject Name</th>";
                                            echo "<th>Part</th>";
                                            echo "<th></th>";
                                            echo "<th></th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                            echo "<td>" . $row['subject_code'] . "</td>";                                        
                                            echo "<td>" . $row['subject_name'] . "</td>";
                                            echo "<td>" . $row['part'] . "</td>";
                                            echo "<td><a href='".BASE_URL."pastpapers/".$row['past_paper']."' target='_blank'><button class='bg-blue border-blue' type='button'>View Paper</button></a></td>";
                                        //    echo "<input type='hidden' name='paper' value='".$row['past_paper']."' />";
                                            echo "<td><button class='bg-red border-red' name='deletebtn' onclick =\"javascript: return confirm('Are you sure you want to permanently remove this item?');\" type='submit' value='".$row['paper_id']."'>Delete Paper</button></td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result);
                            } else{
                                echo "<p><em>No records were found.</em></p>";
                            }
                        ?>
                    </div> 
                    </div>
                </form> 
                <div class="col-3-item bg-blue" style="height: 570px;">
                    <div class="text-white" style="font-size: 24px">Upload Papers</div><hr>          
                    <form action="<?php echo BASE_URL;?>/examindex.php" method="post" enctype="multipart/form-data"> 
                        <div class="col-1-item text-white">Year:</div>
                        <div class="col-2-item">
                            <input type="text" name="year" value="<?php date('Y'); ?>">
                        </div>
                        <div class="col-1-item text-white">Course:</div>
                        <div class="col-2-item">
                            <input type="text" list="course" name="course" value="">
                        </div>
                        <div class="container" style="height: 390px; overflow: auto">
                            <input type="file" name="files[]" id="filer_input" multiple="multiple">
                            <div class="col-2-item">
                                <button class="bg-green border-green" type="submit" name="upload" onclick ="return confirm('Proceed to upload the files?')">Upload Files</button> 
                            </div>
                        </div>
                    </form>          
                </div>
                <datalist id="part">
                    <option value="Part A">
                    <option value="Part B">
                    <option value="Part C">
                    <option value="Full">
                </datalist> 
                <datalist id="subjectpaper">
                    <option value="SCS2201">
                    <option value="SCS2202">
                    <option value="SCS2203">
                    <option value="SCS2204">
                    <option value="SCS2205">
                    <option value="SCS2206">
                    <option value="SCS2207">
                    <option value="SCS2208">
                </datalist>               
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

    <script src="<?php echo BASE_URL; ?>/libs/main.js"></script>
    <script>
        function stoppedTyping(){
            if(this.value.length > 0) { 
                document.getElementById('upload').disabled = false; 
            } else { 
                document.getElementById('upload').disabled = true;
            }
        }
        function verify(){
            if ((inputyear is empty) || (inputsemester is empty) || (inputcourse is empty) || (inputstudyyear is empty)){
                alert("Put some text in there!");
                return
            }else{
                do button functionality
            }
        }
    </script>
    
</body>
</html>