<?php 
// connect to database
$conn = new mysqli('localhost', 'root', '', 'systemppdb');

// lets assume a user is logged in with id $user_id
$user_id = 44;

if (!$conn) {
  die("Error connecting to database: " . mysqli_connect_error($conn));
  exit();
}

// if user clicks like or dislike button
if (isset($_POST['action'])) {
  $discussion_id = $_POST['discussion_id'];
  $action = $_POST['action'];
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

$sql="SELECT subject_code, subject_name FROM subject";
$subjects = mysqli_query($conn, $sql);
$sql="SELECT past_paper.subject_code as subject_code, subject.subject_name as subject_name, past_paper.year as year, past_paper.part as part
    FROM past_paper, subject 
    WHERE past_paper.subject_code=subject.subject_code";
$papers = mysqli_query($conn, $sql);
$sql = "SELECT * FROM discussion";
$result = mysqli_query($conn, $sql);
// fetch all posts from database
// return them as an associative array called $posts
?>