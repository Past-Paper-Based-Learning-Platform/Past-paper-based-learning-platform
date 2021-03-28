<?php 
session_start();
// connect to database
$conn = new mysqli('localhost', 'root', '', 'systemppdb');

// lets assume a user is logged in with id $user_id
$user_id = $_SESSION['user_id'];

if (!$conn) {
  die("Error connecting to database: " . mysqli_connect_error($conn));
  exit();
}

// if user clicks like or dislike button
if (isset($_POST['post_action'])) {
  $discussion_id = $_POST['discussion_id'];
  $action = $_POST['post_action'];
  switch ($action) {
  	case 'like':
         $sql="INSERT INTO discussion_feedback (user_id, discussion_id, reaction) 
         	   VALUES ($user_id, $discussion_id, 1) 
         	   ON DUPLICATE KEY UPDATE reaction=1";
         break;
  	case 'dislike':
          $sql="INSERT INTO discussion_feedback (user_id, discussion_id, reaction) 
               VALUES ($user_id, $discussion_id, 0) 
         	   ON DUPLICATE KEY UPDATE reaction=0";
         break;
  	case 'unlike':
	      $sql="DELETE FROM discussion_feedback WHERE user_id=$user_id AND discussion_id=$discussion_id";
	      break;
  	case 'undislike':
      	  $sql="DELETE FROM discussion_feedback WHERE user_id=$user_id AND discussion_id=$discussion_id";
      break;
  	default:
  		break;
  }

  // execute query to effect changes in the database ...
  mysqli_query($conn, $sql);
  echo getRating($discussion_id);
  exit(0);
}

if (isset($_POST['answer_action'])) {
  $answer_id = $_POST['answer_id'];
  $action = $_POST['answer_action'];
  switch ($action) {
  	case 'like':
         $sql="INSERT INTO answer_feedback (user_id, answer_id, reaction) 
         	   VALUES ($user_id, $answer_id, 1) 
         	   ON DUPLICATE KEY UPDATE reaction=1";
         break;
  	case 'dislike':
          $sql="INSERT INTO answer_feedback (user_id, answer_id, reaction) 
               VALUES ($user_id, $answer_id, 0) 
         	   ON DUPLICATE KEY UPDATE reaction=0";
         break;
  	case 'unlike':
	      $sql="DELETE FROM answer_feedback WHERE user_id=$user_id AND answer_id=$answer_id";
	      break;
  	case 'undislike':
      	  $sql="DELETE FROM answer_feedback WHERE user_id=$user_id AND answer_id=$answer_id";
      break;
  	default:
  		break;
  }

  // execute query to effect changes in the database ...
  mysqli_query($conn, $sql);
  echo getRatingAnswer($answer_id);
  exit(0);
}

// Get total number of likes for a particular post
function getLikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM discussion_feedback 
  		  WHERE discussion_id = $id AND reaction=1";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

