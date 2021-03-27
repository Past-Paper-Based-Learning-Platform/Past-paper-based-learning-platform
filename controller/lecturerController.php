<?php
    require 'model/lecturerModel.php';
    require_once 'config.php';

    class lecturerController
    {
        function __construct()
        {
            $this->objconfig =new config();
            $this->objsm = new lecturerModel($this->objconfig);
        }
        public function mvcHandler() 
		{
			if (isset($_POST['upload_answers'])){
                $this->uploadanswers();
            }
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
				echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php?page=discussionlist.php")</script>';
			}
		}

        //page view
		public function viewHome($userId,$page)
		{
			$subjects = $this->objsm->getInterestList($userId);
			$allSubjects = $this->objsm->getSubjects($userId);
			$result_paper = $this->objsm->get_pastpapers();
            $result_lesson = $this->objsm->getLessons();
           // $result_user_discussion=$this->objsm->getUserDiscussion($userId);
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
			if($page=='pastpaperedit.php' or $page=='privacysetting.php'){

			}
            require_once 'view/lecturer/'.$page.'';
		}
		
		//update subjects
		public function addsubjects(){
			$subjects=$_POST['addSubjcts'];
            $userId = $_SESSION['user_id'];
			$this->objsm->updateSubjects($userId,$subjects);
			$subjects = $this->objsm->getInterestList($userId);
			$allSubjects = $this->objsm->getSubjects($userId);
			echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php?page=profilesetting.php")</script>';
		}

        //--Upload answer script--
        public function uploadanswers()
        {
            $paperid =$_POST['paper'];
            $target_dir = "answerscripts/";
            $target_file = $target_dir . basename($_FILES["answer_script"]["name"]);
            $uploadOk = 1;
            $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            //Check whether a valid pastpaper choosen
            if($paperid)
            {
                $uploadOk = 1;
                //Check if there's a file
                $check = filesize($_FILES['answer_script']['tmp_name']);
                if($check !== false)
                {
                    $uploadOk = 1;
                    //check if the file is a pdf
                    if($FileType != "pdf") 
                    {
                        echo "<script language='javascript'> alert('Sorry, only PDF files are allowed.'); </script>";
                    }
                    else{
                        //Cheack if file already exists
                        if (file_exists($target_file))
                        {
                            echo "<script language='javascript'> alert('You have already uploaded your file or Rename the file and try again'); </script>";
                        }
                        else{
                            if($uploadOk == 0)
                            {
                                echo "<script language='javascript'> alert('Sorry, Failed to upload the file'); </script>";
                            }
                            else
                            {
                                //upload answer script
                                if(move_uploaded_file($_FILES['answer_script']['tmp_name'],$target_file))
                                {
                                    $result = $this->objsm->uploadscript($target_file,$paperid);
                                    if($result)
                                    {
                                        echo "<script language='javascript'> alert('The file ". htmlspecialchars( basename( $_FILES["answer_script"]["name"])). " has been uploaded.'); </script>";
                                    }
                                    else
                                    {
                                        echo "<script language='javascript'> alert('Sorry, Failed to upload the file'); </script>";
                                    }
                                }
                            }
                        }
                    }
                }
                else
                {
                    echo "<script language='javascript'> alert('Please choose a file'); </script>";
                }
            }
            else
            {
                echo "<script language='javascript'> alert('Please select a pastpaper'); </script>";
            }
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
         
            
           echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php?page=discussion.php&paper_id='.$paper.'")</script>';
           
        }
        
        public function show_discussion(){
            
			// $paper_id=$_GET['paper_id'];
			 $result=$this->objsm->show_data();
			 return $result;
			 
			 require_once "./view/lecturer/discussion.php";
         }
         
         public function userUpdate(){
			$user_id=$_POST['user_id'];
			$first_name=$_POST['f_name'];
			$middle_name=$_POST['m_name'];
			$last_name=$_POST['l_name'];
			$email=$_POST['email'];
			$password=$_POST['password'];
	   
	
		
			$result=$this->objsm->user_update($user_id,$first_name,$middle_name, $last_name,$email,$password);
	
			
			echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php?page=profilesetting.php&user_id='.$user_id.'")</script>';
			   
		
        }
        
        public function passwordUpdate(){
			$user_id=$_POST['user_id'];
			$password=$_POST['current_pw'];
			$new_pw=$_POST['new_pw'];
			$confirm_pw=$_POST['confirm_pw'];
	
		  
			if($new_pw==$confirm_pw){
				$result=$this->objsm->password_update($user_id,$new_pw);
				if($result){
					echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php?page=profilesetting.php&user_id='.$user_id.'")</script>';
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
			echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php?page=discussion.php&paper_id='.$paper_id.'")</script>';
        }
        
        public function editDiscussion(){
			$user_id=$_POST['uid'];
			$discussion_id=$_POST['discussion_id'];
			$paper_id=$_POST['paper_id'];
			$content=$_POST['message'];
			$result=$this->objsm->get_question_details($discussion_id);
			$result2=$this->objsm->get_lesson_details($result['question_id'],$paper_id);
			require_once "./view/lecturer/pastpaperedit.php";
		}

    }
?>