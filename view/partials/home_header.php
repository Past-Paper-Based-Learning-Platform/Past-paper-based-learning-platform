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
    <link rel="stylesheet" href="http://localhost/Main/libs/css/feed.css" type="text/css">
    <link rel="stylesheet" href="libs/css/discussionForm.css" type="text/css">
    <link rel="stylesheet" href="libs/css/alert.css" type="text/css">
    <link rel="stylesheet" href="libs/css/studentmeeting.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="libs/js/alert.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="http://localhost/Main/libs/js/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="row container" style="background-color:rgb(0, 99, 165);">
        <section class = 'logohead'>
            <a href='http://localhost/Main/homeindex.php?page=home.php'><img src= 'pictures/logoPPB.png' class='logoimg'></a>
            <h1 class="sitename">Past Paper Base Learning PlatForm</h1>
        </section>
        <div class="col-6-item bg-gray homeheadtab" style="width:100%;">
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

        <table class="hometable" style="width:100%;height:88%;table-layout: fixed;">
            <tr>
                <td style="width:20%;text-align:center;">
                    <div class="col-6-item bg-gray lefthometab" style="height: 100%;margin:0px;">
                        <img src="<?php echo $image; ?>" class="profilepic" alt="Profile Picture" style="text-align:center;">
                        <div style="text-align:center;">
                            <i class="fa fa-trophy" style="width:23%"></i>
                            <i class="fa fa-heart" style="width:23%"></i>
                            <i class="fa fa-diamond" style="width:23%"></i>
                            <i class="fa fa-certificate" style="width:23%"></i>
                        </div>

                        <!--profile-->
                        <div class="verticlebtn" style="text-align:center;margin-top:8px;">
                            <a href=""><button class="gradient-blue verticlebtn" >View My Profile</button></a>
                        </div>

                        <!-- Ask a quesion from past paper -->
                        <div class="dropdown" style="text-align:center; width:100%; margin:0px;">
                            <button onclick="dropdownpaper()" class="gradient-blue dropbtn verticlebtn">Ask a Quesion From Past Paper</button>
                            <div id="myDropdown" class="dropdown-content">
                                <input type="text" placeholder="Search Pastpaper.." id="myInput" onkeyup="filterFunction()">
                                <?php
                                    while($row = mysqli_fetch_assoc($result_paper))
                                    {
                                        echo "<a href='http://localhost/Main/homeindex.php?page=pastpaper.php&paper_id=".$row['paper_id']."&subject_code=".$row['subject_code']."' target='_blank'>".$row['subject_code']. "-" .$row['subject_name']. "-".$row['year']. "-" .$row['semester']. "-" .$row['part']. "</a><br>";
                                    }
                                ?>
                            </div>
                        </div><br>
                    
                    <!-- Scedule meeting -->
                    <div class="verticlebtn" style="text-align:center;margin-top:8px;">
                        <a href="http://localhost/Main/homeindex.php?page=meeting.php"><button class="gradient-blue verticlebtn" >Scedule Meeting</button></a>
                    </div>



                <div>
                </td>
                
                <!-- Content -->
                <td style="width:60%;border: none;">