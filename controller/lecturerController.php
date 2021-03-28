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

			if(isset($_POST['setavailable'])){
				$this->setAvailable();
			}

			if(isset($_POST['setnotavailable'])){
				$this->setNotAvailable();
			}
		}

        //page view
		public function viewHome($userId,$page)
		{
			$subjects = $this->objsm->getInterestList($userId);
			$allSubjects = $this->objsm->getSubjects($userId);
			$result_paper = $this->objsm->get_pastpapers();
            $result_lesson = $this->objsm->getLessons();
            if($page != 'pastpaper.php'){
               // $result_user_discussion=$this->objsm->getUserDiscussion($userId);
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

			if($page=='meeting.php'){
				$available=$this->objsm->getAvailabledays($userId);
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
            $target_file = basename($_FILES["answer_script"]["name"]);
            $uploadOk = 1;
            $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            //Check whether a valid pastpaper choosen
            if($paperid)
            {
                $uploadOk = 1;//*
                //Check if there's a file
                $check = filesize($_FILES['answer_script']['tmp_name']);
                if($check !== false)
                {
                    $uploadOk = 1;//*
                    //check if the file is a pdf
                    if($FileType != "pdf") 
                    {
                        $error=3; //not a pdf
                    }
                    else{
                        //Cheack if file already exists,if exists - rename the file
                        while(file_exists($target_dir .$target_file)){
							$target_file = "copy-" . $target_file;
						}
                       
                        //upload answer script
                        if(move_uploaded_file($_FILES['answer_script']['tmp_name'],$target_dir.$target_file))
                        {
                            $result = $this->objsm->uploadscript($target_file,$paperid);
                            if($result)
                            {
                                $error=0;
                            }
                            else
                            {
                                $error=4;//failed to upload
                            }
                        }else{
                            $error=4;//failed to upload
                        }
                            
                        
                    }
                }
                else
                {
                    $error=2; //haven't u[ploaded a file
                }
            }
            else
            {
                $error=1; //haven't selected a pastpaper
            }

            
			echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php?page=upload_answer.php&error='.$error.'")</script>';
			
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
			$extags = explode(",",$tags);
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

		public function setAvailable(){
			$user_id = $_SESSION['user_id'];

			$available=[];

			if(isset($_POST['Monday'])){
				array_push($available,$_POST['Monday']);
			}
			if(isset($_POST['Tuesday'])){
				array_push($available,$_POST['Tuesday']);
			}
			if(isset($_POST['Wednesday'])){
				array_push($available,$_POST['Wednesday']);
			}
			if(isset($_POST['Thursday'])){
				array_push($available,$_POST['Thursday']);
			}
			if(isset($_POST['Friday'])){
				array_push($available,$_POST['Friday']);
			}
			if(isset($_POST['Saterday'])){
				array_push($available,$_POST['Saterday']);
			}
			if(isset($_POST['Sunday'])){
				array_push($available,$_POST['Sunday']);
			}

			$this->objsm->insertAvailableDays($user_id,$available);

			echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php?page=meeting.php")</script>';
		}
		
		public function setNotAvailable(){
			$user_id = $_SESSION['user_id'];
			$available=[];

			if(isset($_POST['Monday'])){
				array_push($available,$_POST['Monday']);
			}
			if(isset($_POST['Tuesday'])){
				array_push($available,$_POST['Tuesday']);
			}
			if(isset($_POST['Wednesday'])){
				array_push($available,$_POST['Wednesday']);
			}
			if(isset($_POST['Thursday'])){
				array_push($available,$_POST['Thursday']);
			}
			if(isset($_POST['Friday'])){
				array_push($available,$_POST['Friday']);
			}
			if(isset($_POST['Saterday'])){
				array_push($available,$_POST['Saterday']);
			}
			if(isset($_POST['Sunday'])){
				array_push($available,$_POST['Sunday']);
			}

			$this->objsm->deleteAvailableDays($user_id,$available);

			echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php?page=meeting.php")</script>';
		}
    }
?>