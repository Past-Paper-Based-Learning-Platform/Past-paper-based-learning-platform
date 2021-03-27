<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="libs/css/pastpaper.css" type="text/css">
    <link rel="stylesheet" href="libs/css/alert.css" type="text/css">
    <script src="http://localhost/Main/libs/js/jquery.min.js"></script>
    <script src="libs/js/alert.js"></script>
</head>

<body>
    <section class = 'logohead'>
        <a href='http://localhost/Main/homeindex.php?page=home.php'><img src= 'pictures/logoPPB.png' class='logoimg'></a>
        <h1 class="sitename">Past Paper Base Learning PlatForm</h1>
    </section>
    <section class="pdf">
        <div class="sidetab">
            <button type="button" class="question">Ask Question</button>
            <button type="button" class="pastpaper">Past Paper</button>
            <button type="button" class="answerscript">Answer Script</button>
        </div>
        <div class="discussionform" style="display:none;">
            <form action="http://localhost/Main/homeindex.php?page=pastpaper.php&paper_id=<?php echo $paper_id; ?>&subject_code=<?php echo $_GET['subject_code']; ?>" method="post" enctype="multipart/form-data" id="questionform" >
                <h1 style="float:left;">Question:</h1>
                <textarea name="question" id="question"></textarea>

                <br><h1 style="float:left;">Attach Image:</h1>
                <input type="file" name="image" id="image"></input>

                <br style="clear:both;"><h1 style="float:left;">Tag lessons:</h1>
                <div class="tag-container">   
                    <input />
                </div>
                <div class="tag-input" style="display:none">
                    <input type="text" name="tags"></input>
                </div>

                <br style="clear:both;"><h1 style="float:left; font-size:15px;">Ask Question Anonymously: </h1>
                <input type="checkbox" name="anonymous" id="anonymous"></input>

                <br style="clear:both;">
                <button type="submit" class="submitbtn" name="create_discussion">Ask Question</button>
            </form>
        </div>
        <div class="content" id="content">
            <iframe src="pastpapers/<?php echo $paper_result ?>" style="display:block;" id="pdfpp" frameborder="0"></iframe>
            <iframe src="answerscripts/<?php echo $answer_result ?>" style="display:none;" id="pdfans" frameborder="0"></iframe>
        </div>
    </section>
    <div class="alert alert1" style="display:none;" id="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Please type your Question in the question feild or Upload your question as an image.!
    </div>
    <div class="alert alert2" style="display:none;" id="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Uploaded file is not an image.!
    </div>
    <div class="alert alert3" style="display:none;" id="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Failed to upload the image.!
    </div>
    <div class="alert alert4" style="display:none;" id="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        Already asked question.!
    </div>
    <?php if(isset($_GET['error'])){
        if ($_GET['error']==1){
            echo '<script>var alert=document.querySelector(".alert1"); alert.style.display="block";</script>';
        }elseif($_GET['error']==2){
            echo '<script>var alert=document.querySelector(".alert2"); alert.style.display="block";</script>';
        }elseif($_GET['error']==3){
            echo '<script>var alert=document.querySelector(".alert3"); alert.style.display="block";</script>';
        }elseif($_GET['error']==4){
            echo '<script>var alert=document.querySelector(".alert4"); alert.style.display="block";</script>';
        }
    }?>
    <script type="text/javascript">
        $('#questionform').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) { 
                e.preventDefault();
                return false;
            }
        });
    </script>
    <script src="libs/js/pastpaper.js"></script>
    
</body>

</html>