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
			//	$result=$this->objsm->show_data($paper_id);
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
	//		echo '<pre>'.print_r($_POST).'</pre>';
	//		echo '<pre>'.print_r($_SESSION).'</pre>';
	//		echo '<pre>'.print_r($_FILES).'</pre>';
	//		echo '<pre>'.print_r($_GET).'</pre>';

		//	echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>' 
            
            $user_id=$_SESSION['user_id'];
            $paperID=$_GET['paper_id'];
			$subject_code=$_GET['subject_code'];
            $question=$_POST['question'];
            $tags=$_POST['tags'];

			if(isset($_POST['anonymous'])){
            	$anonymous=$_POST['anonymous'];
			}else{
				$anonymous= 'off';
			}

			//split into seperate tags
			$extags = explode(" ,",$tags);
		//	echo '<pre>'.print_r($extags).'</pre>';
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
				$error = create_discussion($question,$target_file,$extags,$anonymous,$paperID,$subject_code,$user_id);
			}
			
			if($error>0){
				echo '<script language="javascript">window.location.assign("http://localhost/Main/homeindex.php?page=pastpaper.php&paper_id='.$paperID.'&subject_code='.$subject_code.'&error='.$error.'")</script>';
			}else{
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

    }
?>