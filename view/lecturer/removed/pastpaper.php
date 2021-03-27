<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>View Past Paper</title>
    <link rel="stylesheet" href="libs/main.css" type="text/css">
    <link rel="stylesheet" href="libs/css/discussionForm.css" type="text/css">
</head>


<body>

    <div class='container'>
    <section class = 'logohead'>
            <a href='http://localhost/Main/lecturerindex.php?page=lecturerHome.php'><img src= 'pictures/logoPPB.png' class='logoimg'></a>
            <h1 class="sitename">Past Paper Base Learning PlatForm</h1>
        </section>
    <div class="tab" >
        <div class="col-3-item"  style='margin:auto;'>
        <a href='http://localhost/Main/lecturerindex.php?page=pastpaper.php&paper_id=<?php echo $paper_id; ?>'><button style="background:blue;">Past Paper</button></a>
        </div>
        <div class="col-3-item"  style='margin:auto;'>
        <a href='http://localhost/Main/lecturerindex.php?page=discussion.php&paper_id=<?php echo $paper_id; ?>'><button>Discussion</button></a>
        </div>
    </div>

        <div class="col-3-item bg-gray" style="height: 95%; width:48.25%; margin:10px;">
            <div class="tab">
                <div class="col-3-item">
                    <button id="secondary_defaulttab" class="secondary_tablinks" onclick="secondary_openTab(event, 'questionpaper')" >Question Paper</button>
                </div>

                <div class="col-3-item">
                    <button class="secondary_tablinks" onclick="secondary_openTab(event, 'answersheet')">Answer Sheet</button>
                </div>
            </div>

            <div  id="questionpaper" class="secondary_tabcontent" style="height: 400px; display: block;">
                <h3>Past Paper</h3>
                <iframe class="paper_frame" src="pastpapers/<?php echo $paper_result ?>"></iframe>
            </div>
            
            <div id="answersheet" class="secondary_tabcontent" style="height: 400px; display: none;">
                <h3>Answer sheet</h3>
                <iframe class="paper_frame" src="<?php echo $answer_result ?>"></iframe>
            </div>
        </div> 

        <div class="col-3-item bg-gray" style="height: 95%; width:48.25%; margin:10px;">
            <h3>New discussion</h3>

            <?php
            
        echo" <div class='container'>
        

        <form action='http://localhost/Main/lecturerindex.php?page=discussion.php&paper_id='".$paper_id."' method='POST'>
            <input type='hidden' name=paper_id value='".$paper_id."'>
            <input type='hidden' name=user_id value='".$_SESSION['user_id']."'>
        <div class='part-selection'>
            <select name='part' class='part-select' required>
                <option disabled=''>PART</option>
                <option >A</option>
                <option >B</option>
                <option >Other</option>
            </select>

            <select name='main-question' class='part-select' required>
                <option disabled=''>Main Question</option>
                <option >01</option>
                <option >02</option>
                <option >03</option>
                <option >04</option>
            </select>

            <select name='sub-question' class='part-select' required>
                <option disabled=''>Sub Question</option>
                <option >01</option>
                <option >02</option>
                <option >03</option>
                <option >04</option>
            </select>

            <select name='question' class='part-select' required>
                <option disabled=''>Main Question</option>
                <option >a</option>
                <option >b</option>
                <option >c</option>
                <option >d</option>
            </select><br>
        </div>

        <button class='bg-dblue' style='width:20%'>CROP</button>

        <div class='lesson-area'>
            <label >Lesson</label><br>
            <textarea style='height:50px; border-radius:10px;' class='lesson' name='lesson'></textarea><br>
        </div>
        <div class='content-area'>
            <label >Content</label><br>
            <textarea class='content' style='height:70px; border-radius:10px;' name='content'></textarea><br>
            
        </div>
        <div class='radio-btn'>
            
            <input type='hidden'  name='type' class='radio-type' value='Discussion'>
        <br>
        </div>
        <div class='create-btn'>
        <input  class='bg-blue border-blue btn' style='width: 20%;' type='submit' name='create_discussion' value='Create'>
        </div>
        </form>
        </div>";

    ?>
        </div>    
    </div>


    <script src="libs/main.js"></script>
</body>
</html>