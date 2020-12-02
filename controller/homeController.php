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
				echo '<script language="javascript">window.location.assign("http://localhost/Main/homeindex.php")</script>';
			}
			
		}

		//page view
		public function viewHome($userId,$page)
		{
			$subjects = $this->objsm->getInterestList($userId);
			$allSubjects = $this->objsm->getSubjects($userId);
			$result_paper = $this->objsm->getPastpapers();
			$result_lesson = $this->objsm->getLessons();
			$result_user_discussion=$this->objsm->getUserDiscussion($userId);
			
			if($page == 'pastpaper.php' or $page == 'discussion.php'){
				$paper_result =$this->objsm->get_paperpath($userId);
				$answer_result = $this->objsm->get_answerpath($userId);
				$paper_id=$userId;
				$result=$this->objsm->show_data($paper_id);
				
				
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

		public function createDiscussion(){
            
            $user_id=$_POST['user_id'];
            $level1=$_POST['part'];
            $level2=$_POST['main-question'];
            $level3=$_POST['sub-question'];
            $level4=$_POST['question'];

            $lesson=strtolower($_POST['lesson']);
           
            $content=$_POST['content'];
            $type=$_POST['type'];
            
            $paper= $_POST['paper_id'] ; 
            
            
            $result=$this->objsm->create_discussion($user_id,$level1,$level2,$level3,$level4,$lesson,$content,$type,$paper);
         
            
           echo '<script language="javascript">window.location.assign("http://localhost/Main/homeindex.php?page=discussion.php&paper_id='.$paper.'")</script>';
           
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