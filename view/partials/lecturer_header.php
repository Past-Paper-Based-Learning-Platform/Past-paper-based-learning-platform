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
    <link rel="stylesheet" href="libs/css/template.css" type="text/css">
    <link rel="stylesheet" href="libs/css/dnd.css">
    <link rel="stylesheet" href="libs/css/upload_answer.css" type="text/css">
    <link rel="stylesheet" href="libs/css/alert.css" type="text/css">
    <link rel="stylesheet" href="libs/css/discussionForm.css" type="text/css">
    <link rel="stylesheet" href="libs/css/lecturemeeting.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="libs/js/alert.js"></script>
    <script src="libs/js/lecturemeeting.js"></script>
</head>
<body>
    <div class="row">
        <section class = 'logohead'>
            <a href='http://localhost/Main/lecturerindex.php?page=lecturerHome.php'><img src= 'pictures/logoPPB.png' class='logoimg'></a>
            <h1 class="sitename">Past Paper Base Learning PlatForm</h1>
        </section>
        <div class="row" style="width:100%;">
            <div class="col-1-item" style="color:white;">
            <a href='http://localhost/Main/lecturerindex.php?page=lecturerHome.php'class='usernametag'>Hi <?php echo $username ?></a>
            </div>
            <div class="col-3-item">
                <form action="http://localhost/Main/lecturerindex.php?page=lecturerHome.php">
                        <div class="serchbar">
                            <a href="http://localhost/Main/lecturerindex.php"><input type="text" placeholder="Search.." name="search"></a>
                        </div>
                        <div class='searchbtn'>
                            <a href="http://localhost/Main/lecturerindex.php" ><button class="gradient-blue border-blue" type="submit"><i class="fa fa-search"></i></button></a>   
                        </div>
                </form>
            </div>
            <div class="col-1-item" style="float:right;">
                <form action="http://localhost/Main/lecturerindex.php" method = "POST">
                    <button class="gradient-blue border-blue logoutbtn" type="submit" name="logout">Log out</button>
                </form>
                <a href="http://localhost/Main/lecturerindex.php?page=profilesetting.php&user_id=<?php echo $userId; ?>">
                    <button class="gradient-blue border-blue settingsbtn" type="submit" name="logout">
                        <i class="fa fa-cog fa-lg"></i>
                    </button>
                </a>
            </div>
        </div>

        <table class="hometable" style="width:100%;height:650px;table-layout: fixed;">
            <tr>
                <td style="width:20%;text-align:center;">
                    <div class="col-6-item bg-gray lefthometab" style="height: 100%;margin:0px;">
                        <img src="pictures/thumbnail.PNG" class="profilepic" alt="Profile Picture" style="text-align:center;">
                        <div style="text-align:center;">
                            <i class="fa fa-trophy" style="width:23%"></i>
                            <i class="fa fa-heart" style="width:23%"></i>
                            <i class="fa fa-diamond" style="width:23%"></i>
                            <i class="fa fa-certificate" style="width:23%"></i>
                        </div>

                        <!--profile-->
                        <div>
                            <a href=""><button class="verticlebtn" >My Contributions</button></a>
                            <a href='http://localhost/Main/lecturerindex.php?page=lecturerHome.php'><button class="verticlebtn" >Go to Feed</button></a>

                        <!-- Ask a Quesion From Past Paper -->
                        <div class="dropdown" style="text-align:center; width:100%; margin:0px;">
                            <button onclick="dropdownpaper()" class="verticlebtn">Ask a Quesion From Past Paper</button>
                            <div id="myDropdown" class="dropdown-content">
                                <input type="text" placeholder="Search Pastpaper.." id="myInput" onkeyup="filterFunction()">
                                <?php
                                    foreach($result_paper as $row)
                                    {
                                       echo "<a href='http://localhost/Main/lecturerindex.php?page=pastpaper.php&paper_id=".$row['paper_id']."&subject_code=".$row['subject_code']."' target='_blank'>".$row['subject_code']. "-" .$row['subject_name']. "-".$row['year']. "-" .$row['semester']. "-" .$row['part']. "</a><br>";
                                    }
                                ?>
                            </div>
                        </div><br>
                    
                    <!-- Schedule meeting -->
                    <a href="http://localhost/Main/lecturerindex.php?page=meeting.php"><button class="verticlebtn" >Meetings</button></a>
                    

                    <!-- Upload past paper -->
                    <a href="http://localhost/Main/lecturerindex.php?page=upload_answer.php"><button class="verticlebtn">Upload AnswerScript</button></a>
                    </div>
                <div>
                </td>
                
                <!-- Content -->
                <td style="width:60%;border: none;">