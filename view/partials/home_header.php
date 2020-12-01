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
    <link rel="stylesheet" href="libs/css/discussionForm.css" type="text/css">
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
    <section class = 'logohead'>
        <a href='http://localhost/Main/homeindex.php?page=home.php'><img src= 'pictures/logoPPB.png' class='logoimg'></a>
        <h1 class="sitename">Past Paper Base Learning PlatForm</h1>
    </section>
    <div class="row container">
        <div class="col-6-item bg-dblue homeheadtab" style="width:100%;">
            <div class="col-1-item" style="color:white;">
            <a href='http://localhost/Main/homeindex.php?page=home.php'class='usernametag'>Hi <?php echo $username ?></a>
            </div>
            <div class="col-3-item">
                <form action="http://localhost/Main/homeindex.php?page=home.php">
                        <div class="serchbar">
                            <a href="http://localhost/Main/homeindex.php"><input type="text" placeholder="Search.." name="search"></a>
                        </div>
                        <div class='searchbtn'>
                            <a href="http://localhost/Main/homeindex.php" ><button class="bg-blue border-dblue" type="submit"><i class="fa fa-search"></i></button></a>   
                        </div>
                </form>
            </div>
            <div class="col-1-item" style="float:right;">
                <form action="http://localhost/Main/homeindex.php" method = "POST">
                    <button class="bg-blue border-dblue logoutbtn" type="submit" name="logout">Log out</button>
                </form>
                <a href="http://localhost/Main/homeindex.php?page=profilesetting.php&user_id=<?php echo $userId; ?>">
                    <button class="bg-blue border-dblue settingsbtn" type="submit" name="logout">
                        <i class="fa fa-cog fa-lg"></i>
                    </button>
                </a>
            </div>
        </div>

        <table class="table" style="width:100%;height:88%;table-layout: fixed;">
            <tr style="backgroung-color:none;">
                <td style="width:20%;text-align:center;">
                <div class="col-6-item bg-lblue lefthometab" style="height: 100%">
                    <img src="pictures/thumbnail.PNG" class="profilepic" alt="Profile Picture" style="text-align:center;">
                    <div style="text-align:center;">
                        <i class="fa fa-trophy" style="width:23%"></i>
                        <i class="fa fa-heart" style="width:23%"></i>
                        <i class="fa fa-diamond" style="width:23%"></i>
                        <i class="fa fa-certificate" style="width:23%"></i>
                    </div>

                    <!-- view past paper -->
                    <div class="dropdown" style="text-align:center;">
                        <button onclick="dropdownpaper()" class="dropbtn">View PastPaper</button>
                        <div id="myDropdown" class="dropdown-content">
                            <input type="text" placeholder="Search Pastpaper.." id="myInput" onkeyup="filterFunction()">
                            <?php
                                while($row = mysqli_fetch_assoc($result_paper))
                                {
                                    echo "<a href='http://localhost/Main/homeindex.php?page=pastpaper.php&paper_id=".$row['paper_id']."' target='_blank'>".$row['subject_code']. "-" .$row['subject_name']. "-".$row['year']. "-" .$row['semester']. "-" .$row['part']. "</a><br>";
                                }
                            ?>
                            <button onclick="document.location='http://localhost/Main/homeindex.php?page=home.php'" id="complian" style="display:none;">Complain</button>
                        </div>
                    </div><br>

                    <!-- view questions -->
                    <form action="http://localhost/Main/homeindex.php" method = "POST">
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
                    <a href="http://localhost/Main/homeindex.php?page=meeting.php"><button class="tablinks bg-dblue border-dblue" style="width:60%">Scedule Meeting</button></a>
                    </div>
                <div>
                </td>
                
                <!-- Content -->
                <td style="width:60%;border: 1px solid black">