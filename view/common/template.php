<!DOCTYPE html>
<?php
include_once '../../controller/Template.php';

    $template = new Template();

    $strArr = explode("-", $_GET['username']);
    $username  = $strArr[0];
    $userId = $strArr[1];

    $subjects = $template->getInterestList($userId);
    $allSubjects = $template->getSubjects($userId);
    $result_paper = $template->getPastpapers();
    $result_lesson = $template->getLessons();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $template->addSubjects($userId);
        $subjects = $template->getInterestList($userId);
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../../libs/main.css" type="text/css">
    <link rel="stylesheet" href="../../libs/template.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $( function() {
        $( "#datepicker" ).datepicker();
    } );
    </script>
</head>
<body>
    <div class="row container">
        <div class="col-6-item bg-lblue">
            <div class="tab">
                    <div class="search-container">
                        <form action="/action_page.php">
                            <div class="col-6-item" style="width:100%;">
                                <div class="col-1-item" style="color:white;">
                                    Hi <?php echo $username ?>
                                </div>
                                <div class="col-3-item">
                                    <a href=""><input type="text" placeholder="Search.." name="search"></a>
                                </div>
                                <div class="col-1-item">
                                    <a href="#" ><button type="submit"><i class="fa fa-search"></i></button></a>   
                                </div>
                                <div class="col-1-item" >
                                    <a href="#" style="color:white;">Settings</a>
                                    <i class="fa fa-cog fa-lg" style="color:white;"></i>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>

            <table class="table" style="width:100%;height:88%;table-layout: fixed">
                <tr>
                    <td style="width:20%;border: 1px solid black;text-align:center">
                        <img src="../../pictures/thumbnail.PNG" alt="Trulli" width="70%" height="50%" style="text-align:center;">
                        <div style="text-align:center;">
                            <i class="fa fa-trophy"></i>
                            <i class="fa fa-heart"></i>
                            <i class="fa fa-diamond"></i>
                            <i class="fa fa-certificate"></i>
                        </div>

                        <!-- view past paper -->
                        <form action=".." method = "POST">
                            <div>
                                <input list="paper" name="paper" placeholder="Select Paper">
                                <datalist id="paper">
                                    <?php
                                    while($row = mysqli_fetch_assoc($result_paper))
                                    {
                                        echo "<option value = ".$row['paper_id']." > ".$row['subject_code']. "-" .$row['subject_name']. "-".$row['year']. "-" .$row['semester']. "-" .$row['part']. "</option>";
                                    }
                                    ?>
                                </datalist><br>
                            </div>
                            <div>
                                <button class="bg-dblue border-dblue" type="submit" style="width:60%" name="showpaper">View past paper</button>
                            </div>
                        </form>

                        <a href="#">complain</a><br/><br/>

                        <!-- view questions -->
                        <form action=".." method = "POST">
                            <div>
                                <input list="lesson" name="lesson" placeholder="Select lesson">
                                <datalist id="lesson">
                                    <?php
                                    while($row = mysqli_fetch_assoc($result_lesson))
                                    {
                                        echo "<option value = ".$row['tag']." > ".$row['tag']. "-" .$row['subject_code']. "-".$row['subject_name']. "</option>";
                                    }
                                    ?>
                                </datalist><br>
                            </div>
                            <div>
                                <button class="bg-dblue border-dblue" type="submit" style="width:60%" name="showquestions">View questions</button>
                            </div>
                        </form>
                        
                        <!-- Scedule meeting -->
                        <div style="text-align:center;">
                            <button class="tablinks bg-dblue border-dblue" style="width:60%" onclick="openTab(event, 'meeting')">Scedule Meeting</button>
                        </div>

                    </td>
                    
                    <!-- Content -->
                    <td style="width:60%;border: 1px solid black">
                        <!-- HOME default content -->
                        <div id="home" class="tabcontent" style="height: 600px; display: block;">
                            <h1>Content</h1>
                        </div>
                        
                        <!-- Scedule meeting Content -->
                        <div id="meeting" class="tabcontent" style="height: 600px; display: none block;">
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
                    </td>

                    <td style="width:20%;border: 1px solid black;">
                        <div class="bg-gray">
                            <h4 style="text-align:center;">Interest List</h4>
                            <ul style="list-style-type: square;">
                                <?php
                                    foreach($subjects as $subject) {
                                        echo "<li>". $subject. "</li>";
                                    }
                                ?>
                            </ul> 
                            <div style="text-align:center;">
                                <form action="" method="post" id="addSubjectsForm">
                                    <div class="custom-select-stu" id="custom-select-stu" style="color:black">Select More..</div>
                                    <div id="custom-select-option-box-stu" style="height: 67px; overflow: auto;">
                                        <?php 
                                            foreach($allSubjects as $subject){
                                               echo "<div class='custom-select-option-stu'> <input onchange='toggleFillColor(this);'  class='custom-select-option-checkbox-stu' type='checkbox' name='addSubjcts[]' value='".$subject['subject_code']."'> ".$subject['subject_name']." </div>";  
                                            }
                                        ?>
                                    </div>
                                    <button class="bg-dblue border-dblue" type="submit" style="width:30%">Add</button>
                                </form>            
                            </div>
                        </div>
                        <div class="bg-gray">
                            <h4 style="text-align:center;">Notification</h4>
                        <div>
                        <p>Date: <input type="text" id="datepicker"></p>
                        <div style="text-align:center;">
                          <a href="#">complain</a><br/><br/>
                        <div>    
                    </td>
                </tr>
            </table>
        
        </div>
        <script src="../../libs/main.js"></script>
        <script>
             $("#custom-select").on("click", function() {
                $("#custom-select-option-box").toggle();
            });
            function toggleFillColor(obj) {
                $("#custom-select-option-box").show();
                if ($(obj).prop('checked') == true) {
                    $(obj).parent().css("background", '#c6e7ed');
                } else {
                    $(obj).parent().css("background", '#FFF');
                }
            }
            $(".custom-select-option").on("click", function(e) {
                var checkboxObj = $(this).children("input");
                if ($(e.target).attr("class") != "custom-select-option-checkbox") {
                    if ($(checkboxObj).prop('checked') == true) {
                        $(checkboxObj).prop('checked', false)
                    } else {
                        $(checkboxObj).prop("checked", true);
                    }
                }
                toggleFillColor(checkboxObj);
            });

            $("body")
                .on("click",
                function(e) {
                    if (e.target.id != "custom-select"
                            && $(e.target).attr("class") != "custom-select-option") {
                        $("#custom-select-option-box").hide();
                    }
                });

        </script>
    </div>
</body>
</html>