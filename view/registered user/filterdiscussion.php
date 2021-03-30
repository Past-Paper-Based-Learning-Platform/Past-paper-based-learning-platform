<?php include 'feedsupport.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>filter</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
  <script src="http://localhost/Main/libs/js/jquery.min.js"></script>
  <link rel="stylesheet" href="http://localhost/Main/libs/main.css" type="text/css">
  <link rel="stylesheet" href="http://localhost/Main/libs/css/feed.css" type="text/css">
</head>
<body>
<div class="scrollhide" style="width:50%; height:100%; overflow:auto; margin:auto">

    
    <div style="margin:auto; overflow:auto;">
    <form action="http://localhost/Main/homeindex.php?page=filterdiscussion.php" method="post">
        <div class="col-2-item" style="float: right">
        <button class="gradient-blue border-blue" style="border-radius:20px; font-size:12px" type="submit" name="answereddiscussion">Answered Discussion</button>
        </div>
        <div class="col-2-item" style="float: right">
        <button class="gradient-blue border-blue" style="border-radius:20px; font-size:12px" type="submit" name="createddiscussions">Created Discussions</button>
        </div>
    </form>
    </div>


    <div class="report-form-popup" id="reportDiscussionForm">
        <form action="http://localhost/Main/homeindex.php?page=feed.php" method="post" class="form-container">
        <span style="float:right"><input type="reset" class="cancel" value="&times;" onclick="closeReportForm()"></span>
            
            <h2>Report Discussion</h2>
            <div style="font-size: 13px"><input type="radio" name="reportCause" value="1" checked>&nbsp;&nbsp;&nbsp;&nbsp;Duplicate Question&nbsp;&nbsp;&nbsp;&nbsp;</div>
            <div style="font-size: 13px"><input type="radio" name="reportCause" value="2">&nbsp;&nbsp;&nbsp;&nbsp;Inappropriate Content&nbsp;&nbsp;&nbsp;&nbsp;</div>
            <div style="font-size: 13px"><input type="radio" name="reportCause" value="3">&nbsp;&nbsp;&nbsp;&nbsp;Irrelevant Question&nbsp;&nbsp;&nbsp;&nbsp;</div>
            <input id="hiddenReportId" type="hidden" name="reportDiscussionId"></br></br>
            <button type="submit" class="gradient-red border-red btn" name="reportDiscussion">Submit</button>
            
        </form>
    </div>
    
    <div class="posts-wrapper">
    
   <?php $x=0;
   while($discussion = mysqli_fetch_array($resultdis)) {
    $disId=$discussion['discussion_id'];
    $resultans = getDiscussionAnswers($disId);
    $resulttags = getDiscussionTags($disId);
    ?>
   	<div class="post bg-white">
       <span class="discussion-username"><?php echo getDiscussionDisplayName($disId);?></span>&nbsp;&nbsp;&nbsp;
       <span class="discussion-timestamp"><?php echo trimTimestamp($discussion['timestamp']);?></span>
    <div class="row">
      <?php echo $discussion['content'];?></div>
      <?php if(!is_null($discussion['picture'])){?>
            <div class="image-wrapper">
            <img src="http://localhost/Main/questionattachments/<?php echo $discussion['picture']?>" alt="image" style="width:100%">
            </div>
      <?php } ?>
      <?php while($tag = mysqli_fetch_array($resulttags)){?>
      <div class="row">
        <span class="tags">#<?php echo $tag['tag']?>&nbsp;&nbsp;</span>
      </div>
      <?php } ?>

 <div class="form-popup" id="answerForm">
        <form action="http://localhost/Main123/homeindex.php?page=profilefilter.php" class="form-container" method="post" enctype="multipart/form-data">
        <span style="float:right"><input type="reset" class="cancel" value="&times;" onclick="closeForm()"></span>
            
            <h2>Edit Disscussion</h2>
            <label for="answer"><b>Content:</b></label>
            <textarea id="answer" name="answer" rows="3" cols="70" placeholder="Make it short and clear..." required></textarea></br>
            <button type="submit" class="gradient-blue border-blue btn" name="postAnswer">Post Answer</button>
            
        </form>
    </div>

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
          <span><input class="post-answer" type="button" value="Edit" discussionId="<?php echo $discussion['discussion_id'] ?>" onclick="openForm()"></span>
          <span><input class="post-answer" type="button" value="Delete" discussionId="<?php echo $discussion['discussion_id'] ?>" onclick="openForm()"></span>
          <?php if ($resultans->num_rows > 0){?>
            <span style="float:right"><a href="#" id="hideAnswers<?php echo $x; ?>" class="hdanswer" disId="<?php echo $x; ?>" style="text-decoration:none; color: gray">&nbsp;&nbsp;&nbsp;&nbsp; <em>Hide Answer(s)</em> </a></span>
            <span style="float:right"><a href="#" id="showAnswers<?php echo $x; ?>" class="shanswer" disId="<?php echo $x; ?>" style="text-decoration:none; color: gray"> <em> <?php echo $resultans->num_rows; ?>&nbsp;Answer(s)</em> </a></span>
            <div id="answers<?php echo $x; ?>" class="answerbox text-white" disId="<?php echo $x; ?>">
                <?php while($answer = mysqli_fetch_array($resultans)) {?>
                    <div class="post bg-dgray">
                        <span class="answer-username"><?php echo getAnswerDisplayName($disId, $answer['answer_id']);?></span>&nbsp;&nbsp;&nbsp;
                        <span class="answer-timestamp"><?php echo trimTimestamp($answer['timestamp']);?></span>
                        <div class="row">
                        <?php echo $answer['content'];?></div>
                            <?php if(!is_null($answer['picture'])){?>
                                <div class="image-wrapper">
                                <img src="http://localhost/Main/answerattachments/<?php echo $answer['picture']?>" alt="image" style="width:100%">
                                </div>
                            <?php } ?>
                        <?php if(!is_null($answer['url'])){?>
                            <div class="row">
                                <span><em>Reference:&nbsp;</em><a href="<?php echo $answer['url']?>" target="_blank" class="text-lblue"><?php echo $answer['url']?></a></span>
                            </div>
                        <?php } ?>
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
  <script src="http://localhost/Main/libs/js/feed.js"></script>
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
    $('input.report-discussion').click(function(){
        var discussionId= $(this).attr('discussionId');
        var hiddenId = document.getElementById('hiddenReportId');
        hiddenId.value = discussionId;
    });

    function openForm() {
        document.getElementById("answerForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("answerForm").style.display = "none";
    }

    function openReportForm() {
        document.getElementById("reportDiscussionForm").style.display = "block";
    }

    function closeReportForm() {
        document.getElementById("reportDiscussionForm").style.display = "none";
    }
    
  </script>
</body>
</html>