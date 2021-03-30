<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Examination Department Home</title>
    <link rel="stylesheet" href="http://localhost/Main/libs/main.css" type="text/css">
    <link href="http://localhost/Main/libs/css/jquery.filer.css" rel="stylesheet">
    <style>
        div.trans {
            background: rgba(0, 0, 0, 0.5);
        }
    </style>
    <script src="http://code.jquery.com/jquery-3.1.0.min.js"
            crossorigin="anonymous"> 
    </script> 
      
    <script src="http://localhost/Main/libs/js/jquery.filer.min.js" 
            type="text/javascript"> 
    </script> 
    <script src="http://localhost/Main/libs/js/custom.js" type="text/javascript"></script> 
<body>
    <div class="container">
        <div class="col-6-item page-title text-white">
            Examination Department
            <span style="float:right; font-size:16px">
                <a href="http://localhost/Main/examindex.php?page=changepassword.php" style="text-decoration:none; color: white">change password</a>
                &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
                <span style="float:right;"> 
                   <form action="http://localhost/Main/examindex.php" method="post">
                    <button type="submit" name="logout" class="gradient-blue border-blue text-white">log-out</button>&nbsp;
                </form>
                   </span>
                   </span>
        </div>
    </div>
    <div class="row container"><hr>
        <div class="col-5-item" style="height: 700px;">
            <div class="tab gradient-blue">
                <div class="col-3-item">
                    <button id="uploadtab" class="tablinks" onclick="openTab(event, 'uploadpastpapers')">Upload Past Papers</button>
                </div>
                <div class="col-3-item">
                    <button id="subjecttab" class="tablinks" onclick="openTab(event, 'managesubjects')">Subject Details</button>
                </div>
            </div>  
            
            <div id="uploadpastpapers" class="tabcontent" style="height: 600px; background: rgba(0, 0, 0, 0.5);">
                <form action="http://localhost/Main/examindex.php?tag=exam&tab=upload" method="post">
                <div class="col-3-item">
                    <div style="width: 50%; float: left">
                        <div class="col-2-item text-white">Year:</div>
                        <div class="col-4-item">
                            <input type="text" name="year" id="inputyear" value="<?php echo isset($_POST['year']) ? $_POST['year'] : date('Y'); ?>" required>
                        </div>
                    </div>
                    <div style="width: 50%; float: left">
                        <div class="col-2-item text-white">Semester:</div>
                        <div class="col-4-item">
                            <input type="text" list="semester" name="semester" id="inputsemester" value="<?php echo isset($_POST['semester']) ? $_POST['semester'] : ''; ?>" required>
                        </div> 
                    </div>
                    <div style="width: 50%; float: left">
                        <div class="col-2-item text-white">Course:</div>
                        <div class="col-4-item">
                            <input type="text" list="course" name="course" id="inputcourse" value="<?php echo isset($_POST['course']) ? $_POST['course'] : ''; ?>" required>
                        </div> 
                    </div>
                    <div style="width: 50%; float: left">
                        <div class="col-2-item text-white">Year of Study:</div>
                        <div class="col-4-item">
                            <input type="text" list="studyyear" name="studyyear" id="inputstudyyear" value="<?php echo isset($_POST['studyyear']) ? $_POST['studyyear'] : ''; ?>" required>                        
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-3-item">
                        <button id="enter" class="gradient-blue border-blue" type="submit" name="enterbtn">Show Available Papers</button>
                    </div>                     
                </div>
                    <div class="col-6-item" style="height: 300px; overflow: auto;">
                        <?php
                            if(isset($result1) && $result1->num_rows > 0){
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
                                    while($row = mysqli_fetch_array($result1)){
                                        echo "<tr>";
                                            echo "<td>" . $row['subject_code'] . "</td>";                                        
                                            echo "<td>" . $row['subject_name'] . "</td>";
                                            echo "<td>" . $row['part'] . "</td>";
                                            echo "<td><a href='http://localhost/Main/pastpapers/".$row['past_paper']."' target='_blank'><button class='gradient-blue border-blue' type='button' style='font-size: 11px'>View Paper</button></a></td>";
                                        //    echo "<input type='hidden' name='paper' value='".$row['past_paper']."' />";
                                            echo "<td><button class='gradient-red border-red' style='font-size: 11px' name='deletebtn' onclick =\"javascript: return confirm('Are you sure you want to permanently remove this item?');\" type='submit' value='".$row['paper_id']."'>Delete Paper</button></td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                // Free result set
                                mysqli_free_result($result1);
                            } else{
                                echo "<p style='color: white'><em>No records were found.</em></p>";
                            }
                        ?>
                    </div> 
                    </div>
                </form> 
                <div class="col-3-item" style="height: 570px; border-left: 1px solid white">
                    <div class="text-white" style="font-size: 24px">Upload Papers</div><hr>          
                    <form action="http://localhost/Main/examindex.php?tag=exam" method="post" enctype="multipart/form-data"> 
                        <div class="col-1-item text-white">Year:</div>
                        <div class="col-2-item">
                            <input type="text" name="year" value="<?php date('Y'); ?>" required>
                        </div>
                        <div class="col-1-item text-white">Course:</div>
                        <div class="col-2-item">
                            <input type="text" list="course" name="course" value="" required>
                        </div>
                        <div class="container" style="height: 390px; overflow: auto">
                            <input type="file" name="files[]" id="filer_input" multiple="multiple">
                            <div class="col-2-item">
                                <button class="gradient-green border-green" type="submit" name="upload" onclick ="return confirm('Proceed to upload the files?')">Upload Files</button> 
                            </div>
                        </div>
                    </form>          
                </div>
                <datalist id="course">
                    <option value="Computer Science">
                    <option value="Information Systems">
                </datalist> 
                <datalist id="studyyear">
                    <option value="First Year">
                    <option value="Second Year">
                    <option value="Third Year">
                    <option value="Fourth Year">
                </datalist>               
            </div>

            <div id="managesubjects" class="tabcontent" style="height: 600px; background: rgba(0, 0, 0, 0.5)">
                <form action="http://localhost/Main/examindex.php?tag=exam&tab=subject" method="post">
                    <div class="container" style="width: 25%; float: left">
                        <div class="col-2-item text-white">Year:</div>
                        <div class="col-4-item">
                            <input type="text" name="subjectyear" value="<?php echo isset($_POST['subjectyear']) ? $_POST['subjectyear'] : date('Y'); ?>" required>
                        </div>
                    </div>
                    <div class="container" style="width: 25%; float: left">
                        <div class="col-2-item text-white">Semester:</div>
                        <datalist id="semesterNew">
                            <option value="Semester-I">
                            <option value="Semester-II">
                            <option value="Semester I & II"> 
                        </datalist>
                        <div class="col-4-item">
                            <input type="text" list="semesterNew" name="subjectsemester" value="<?php echo isset($_POST['subjectsemester']) ? $_POST['subjectsemester'] : ''; ?>" required>
                        </div> 
                    </div>
                    <div class="container" style="width: 25%; float: left">
                        <div class="col-2-item text-white">Course:</div>
                        <div class="col-4-item">
                            <input type="text" list="course" name="subjectcourse" value="<?php echo isset($_POST['subjectcourse']) ? $_POST['subjectcourse'] : ''; ?>" required>
                        </div> 
                    </div>
                    <div class="container" style="width: 25%; float: left">
                        <div class="col-2-item text-white">Year of Study:</div>
                        <div class="col-4-item">
                            <input type="text" list="studyyear" name="subjectstudyyear" value="<?php echo isset($_POST['subjectstudyyear']) ? $_POST['subjectstudyyear'] : ''; ?>" required>
                        </div>
                    </div>
                    <div class="col-1-item">
                        <button class="gradient-blue border-blue" type="submit" name="showsubjects">Enter</button>
                    </div>
                    
                    <div class="col-3-item strong text-white" style="font-size: 26px; float:right">Add New Subject</div>
                    <div class="row">
                        <div class="col-3-item" style="height: 380px; overflow: auto; float:left"> 
                            <?php
                                if(isset($result2) && $result2->num_rows > 0){
                                    echo "<table id='displaySubjects'>";
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>Subject Code</th>";                                        
                                                echo "<th>Subject Name</th>";
                                                echo "<th>Active Status</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        while($row = mysqli_fetch_array($result2)){
                                            echo "<tr>";
                                                echo "<td>" . $row['subject_code'] . "</td>";                                        
                                                echo "<td>" . $row['subject_name'] . "</td>";
                                                if ($row['active_flag']==1){
                                                    echo "<td><button class='gradient-red border-red' name='deactivesubjectbtn' onclick =\"javascript: return confirm('The subject will be permanently deactivated. Are you sure to proceed?');\" type='submit' value='".$row['subject_code']."'>Deactivate Subject
                                                    </button></td>";
                                                }else{
                                                    echo "<td><em>Inactive since ".$row['removed_year']."</em></td>";
                                                }
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";                            
                                    echo "</table>";
                                    // Free result set
                                    mysqli_free_result($result2);
                                }else{
                                    echo "<p style='color: white'><em>No records were found.</em></p>";
                                }
                            ?>
                        </div> 
                </form>
                    <form name="addsubject" action="http://localhost/Main/examindex.php?tag=exam&tab=subject" method="post" onSubmit="return validateForm()">
                        <div class="col-3-item"><hr>
                            <input type="hidden" name="subjectyear" value="<?php echo isset($_POST['subjectyear']) ? $_POST['subjectyear'] : date('Y'); ?>">
                            <input type="hidden" id="subsem" name="subjectsemester" value="<?php echo isset($_POST['subjectsemester']) ? $_POST['subjectsemester'] : ''; ?>">
                            <input type="hidden" id="subcourse" name="subjectcourse" value="<?php echo isset($_POST['subjectcourse']) ? $_POST['subjectcourse'] : ''; ?>">
                            <input type="hidden" id="substudyyr" name="subjectstudyyear" value="<?php echo isset($_POST['subjectstudyyear']) ? $_POST['subjectstudyyear'] : ''; ?>">
                            <datalist id="subject">
                                <?php
                                if($subjects->num_rows > 0){
                                    while($row = mysqli_fetch_array($subjects)){
                                        echo "<option value='".$row['subject_code']." ".$row['subject_name']."'>";
                                    }
                                }else{
                                    echo "<option value='No subjects. First enter details to the top form.'>";
                                }
                                ?> 
                            </datalist>
                            <div class="col-2-item text-white">Subject Code:</div>
                            <div class="col-4-item">
                                <input type="text" id="subcode" name="subjectcode">
                            </div>
                            <div class="col-2-item text-white">Subject Name:</div>
                            <div class="col-4-item">
                                <input type="text" id="subname" name="subjectname">
                            </div>
                            <div class="col-2-item text-white">Previous Subject Name:</div>
                            <div class="col-4-item">
                                <input type="text" list="subject" id="sublinkedname" name="subjectlink" placeholder="Fill this, if the added subject is a revised subject.">
                            </div>
                            <div class="col-2-item text-white">Added Year:</div>
                            <div class="col-4-item">
                                <input type="number" id="substartyr" name="subjectstartyear" min=2002>
                            </div>
                            <div class="col-2-item" style="float: right;">
                                <button class="gradient-green border-green" type="submit" name="addsubjectbtn">Add Subject</button>  
                            </div>         
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-1-item" style="height: 700px;">
            <div class="container-fit-vertical gradient-hot text-white">
                Notifications
            </div>
            <div class="container-fit-vertical trans bg-white text-gray auto-scroll" style="height: 630px;">
                &lt;Notification list&gt;
            </div>
        </div>
    </div>
    
    <script src="http://localhost/Main/libs/main.js"></script>
    <?php if (!isset($_GET['tab']) || $_GET['tab']=="upload") { ?> <!--Select previously clicked tab when reloading.-->
        <script type="text/javascript">
            $(document).ready(function() {
                $("#uploadtab").click();
            });
        </script>
    <?php } else { ?>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#subjecttab").click();
            });
        </script>
    <?php } ?>
    <script>
        function validateForm() {
            var scode, sname, addedyr, ssemester, scourse, sstudyyr, output = true;

            scode = document.addsubject.subcode;
            sname = document.addsubject.subname;
            addedyr = document.addsubject.substartyr;

            ssemester = document.addsubject.subsem;
            scourse = document.addsubject.subcourse;
            sstudyyr = document.addsubject.substudyyr;
            if (!scode.value) {
                scode.focus();
                document.getElementById("subcode").innerHTML = "required";
                output = false;
            }
            else if (!sname.value) {
                sname.focus();
                document.getElementById("subname").innerHTML = "required";
                output = false;
            }
            else if (!addedyr.value) {
                addedyr.focus();
                document.getElementById("substartyr").innerHTML = "required";
                output = false;
            }
            if (!(ssemester.value && scourse.value && sstudyyr.value)){
                alert("First enter details to the top form!");
                output = false;
            }
            return output;
        }
    </script>
    
</body>
</html>