function getLikesAnswer($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM answer_feedback 
  		  WHERE answer_id = $id AND reaction=1";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of dislikes for a particular post
function getDislikes($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM discussion_feedback 
  		  WHERE discussion_id = $id AND reaction=0";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

function getDislikesAnswer($id)
{
  global $conn;
  $sql = "SELECT COUNT(*) FROM answer_feedback 
  		  WHERE answer_id = $id AND reaction=0";
  $rs = mysqli_query($conn, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}

// Get total number of likes and dislikes for a particular post
function getRating($id)
{
  global $conn;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM discussion_feedback WHERE discussion_id = $id AND reaction=1";
  $dislikes_query = "SELECT COUNT(*) FROM discussion_feedback 
		  			WHERE discussion_id = $id AND reaction=0";
  $likes_rs = mysqli_query($conn, $likes_query);
  $dislikes_rs = mysqli_query($conn, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
  	'likes' => $likes[0],
  	'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

function getRatingAnswer($id)
{
  global $conn;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM answer_feedback WHERE answer_id = $id AND reaction=1";
  $dislikes_query = "SELECT COUNT(*) FROM answer_feedback 
		  			WHERE answer_id = $id AND reaction=0";
  $likes_rs = mysqli_query($conn, $likes_query);
  $dislikes_rs = mysqli_query($conn, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
  	'likes' => $likes[0],
  	'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

// Check if user already likes post or not
function userLiked($discussion_id)
{
  global $conn;
  global $user_id;
  $sql = "SELECT * FROM discussion_feedback WHERE user_id=$user_id 
  		  AND discussion_id=$discussion_id AND reaction=1";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

function userLikedAnswer($answer_id)
{
  global $conn;
  global $user_id;
  $sql = "SELECT * FROM answer_feedback WHERE user_id=$user_id 
  		  AND answer_id=$answer_id AND reaction=1";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

// Check if user already dislikes post or not
function userDisliked($discussion_id)
{
  global $conn;
  global $user_id;
  $sql = "SELECT * FROM discussion_feedback WHERE user_id=$user_id 
  		  AND discussion_id=$discussion_id AND reaction=0";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

function userDislikedAnswer($answer_id)
{
  global $conn;
  global $user_id;
  $sql = "SELECT * FROM answer_feedback WHERE user_id=$user_id 
  		  AND answer_id=$answer_id AND reaction=0";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  	return true;
  }else{
  	return false;
  }
}

//load answers for each discussion
function getDiscussionAnswers($discussion_id){
  global $conn;
  $sql = "SELECT * FROM answer WHERE discussion_id=$discussion_id ORDER BY timestamp DESC";
  $result = mysqli_query($conn, $sql);
  return $result;
}

//load sicussion tags
function getDiscussionTags($discussion_id){
  global $conn;
  $sql = "SELECT DISTINCT tag FROM tags WHERE tag_id IN (SELECT tag_id FROM discussion_tags WHERE discussion_id=$discussion_id)";
  $result = mysqli_query($conn, $sql);
  return $result;
}

//display name for discussion
function getDiscussionDisplayName($discussion_id){
  global $conn;
  global $user_id;
  $sql = "SELECT * FROM anonymous_names WHERE discussion_id=$discussion_id AND user_id IN (SELECT user_id FROM discussion WHERE discussion_id=$discussion_id)";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result);
    if($user_id==$row['user_id']){
      $displayname="user_".$row['anonymous_number']." (Me)";
    }else{
      $displayname="user_".$row['anonymous_number'];
    }
  }else{
    $sql = "SELECT * FROM registered_user WHERE user_id IN (SELECT user_id FROM discussion WHERE discussion_id=$discussion_id)";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $displayname = $row['user_name'];
  }
  return $displayname;
}

function getAnswerDisplayName($discussion_id, $answer_id){
  global $conn;
  global $user_id;
  $sql = "SELECT * FROM anonymous_names WHERE discussion_id=$discussion_id AND user_id IN (SELECT user_id FROM answer WHERE answer_id=$answer_id)";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_array($result);
    if($user_id==$row['user_id']){
      $displayname="user_".$row['anonymous_number']." (Me)";
    }else{
      $displayname="user_".$row['anonymous_number'];
    }
  }else{
    $sql = "SELECT * FROM registered_user WHERE user_id IN (SELECT user_id FROM answer WHERE answer_id=$answer_id)";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $displayname = $row['user_name'];
  }
  return $displayname;
}

function trimTimestamp($timestamp){
  $trimTimestamp=date('g:ia Y-m-d', strtotime($timestamp));
  return $trimTimestamp;
}

$sql="SELECT subject_code, subject_name FROM subject";
$subjects = mysqli_query($conn, $sql);
$sql="SELECT DISTINCT tag FROM tags";
$tags = mysqli_query($conn, $sql);
$sql="SELECT past_paper.subject_code as subject_code, subject.subject_name as subject_name, past_paper.year as year, past_paper.part as part
    FROM past_paper, subject 
    WHERE past_paper.subject_code=subject.subject_code";
$papers = mysqli_query($conn, $sql);
if(isset($_POST['lessonfilter']) && $_POST['lesson']!=""){
  $lesson=$_POST['lesson'];
  $sql = "SELECT * FROM discussion WHERE discussion_id IN 
    (SELECT discussion_id FROM discussion_tags WHERE tag_id IN 
    (SELECT tag_id FROM tags WHERE tag='$lesson')) ORDER BY timestamp DESC";
}else if(isset($_POST['interestfilter'])){
  $sql = "SELECT * FROM discussion WHERE subject_code IN 
    (SELECT subject_code FROM interest_list WHERE user_id=$user_id) ORDER BY timestamp DESC";
}else if(isset($_POST['alldiscussions'])){
  $sql = "SELECT * FROM discussion ORDER BY timestamp DESC";
}else{
  $sql = "SELECT * FROM discussion ORDER BY timestamp DESC";
}
$resultdis = mysqli_query($conn, $sql);
// fetch all posts from database
// return them as an associative array called $posts
?>