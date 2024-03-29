<?php include 'feedsupport.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Feed</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
  <script src="http://localhost/Main/libs/js/jquery.min.js"></script>
  <link rel="stylesheet" href="http://localhost/Main/libs/main.css" type="text/css">
  <style>
        div.trans {
            background: rgba(0, 0, 0, 0.5);
        }
        .scrollhide::-webkit-scrollbar {
            display: none;
        }
        .scrollhide {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
        }
        ::-webkit-file-upload-button {
            background: #344453;
            color: #ffffff;
            outline: none;
        }

        .white-upload input[type=file]{
            color: #ffffff;
            margin-bottom: 8px;
        }

        .black-upload input[type=file]{
            color: rgb(27, 27, 36);
            margin-bottom: 8px;
        }
        /* Button used to open the contact form - fixed at the bottom of the page */
        .open-button {
            background-color: #555;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: 28px;
            width: 280px;
        }

        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position: absolute;
            top:50%;
            left:50%;
            margin-left:-300px;
            margin-top:-200px;
            border: 3px solid #f1f1f1;
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 600px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text], .form-container input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus, .form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
            cursor: pointer;
            width: 50%;
            margin-bottom:10px;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: rgb(223, 35, 35);
            border:none;
            color: white;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover, .open-button:hover {
            opacity: 1;
        }

        .post-answer{
            border-radius: 10px;
            background-color: #344453;
            color: white;
            outline: none;
        }
    </style>
