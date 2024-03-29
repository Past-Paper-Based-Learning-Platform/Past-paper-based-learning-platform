<?php
	require 'model/homeModel.php';
	require_once 'config.php';
    
	class homeController 
	{

 		function __construct() 
		{          
			$this->objconfig = new config();
			$this->objsm =  new homeModel($this->objconfig);
		}
		
		// mvc handler request
		public function mvchandler() 
		{
			if (isset($_POST['updtintlst'])){
				$this->addSubjects();
			}
			if (isset($_POST['logout'])){
				$this->logout();
			}

			if (isset($_POST['create_discussion'])){
				$this->createDiscussion();
			}

			if (isset($_POST['updateuser'])){
				$this->userUpdate();
			}

			if (isset($_POST['changepassword'])){
				$this->passwordUpdate();
			}

			if (isset($_POST['delete'])){
				$this->deleteDiscussion();
			}

			if (isset($_POST['edit'])){
				$this->editDiscussion();
			}

			if (isset($_POST['showquestions'])){
				echo '<script language="javascript">window.location.assign("http://localhost/Main/homeindex.php?page=discussionlist.php")</script>';
			}

			if (isset($_POST['postAnswer'])){
				echo "i'm here1";
				$this->postAnswer();
			}
			
			if (isset($_POST['postquestion'])){
				$this->postGeneralQuestion();
			}
		}

		//page view
		public function viewHome($userId,$page)
		{
			$subjects = $this->objsm->getInterestList($userId);
			$allSubjects = $this->objsm->getSubjects($userId);
			$result_paper = $this->objsm->getPastpapers();
			$result_lesson = $this->objsm->getLessons();
			if($page != 'pastpaper.php'){
			$result_user_discussion=$this->objsm->getUserDiscussion($userId);
			}
			
			if($page == 'pastpaper.php'){
				$paper_result =$this->objsm->get_paperpath($userId);
				$answer_result = $this->objsm->get_answerpath($userId);
				$paper_id=$userId;
			}
			if($page=='userprofile.php'){
        		$row=$this->objsm->get_user($userId);
				
			}

			if($page=='profilesetting.php' or $page=='privacysetting.php'){
				$row=$this->objsm->get_user($userId);
				
				
			}
			if($page=='pastpaperedit.php'){

			}
           require_once 'view/registered user/'.$page.'';
		}
		
		//update subjects
		public function addsubjects(){
			$subjects=$_POST['addSubjcts'];
            $userId = $_SESSION['user_id'];
			$this->objsm->updateSubjects($userId,$subjects);
			$subjects = $this->objsm->getInterestList($userId);
			$allSubjects = $this->objsm->getSubjects($userId);
			echo '<script language="javascript">window.location.assign("http://localhost/Main/homeindex.php?page=profilesetting.php")</script>';
		}

		//logout user
		public function logout(){
			session_destroy();
			echo '<script language="javascript">window.location.href ="http://localhost/Main/index.php"</script>';
		}

		//ask question from past paper
		public function createDiscussion(){

            $user_id=$_SESSION['user_id'];
            $paperID=$_GET['paper_id'];
			$subject_code=$_GET['subject_code'];
            $question=$_POST['question'];
            $tags=$_POST['tags'];

			$anonymous;
			if(isset($_POST['anonymous'])){
            	$anonymous=$_POST['anonymous'];
			}
			$anonymous='off';

			//split into seperate tags
			$extags = explode(" ,",$tags);
			$error=0;
			
			$check = filesize($_FILES['image']['tmp_name']);

			//check if there is a quesion written or uploaded
			if($question == '' && empty($check)){
					$error = 1; //neither image nor question
			}else{
				//check if there is a file uploaded
				if(empty($check)){
					$target_file='';
				}else{
					$target_dir = "questionattachments/";
					$target_file =basename($_FILES["image"]["name"]);
					$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
					
					//check if uploaded file is an image file
					if($FileType == "jpeg" || $FileType == "jpg" || $FileType == "png"){
						//avoid duplicates in the directory
						while(file_exists($target_dir .$target_file)){
							$target_file = "copy-" . $target_file;
						}
						if(!move_uploaded_file($_FILES['image']['tmp_name'],$target_dir .$target_file)){
							$error = 3; //wrong with uploading
						}
					}else{
						$error = 2; //not image type
					}
				}
			}
			if($error == 0){ 
				$error = $this->objsm->create_discussion($question,$target_file,$extags,$anonymous,$paperID,$subject_code,$user_id);
			}
			
			if($error>0){ //pass error
				echo '<script language="javascript">window.location.assign("http://localhost/Main/homeindex.php?page=pastpaper.php&paper_id='.$paperID.'&subject_code='.$subject_code.'&error='.$error.'")</script>';
			}else{ //no errors
				echo '<script language="javascript">window.location.assign("http://localhost/Main/homeindex.php?page=pastpaper.php&paper_id='.$paperID.'&subject_code='.$subject_code.'")</script>';
			}
		}
		
		public function show_discussion(){
            
			// $paper_id=$_GET['paper_id'];
			 $result=$this->objsm->show_data();
			 return $result;
			 
			 require_once "./view/registered user/discussion.php";
		 }

		 public function userUpdate(){
			$user_id=$_POST['user_id'];
			$first_name=$_POST['f_name'];
			$middle_name=$_POST['m_name'];
			$last_name=$_POST['l_name'];
			$email=$_POST['email'];
			$password=$_POST['password'];
	   
	
		
			$result=$this->objsm->user_update($user_id,$first_name,$middle_name, $last_name,$email,$password);
	
			
			echo '<script language="javascript">window.location.assign("http://localhost/Main/homeindex.php?page=profilesetting.php&user_id='.$user_id.'")</script>';
			   
		
		}

		public function passwordUpdate(){
			$user_id=$_POST['user_id'];
			$password=$_POST['current_pw'];
			$new_pw=$_POST['new_pw'];
			$confirm_pw=$_POST['confirm_pw'];
	
		  
			if($new_pw==$confirm_pw){
				$result=$this->objsm->password_update($user_id,$new_pw);
				if($result){
					echo '<script language="javascript">window.location.assign("http://localhost/Main/homeindex.php?page=profilesetting.php&user_id='.$user_id.'")</script>';
				}
			}else{
				echo"incurrect password";
			}
		}

		public function deleteDiscussion(){
			$resource_id=$_POST['uid'];
			$discusssion_id=$_POST['dis_id'];
			$parent_resource_id=$_POST['res_id'];
			$paper_id=$_POST['paper_id'];
			
			$result=$this->objsm->delete_data($resource_id,$discusssion_id,$parent_resource_id);
			echo '<script language="javascript">window.location.assign("http://localhost/Main/homeindex.php?page=discussion.php&paper_id='.$paper_id.'")</script>';
		}

		public function editDiscussion(){
			$user_id=$_POST['uid'];
			$discussion_id=$_POST['discussion_id'];
			$paper_id=$_POST['paper_id'];
			$content=$_POST['message'];
			$result=$this->objsm->get_question_details($discussion_id);
			$result2=$this->objsm->get_lesson_details($result['question_id'],$paper_id);
			require_once "./view/registered user/pastpaperedit.php";
		}

		public function postGeneralQuestion(){
			$user_id=$_SESSION['user_id'];
			$qcontent=trim($_POST['question']);
			$subject_code=$_POST['subjectrelated'];
			$attachment='';	
			$timestamp=date('Y-m-d H:i:s');
			$upload_success=true;
			$tags=$_POST['taglist'];
			if(!empty(filesize($_FILES['picture']['tmp_name']))){
				$attachment = basename($_FILES['picture']['name']);
      			$file_tmp =$_FILES['picture']['tmp_name'];
      			$file_type=$_FILES['picture']['type'];
      			$file_ext=strtolower(end(explode('.',$_FILES['picture']['name'])));

				$extensions= array("jpeg","jpg","png");

				if(in_array($file_ext,$extensions)=== false){
					$upload_success=false;
					echo "<script>alert('Only jpeg, jpg, png extentions are allowed! Create Discussion - Unsuccess!'); window.location.href='view/registered user/feed.php';</script>";
				}else{
					while(file_exists("questionattachments/".$attachment)){
						$attachment="copy-".$attachment;
					}
					$target_file="questionattachments/".$attachment;
					move_uploaded_file($file_tmp,$target_file);
				}
			}else{
				$result=$this->objsm->existing_question($qcontent);
				if($result->num_rows > 0){
					$upload_success=false;
					echo "<script>alert('Already Available Question! Create Discussion - Unsuccess!'); window.location.href='view/registered user/feed.php';</script>";
				}
			} 
			if($upload_success){
				if ($this->objsm->create_general_question($user_id, $qcontent, $subject_code, $attachment, $timestamp)){
					$result=$this->objsm->get_discussion_id($user_id, $timestamp);
					$row = mysqli_fetch_array($result);
					$discussion_id= $row['discussion_id'];
					if(isset($_POST['anonymity'])){						
						if(!$this->objsm->initial_anonymous_name($discussion_id, $user_id)){
							echo "<script>alert('Sorry! Could not create the discussion anonymously!'); window.location.href='view/registered user/feed.php';</script>";
						}else{
							echo "<script>alert('Successfully Created Discussion!'); window.location.href='view/registered user/feed.php';</script>";
						}
					}
					if($tags!=""){
						$extags = explode(",", $tags);
						$this->objsm->insert_tags($discussion_id, $extags, $subject_code);
						echo "<script>alert('Successfully Created Discussion!'); window.location.href='view/registered user/feed.php';</script>";
					}else{
						echo "<script>alert('Successfully Created Discussion! Empty Tags!'); window.location.href='view/registered user/feed.php';</script>";
					}
				}else{
					unlink($target_file);
					echo "<script>alert('Create Discussion - Unsuccess!'); window.location.href='view/registered user/feed.php';</script>";
				}
			}else{
				unlink($target_file);
				echo "<script>alert('Create Discussion - Unsuccess!'); window.location.href='view/registered user/feed.php';</script>";
			}
		}

		public function postAnswer(){
			$user_id=$_SESSION['user_id'];
			$content=trim($_POST['answer']);
			$url=trim($_POST['url']);
			$attachment='';	
			$discussion_id=$_POST['discussionId'];
			$timestamp=date('Y-m-d H:i:s');
			$upload_success=true;
			if(!empty(filesize($_FILES['answerAttach']['tmp_name']))){
				$attachment = basename($_FILES['answerAttach']['name']);
      			$file_tmp =$_FILES['answerAttach']['tmp_name'];
      			$file_type=$_FILES['answerAttach']['type'];
      			$file_ext=strtolower(end(explode('.',$_FILES['answerAttach']['name'])));

				$extensions= array("jpeg","jpg","png");

				if(in_array($file_ext,$extensions)=== false){
					$upload_success=false;
					echo "<script>alert('Only jpeg, jpg, png extentions are allowed! Create Answer - Unsuccess!'); window.location.href='view/registered user/feed.php';</script>";
				}else{
					while(file_exists("answerattachments/".$attachment)){
						$attachment="copy-".$attachment;
					}
					$target_file="answerattachments/".$attachment;
					if(!move_uploaded_file($file_tmp,$target_file)){
						echo "<script>alert('Create Answer - Unsuccess!'); window.location.href='view/registered user/feed.php';</script>";
					}
				}
			}
			if($upload_success){
				if ($this->objsm->create_answer($user_id, $content, $url, $attachment, $discussion_id, $timestamp)){
					if(isset($_POST['anonymity'])){
						$result=$this->objsm->get_anonymous_number($user_id, $discussion_id);
						if($result->num_rows == 0){
							$result=$this->objsm->last_anonymous_number($discussion_id);
							if($result->num_rows > 0){
								$row = mysqli_fetch_array($result);
								$anonymous_num=(int)$row['anonymous_number']+1;
								if(!$this->objsm->assign_anonymous_name($discussion_id, $user_id, $anonymous_num)){
									echo "<script>alert('Sorry! Could not create the answer anonymously!'); window.location.href='view/registered user/feed.php';</script>";
								}else{
									echo "<script>alert('Successfully Created Answer!'); window.location.href='view/registered user/feed.php';</script>";
								}
							}else if (!$this->objsm->initial_anonymous_name($discussion_id, $user_id)){
								echo "<script>alert('Sorry! Could not create the answer anonymously!'); window.location.href='view/registered user/feed.php';</script>";
							}else{
								echo "<script>alert('Successfully Created Answer!'); window.location.href='view/registered user/feed.php';</script>";
							}
						}else{
							echo "<script>alert('Successfully Created Answer!'); window.location.href='view/registered user/feed.php';</script>";
						}						
					}else{
						echo "<script>alert('Successfully Created Answer!'); window.location.href='view/registered user/feed.php';</script>";
					}
				}else{
					unlink($target_file);
					echo "<script>alert('Create Answer - Unsuccess!'); window.location.href='view/registered user/feed.php';</script>";
				}
			}else{
				unlink($target_file);
				echo "<script>alert('Create Answer - Unsuccess!'); window.location.href='view/registered user/feed.php';</script>";
			}
		}
    }
?>