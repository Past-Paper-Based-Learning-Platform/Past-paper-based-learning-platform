<!DOCTYPE html>
<?php
    $username = $_SESSION['user_name'];
    $userId =$_SESSION['user_id'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="libs/main.css" type="text/css">
    <link rel="stylesheet" href="libs/template.css" type="text/css">
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
                        <img src="pictures/thumbnail.PNG" alt="Trulli" width="70%" height="50%" style="text-align:center;">
                        <div style="text-align:center;">
                            <i class="fa fa-trophy"></i>
                            <i class="fa fa-heart"></i>
                            <i class="fa fa-diamond"></i>
                            <i class="fa fa-certificate"></i>
                        </div>

                        <!-- view past paper -->
                        <div class="dropdown" style="text-align:center;">
                            <button onclick="dropdownpaper()" class="bg-dblue border-dblue">View PastPaper</button>
                            <div id="myDropdown" class="dropdown-content">
                                <input type="text" placeholder="Search Pastpaper.." id="myInput" onkeyup="filterFunction()">
                                <?php
                                    foreach($result_paper as $row)
                                    {
                                       echo "<a href='http://localhost/Main/lecturerindex.php?page=pastpaper.php&paper_id=".$row['paper_id']."' target='_blank'>".$row['subject_code']. "-" .$row['subject_name']. "-".$row['year']. "-" .$row['semester']. "-" .$row['part']. "</a><br>";
                                    }
                                ?>
                            </div>
                        </div><br>

                        <a href="#">complain</a><br/><br/>

                        <!-- view questions -->
                        <form action="http://localhost/Main/lecturerindex.php?page=lecturerHome.php" method = "POST">
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
                        <a href="http://localhost/Main/lecturerindex.php?page=meeting.php"><button class="tablinks bg-dblue border-dblue" style="width:60%">Scedule Meeting</button></a>
                        </div>

                        <div style="text-align:center;">
                        <a href="http://localhost/Main/lecturerindex.php?page=upload_answer.php"><button class="tablinks bg-dblue border-dblue" style="width:60%">Upload AnswerScript</button></a>
                        </div>

                    </td>
                    
                    <!-- Content -->
                    <td style="width:60%;border: 1px solid black">