</head>
<body>
<div class="scrollhide" style="width:50%; height:100%; overflow:auto; margin:auto">
  <div class="posts-wrapper">
    <div class="tab">
        <div class="col-3-item">
            <button id="generalquestion" class="tablinks" onclick="openTab(event, 'genquestion')">Ask a General Question</button>
        </div>
        <div class="col-3-item">
            <button id="pastpaperquestion" class="tablinks" onclick="openTab(event, 'ppquestion')">Ask a Past Paper-based Question</button>
        </div>
    </div>

    <div id="genquestion" class="tabcontent" style="height: 345px; background: rgba(0, 0, 0, 0.5)">
        
        <datalist id="tags">
            <?php
            if($tags->num_rows > 0){
                while($row = mysqli_fetch_array($tags )){
                    echo "<option value='".$row['tag']."'>";
                }
            }
            ?> 
        </datalist>
        <form id="general-form" action="http://localhost/Main/homeindex.php?page=feed.php" method="post" enctype="multipart/form-data" onSubmit="return validateForm()"> 
            <div class="col-1-item text-white">Question:</div>
            <div class="col-5-item">
                <textarea id="question" name="question" rows="3" cols="70" placeholder="Make it short and clear..."></textarea>
            </div>
            <div class="col-3-item select"> 
            <select name="subjectrelated" class="scrollhide"> 
                <option value="">Select Related Subject (optional)</option>                              
                <?php
                while($row = mysqli_fetch_array($subjects)){
                echo "<option value='".$row['subject_code']."'>".$row['subject_code']." ".$row['subject_name']."</option>";
                }
                ?>
            </select>
            </div>
            <div class="col-1-item text-white" style="font-size:14px">Attach a Photo: (optional)</div>
            <div class="col-2-item white-upload">
                <input type="file" name="picture" id="pictureupload" value="">
            </div>
            <div class="row">
            <div class="col-1-item text-white">Tags: (optional)</div>
            <div class="col-5-item tag-container" style="height:60px">
                <input type="text" list="tags" name="tags">
            </div>
            <input type="hidden" class="tag-list" name="taglist" value="">
            <div class="col-2-item text-white">&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="anonymity" value="1">&nbsp;&nbsp;&nbsp;&nbsp;Ask Anonymously</div>
                <div class="col-2-item">
                    <button id="postquestion" class="gradient-blue border-blue" type="submit" name="postquestion">Post Question</button> 
                </div>
            </div>
        </form>
    </div>

    <div id="ppquestion" class="tabcontent" style="height: 200px; background: rgba(0, 0, 0, 0.5)">
        <datalist id="papers">
            <?php
            if($papers->num_rows > 0){
                while($row = mysqli_fetch_array($papers)){
                    echo "<option value='".$row['subject_code']." ".$row['subject_name']." ".$row['year']." Part-".$row['part']."'>";
                }
            }else{
                echo "<option value='No papers available.'>";
            }
            ?> 
        </datalist>
        <form action="http://localhost/Main/homeindex.php" method="post"> 
            <div class="col-1-item text-white">Past Paper:</div>
            <div class="col-4-item">
                <input type="text" list="papers" name="questionsubject" value="">
            </div>
            <div class="row">
                <div class="col-2-item">
                    <button class="gradient-blue border-blue" type="submit" name="selectpaper">Select Paper</button> 
                </div>
            </div>
        </form>
    </div>
    </div>
    
    <div style="margin:auto; overflow:auto">
    <form action="" method="post">
        <div class="col-1-item text-white">Filter by Lesson:</div>
        <div class="col-4-item">
        <input type="text" list="tags" name="lesson" style="border-radius:20px; padding: 15px;" placeholder="Enter lesson name..." value="">
        </div>
        <div class="col-1-item">
        <button class="gradient-blue border-blue" style="border-radius:20px; font-size:12px" type="submit" name="lessonfilter">Filter</button>
        </div>
        <div class="col-2-item" style="float: right">
        <button class="gradient-blue border-blue" style="border-radius:20px; font-size:12px" type="submit" name="interestfilter">Filter by Interest List</button>
        </div>
        <div class="col-2-item" style="float: right">
        <button class="gradient-blue border-blue" style="border-radius:20px; font-size:12px" type="submit" name="alldiscussions">Show All Discussions</button>
        </div>
    </form>
    </div>

    <div class="form-popup" id="answerForm">
        <form action="http://localhost/Main/homeindex.php?page=feed.php" class="form-container" method="post" enctype="multipart/form-data">
        <span style="float:right"><input type="reset" class="cancel" value="&times;" onclick="closeForm()"></span>
            
            <h2>Create an Answer</h2>
            <label for="answer"><b>Answer:</b></label>
            <textarea id="answer" name="answer" rows="3" cols="70" placeholder="Make it short and clear..." required></textarea></br>
            <label for="psw"><b>Web URL or Discussion Link</b></label>
            <input type="text" placeholder="Enter URL..." name="url">
            <input type="file" name="answerAttach" value="">
            <span style="font-size: 13px"><input type="checkbox" name="anonymity" value="1">&nbsp;&nbsp;&nbsp;&nbsp;Answer Anonymously&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <input id="hiddenId" type="hidden" name="discussionId"></br></br>
            <button type="submit" class="gradient-blue border-blue btn" name="postAnswer">Post Answer</button>
            
        </form>
    </div>
    
    <div class="posts-wrapper">
    
   <?php $x=0;
   while($discussion = mysqli_fetch_array($resultdis)) {
    $disId=$discussion['discussion_id'];
    $sql = "SELECT * FROM answer WHERE discussion_id=$disId";
    $resultans = mysqli_query($conn, $sql);?>
   	<div class="post gradient-lgray">
      <?php echo $discussion['content']; ?>
      <div class="post-info">
	    <!-- if user likes post, style button differently -->
      	<i <?php if (userLiked($discussion['discussion_id'])): ?>
      		  class="fa fa-thumbs-up like-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-up like-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $discussion['discussion_id'] ?>"></i>
      	<span class="likes"><?php echo getLikes($discussion['discussion_id']); ?></span>
      	
      	&nbsp;&nbsp;&nbsp;&nbsp;

	    <!-- if user dislikes post, style button differently -->
      	<i 
      	  <?php if (userDisliked($discussion['discussion_id'])): ?>
      		  class="fa fa-thumbs-down dislike-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-down dislike-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $discussion['discussion_id'] ?>"></i>
      	<span class="dislikes"><?php echo getDislikes($discussion['discussion_id']); ?></span>
          &nbsp;&nbsp;&nbsp;&nbsp;
          <span><input class="post-answer" type="button" value="Post Answer" discussionId="<?php echo $discussion['discussion_id'] ?>" onclick="openForm()"></span>
          <?php if ($resultans->num_rows > 0){?>
            <span style="float:right"><a href="#" id="hideAnswers<?php echo $x; ?>" class="hdanswer" disId="<?php echo $x; ?>" style="text-decoration:none; color: gray">&nbsp;&nbsp;&nbsp;&nbsp; <em>Hide Answer(s)</em> </a></span>
            <span style="float:right"><a href="#" id="showAnswers<?php echo $x; ?>" class="shanswer" disId="<?php echo $x; ?>" style="text-decoration:none; color: gray"> <em> <?php echo $resultans->num_rows; ?>&nbsp;Answer(s)</em> </a></span>
            <div id="answers<?php echo $x; ?>" class="answerbox text-white" disId="<?php echo $x; ?>">
                <?php while($answer = mysqli_fetch_array($resultans)) {?>
                    <div class="post trans">
                        <?php echo $answer['content']; ?>
                        <div class="post-info">
                            <!-- if user likes post, style button differently -->
                            <i <?php if (userLikedAnswer($answer['answer_id'])): ?>
                                class="fa fa-thumbs-up like-btn-answer"
                            <?php else: ?>
                                class="fa fa-thumbs-o-up like-btn-answer"
                            <?php endif ?>
                            data-id="<?php echo $answer['answer_id'] ?>"></i>
                            <span class="likes-answer"><?php echo getLikesAnswer($answer['answer_id']); ?></span>
                            
                            &nbsp;&nbsp;&nbsp;&nbsp;

                            <!-- if user dislikes post, style button differently -->
                            <i 
                            <?php if (userDislikedAnswer($answer['answer_id'])): ?>
                                class="fa fa-thumbs-down dislike-btn-answer"
                            <?php else: ?>
                                class="fa fa-thumbs-o-down dislike-btn-answer"
                            <?php endif ?>
                            data-id="<?php echo $answer['answer_id'] ?>"></i>
                            <span class="dislikes-answer"><?php echo getDislikesAnswer($answer['answer_id']); ?></span>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                <?php }?>
            </div>
          <?php }else{ ?>
            <span style="float:right" class="text-gray"><em> No Answers</em></span>
          <?php } ?>
      </div>
   	</div>
   <?php $x++; } ?>
  </div>

  </div>
  <script src="http://localhost/Main/libs/js/likescript.js"></script>
 <script type="text/javascript">
    $( document ).ready(function(){
        var answer = document.getElementsByClassName("answerbox");
        for (var i=0; i< answer.length; i++){
            answer[i].style.display = "none";
        }
    });

    $('#general-form').on('keyup keypress', function(e) {
          var keyCode = e.keyCode || e.which;
          if (keyCode === 13) { 
            e.preventDefault();
            return false;
          }
        });
    
    $('a.shanswer').click(function(){
        var boxno= $(this).attr('disId');
        var boxId= "answers"+boxno;
        var answerbox = document.getElementById(boxId);
        answerbox.style.display = "block";
    });
    $('a.hdanswer').click(function(){
        var boxno= $(this).attr('disId');
        var boxId= "answers"+boxno;
        var answerbox = document.getElementById(boxId);
        answerbox.style.display = "none";
    });
    $('input.post-answer').click(function(){
        var discussionId= $(this).attr('discussionId');
        var hiddenId = document.getElementById('hiddenId');
        hiddenId.value = discussionId;
    });
    $(".cancel").click(function(){
        $("#answerForm").trigger("reset");
    });

    function openForm() {
        document.getElementById("answerForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("answerForm").style.display = "none";
    }

    function resetQuestionForm() {
        document.getElementById("general-form").reset();
    }

    function resetAnswerForm() {
        document.getElementById("answerForm").reset();
    }
    
  </script>
</body>
</html>