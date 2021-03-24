<?php include 'likedislike.php' ?>
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
    </style>
</head>
<body>
  <div class="posts-wrapper" style="height:700px">
    <div class="tab">
        <div class="col-3-item">
            <button id="generalquestion" class="tablinks" onclick="openTab(event, 'genquestion')">Ask a General Question</button>
        </div>
        <div class="col-3-item">
            <button id="pastpaperquestion" class="tablinks" onclick="openTab(event, 'ppquestion')">Ask a Past Paper-based Question</button>
        </div>
    </div>



    <div id="genquestion" class="tabcontent" style="height: 400px; background: rgba(0, 0, 0, 0.5)">
        <datalist id="subjects">
            <?php
            if($subjects->num_rows > 0){
                while($row = mysqli_fetch_array($subjects)){
                    echo "<option value='".$row['subject_code']." ".$row['subject_name']."'>";
                }
            }else{
                echo "<option value='No subjects. First enter details to the top form.'>";
            }
            ?> 
        </datalist>
        <form action="http://localhost/Main/homeindex.php" method="post"> 
            <div class="col-1-item text-white">Question:</div>
            <div class="col-5-item">
                <textarea id="question" name="question" rows="4" cols="70"></textarea>
            </div>
            <div class="col-1-item text-white">Related Subject:</div>
            <div class="col-2-item">
                <input type="text" list="subjects" name="questionsubject" value="">
            </div>
            <div class="col-1-item text-white">Upload a Picture:</div>
            <div class="col-2-item">
                <input type="file" name="picture" id="pictureupload">
            </div>
            <div class="row">
            <div class="col-1-item text-white">Tags:</div>
            <div class="col-5-item">
                <input type="text" name="tags" value="">
            </div>
                <div class="col-2-item">
                    <button class="gradient-green border-green" type="submit" name="postquestion">Post Question</button> 
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
                    <button class="gradient-green border-green" type="submit" name="postquestion">Select Paper</button> 
                </div>
            </div>
        </form>
    </div>
    
   <?php while($discussion = mysqli_fetch_array($result)) {?>
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
          <span><a href style="text-decoration:none"> answer </a></span>
      </div>
   	</div>
   <?php } ?>
  </div>
  <script src="http://localhost/Main/libs/js/likescript.js"></script>
</body>
</html>