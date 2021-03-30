<?php include 'filtersupport.php' ?>
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
    <form action="" method="post">
        <div class="col-2-item" style="float: right">
        <button class="gradient-blue border-blue" style="border-radius:20px; font-size:12px" type="submit" name="answereddiscussion">Answered Discussion</button>
        </div>
        <div class="col-2-item" style="float: right">
        <button id="btnId" class="gradient-blue border-blue" style="border-radius:20px; font-size:12px" type="submit" name="askeddiscussions">Asked Discussions</button>
        </div>
    </form>
    </div>


    <div class="form-popup" id="editForm" style="background-color:blue;">
        <form action="http://localhost/Main/homeindex.php?page=filter.php" class="form-container" method="post">
        <span style="float:right"><input type="reset" class="cancel" value="&times;" onclick="closeFormedit()"></span>
            
            <h2>Edit Disscussion</h2>
            <label for="answer"><b>Content:</b></label>
        
            <input id="hiddenId" type="hidden" value="discussionId" name="discussionId">
            <input id="hiddenContent" type="text" value="content" name="content">
            <input id="hiddentemp" type="hidden" value="temp" name="temp">
            <button type="submit" class="gradient-blue border-blue btn edit-answer" data_id="discussionId" name="editDiscussion">Edit</button>
            
        </form>

    </div>

    <div class="form-popup" style="background-color:red;" id="deleteForm">
        <form action="http://localhost/Main/homeindex.php?page=filter.php" class="form-container" method="post">
        <span style="float:right"><input type="reset" class="cancel" value="&times;" onclick="closeFormdelete()"></span>
            
            <h2>Do you want to delete this?</h2>
            
        
            <input id="deleteId" type="hidden" value="discussionId" name="discussionId">
            <input id="deletetemp" type="hidden" value="temp" name="temp">
            
            <button type="submit" class="gradient-blue border-blue btn edit-answer" name="deleteDiscussion">Delete</button>
            
        </form>




       




    </div>
    
    <div class="posts-wrapper">
    
   <?php $x=0;
   
   while($discussion = mysqli_fetch_array($resultdis)) {
    $disId=$discussion['discussion_id'];
    $resultans = getDiscussionAnswers($disId);
    $resultansmy = getMyDiscussionAnswers($disId);
    $resulttags = getDiscussionTags($disId);
    ?>

<?php 
if($a==1){
     ?>

    <div class="post bg-white">
    <span class="discussion-username"><?php echo getDiscussionDisplayName($disId);?></span>&nbsp;&nbsp;&nbsp;
    <span class="discussion-timestamp"><?php echo $discussion['timestamp'];?></span>
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
        <span><input class="post-answer"  type="button" value="Edit" discussionid="<?php echo $discussion['discussion_id'] ?> " content="<?php echo $discussion['content'] ?> "  temp="0" onclick="openFormedit()"></span>

        <span><input class="post-answer delete-discussion" type="button" value="Delete" discussionId="<?php echo $discussion['discussion_id'] ?>" temp="0" onclick="openFormdelete()"></span>
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

<?php }elseif($a==0){
     ?>

    <div class="post bg-white">
    <span class="discussion-username"><?php echo getDiscussionDisplayName($disId);?></span>&nbsp;&nbsp;&nbsp;
    <span class="discussion-timestamp"><?php echo $discussion['dis_time'];?></span>
    <div class="row">
    <?php echo $discussion['dis_content'];?></div>
    <?php if(!is_null($discussion['dis_picture'])){?>
            <div class="image-wrapper">
            <img src="http://localhost/Main/questionattachments/<?php echo $discussion['dis_picture']?>" alt="image" style="width:100%">
            </div>
    <?php } ?>
    <?php while($tag = mysqli_fetch_array($resulttags)){?>
    <div class="row">
        <span class="tags">#<?php echo $tag['tag']?>&nbsp;&nbsp;</span>
    </div>
    <?php } ?>



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
        
        <?php if ($resultansmy->num_rows > 0){?>
            <span style="float:right"><a href="#" id="hideAnswers<?php echo $x; ?>" class="hdanswer" disId="<?php echo $x; ?>" style="text-decoration:none; color: gray">&nbsp;&nbsp;&nbsp;&nbsp; <em>Hide Answer(s)</em> </a></span>
            <span style="float:right"><a href="#" id="showAnswers<?php echo $x; ?>" class="shanswer" disId="<?php echo $x; ?>" style="text-decoration:none; color: gray"> <em> <?php echo $resultansmy->num_rows; ?>&nbsp;Answer(s)</em> </a></span>
            <div id="answers<?php echo $x; ?>" class="answerbox text-white" disId="<?php echo $x; ?>">
                <?php while($answer = mysqli_fetch_array($resultansmy)) {?>
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
                            <span><input class="post-answer"  type="button" value="Edit" discussionid="<?php echo $answer['answer_id'] ?> " content="<?php echo $discussion['ans_content'] ?> " temp="1" onclick="openFormedit()"></span>

        <span><input class="post-answer delete-discussion" type="button" value="Delete" discussionId="<?php echo $discussion['answer_id'] ?>" temp="1"  onclick="openFormdelete()"></span>
                        </div>
                    </div>
                <?php }?>
            </div>
        <?php }else{ ?>
            <span style="float:right" class="text-gray"><em> No Answers</em></span>
        <?php } ?>
    </div>
    </div>
<?php } ?>
 


    <?php $x++; } ?>
    </div>

  </div>
  <script src="http://localhost/Main/libs/js/filter.js"></script>
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
        var content= $(this).attr('content');
        var hiddenId = document.getElementById('hiddenId');
        hiddenId.value = discussionId;
        var hiddencontent = document.getElementById('hiddenContent');
        hiddenContent.value = content;
        var temp=$(this).attr('temp');
        var hiddentemp = document.getElementById('hiddentemp');
        hiddentemp.value = temp;
    });
    $('input.delete-discussion').click(function(){
        var discussionId= $(this).attr('discussionId');
        var hiddenId = document.getElementById('deleteId');
        hiddenId.value = discussionId;
        var temp=$(this).attr('temp');
        var hiddentemp = document.getElementById('deletetemp');
        hiddentemp.value = temp;
        
    });
    $('input.report-discussion').click(function(){
        var discussionId= $(this).attr('discussionId');
        var hiddenId = document.getElementById('hiddenReportId');
        hiddenId.value = discussionId;
    });

    function openFormedit() {
        document.getElementById("editForm").style.display = "block";
    }

    function closeFormedit() {
        document.getElementById("editForm").style.display = "none";
    }

    function openFormdelete() {
        document.getElementById("deleteForm").style.display = "block";
    }

    function closeFormdelete() {
        document.getElementById("deleteForm").style.display = "none";
    }

    function openFormansweredit() {
        document.getElementById("editanswerForm").style.display = "block";
    }

    function closeFormansweredit() {
        document.getElementById("editanswerForm").style.display = "none";
    }


  </script>
</body>
</html>