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

			if (isset($_POST['uploadImage'])){
				$this->uploadProfilePicture();
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

			if (isset($_POST['postAnswer'])){
				$this->postAnswer();
			}
			
			if (isset($_POST['postquestion'])){
				$this->postGeneralQuestion();
			}

			if (isset($_POST['reportDiscussion'])){
				$this->reportDiscussion();
			}
			
			if (isset($_POST['confirm'])){
				$this->confirmMeeting();
			}

			if (isset($_POST['deny'])){
				$this->objsm->canclemeetingrequest($_POST['meetid']);
				echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php?page=meeting.php")</script>';
			}

			if(isset($_POST['setnofication'])){
				$this->setNotification();
			}

			if(isset($_POST['deactivate'])){
				$this->deactivateUser();
			}

			if(isset($_POST['rmvtintlst'])){
				$this->removeSubjects();
			}

			//edit and delete discussion 
			if (isset($_POST['editDiscussion'])){
				if($_POST['temp']==0){
					$this->editDiscussion();
					echo $_POST['discussionId'];
				}elseif($_POST['temp']==1){
					echo $_POST['discussionId'];
					$this->editanswer();
				}
			}
			if (isset($_POST['deleteDiscussion'])){
				
				if($_POST['temp']==0){
					$this->deleteDiscussion();
					echo $_POST['discussionId'];
				}elseif($_POST['temp']==1){
					echo $_POST['discussionId'];
					$this->deleteanswer();
				}
				
			}
		}

        //page view
		public function viewHome($userId,$page)
		{
			$subjects = $this->objsm->getInterestList($userId);
			$allSubjects = $this->objsm->getSubjects($userId);
			$result_paper = $this->objsm->get_pastpapers();
            $result_lesson = $this->objsm->getLessons();
			$meetingdetails = $this->objsm->getmeetingdetails($userId);
			$image = $this->objsm->getUserImage($userId);
			$notification = $this->objsm->getNotification($userId);

            if($page == 'pastpaper.php'){
				$paper_result =$this->objsm->get_paperpath($userId);
                $answer_result = $this->objsm->get_answerpath($userId);
                $paper_id=$userId;
            }
            if($page=='userprofile.php'){
        		$row=$this->objsm->get_user($userId);
				
			}

			if($page=='profilesetting.php'){
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

		//remove subjects from interest list
		public function removeSubjects(){
			$subjects=$_POST['removeSubjcts'];
            $userId = $_SESSION['user_id'];
			$this->objsm->removeInterestListSujects($userId,$subjects);
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
        
      
        public function editDiscussion(){

			$discussionId=$_POST['discussionId'];
			$content=$_POST['content'];
			$result=$this->objsm->updateDiscussion($discussionId,$content);
			echo "<script>alert('Edit Discussion - success!'); window.location.href='view/lecturer/filter.php';</script>";
		}

		public function deleteDiscussion(){
			$discussionId=$_POST['discussionId'];
			
			$result=$this->objsm->deleteDiscussion($discussionId);
			echo "<script>alert('Delete - success!'); window.location.href='view/lecturer/filter.php';</script>";
		}

		public function deleteanswer(){
			$discussionId=$_POST['discussionId'];
		
			$result=$this->objsm->deleteanswer($discussionId);
			echo "<script>alert('Delete - success!'); window.location.href='view/lecturer/filter.php';</script>";
		}

		public function editanswer(){
			$discussionId=$_POST['discussionId'];
			$content=$_POST['content'];
			$result=$this->objsm->updateanswer($discussionId,$content);
			echo "<script>alert('Edit Discussion - success!'); window.location.href='view/lecturer/filter.php';</script>";
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

		public function uploadProfilePicture(){
			$target_dir = "uploads/";
			$target_file =basename($_FILES["image"]["name"]);
			$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			$check = filesize($_FILES['image']['tmp_name']);

			//check if there is a file uploaded
			if(!empty($check)){
			
			//check if uploaded file is an image file
			if($FileType == "jpeg" || $FileType == "jpg" || $FileType == "png"){
				//avoid duplicates in the directory
				while(file_exists($target_dir .$target_file)){
					$target_file = "copy-" . $target_file;
				}
				if(!move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$target_file)){
					$error = 3; //wrong with uploading
					echo '<script> alert("Uploaded file is not successful! Error in target directory"); </script>';
				}else{
					$this->objsm->set_image($target_dir.$target_file,$_SESSION['user_id']);
					echo '<script language="javascript">window.location.assign("http://localhost/Main/homeindex.php?page=home.php")</script>';
				}
			}else{
				$error = 2; //not image type
				echo '<script> alert("Uploaded file is not an image"); </script>';
			}
			}else{
				$error=3;
				echo '<script> alert("File cannot be empty"); </script>';
			}


			echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php?page=profilesetting.php&user_id='.$_SESSION['user_id'].'")</script>';
		}

		public function postGeneralQuestion(){
			$user_id=$_SESSION['user_id'];
			$qcontent=trim($_POST['question']);
			$subject_code=$_POST['subjectrelated'];
			$attachment='';	
			date_default_timezone_set("Asia/Colombo");
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
					echo "<script>alert('Only jpeg, jpg, png extentions are allowed! Create Discussion - Unsuccess!'); window.location.href='view/lecturer/feed.php';</script>";
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
					echo "<script>alert('Already Available Question! Create Discussion - Unsuccess!'); window.location.href='view/lecturer/feed.php';</script>";
				}
			} 
			if($upload_success){
				if ($this->objsm->create_general_question($user_id, $qcontent, $subject_code, $attachment, $timestamp)){
					$result=$this->objsm->get_discussion_id($user_id, $timestamp);
					$row = mysqli_fetch_array($result);
					$discussion_id= $row['discussion_id'];
					if($tags!=""){
						$extags = explode(",", $tags);
						$this->objsm->insert_tags($discussion_id, $extags, $subject_code);
						echo "<script>alert('Successfully Created Discussion!'); window.location.href='view/lecturer/feed.php';</script>";
					}else{
						echo "<script>alert('Successfully Created Discussion! Empty Tags!'); window.location.href='view/lecturer/feed.php';</script>";
					}
				}else{
					unlink($target_file);
					echo "<script>alert('Create Discussion - Unsuccess!'); window.location.href='view/lecturer/feed.php';</script>";
				}
			}else{
				unlink($target_file);
				echo "<script>alert('Create Discussion - Unsuccess!'); window.location.href='view/lecturer/feed.php';</script>";
			}
		}

		public function postAnswer(){
			$user_id=$_SESSION['user_id'];
			$content=trim($_POST['answer']);
			$url=trim($_POST['url']);
			$attachment='';	
			$discussion_id=$_POST['discussionId'];
			date_default_timezone_set("Asia/Colombo");
			$timestamp=date('Y-m-d H:i:s');
			$upload_success=true;
			$priority=1;
			if(!empty(filesize($_FILES['answerAttach']['tmp_name']))){
				$attachment = basename($_FILES['answerAttach']['name']);
      			$file_tmp =$_FILES['answerAttach']['tmp_name'];
      			$file_type=$_FILES['answerAttach']['type'];
      			$file_ext=strtolower(end(explode('.',$_FILES['answerAttach']['name'])));

				$extensions= array("jpeg","jpg","png");

				if(in_array($file_ext,$extensions)=== false){
					$upload_success=false;
					echo "<script>alert('Only jpeg, jpg, png extentions are allowed! Create Answer - Unsuccess!'); window.location.href='view/lecturer/feed.php';</script>";
				}else{
					while(file_exists("answerattachments/".$attachment)){
						$attachment="copy-".$attachment;
					}
					$target_file="answerattachments/".$attachment;
					if(!move_uploaded_file($file_tmp,$target_file)){
						echo "<script>alert('Create Answer - Unsuccess!'); window.location.href='view/lecturer/feed.php';</script>";
					}
				}
			}
			if($upload_success){
				if ($this->objsm->create_answer($user_id, $content, $url, $attachment, $discussion_id, $timestamp, $priority)){
					echo "<script>alert('Successfully Created Answer!'); window.location.href='view/lecturer/feed.php';</script>";					
				}else{
					unlink($target_file);
					echo "<script>alert('Create Answer - Unsuccess!'); window.location.href='view/lecturer/feed.php';</script>";
				}
			}else{
				unlink($target_file);
				echo "<script>alert('Create Answer - Unsuccess!'); window.location.href='view/lecturer/feed.php';</script>";
			}
		}

		public function reportDiscussion(){
			$user_id=$_SESSION['user_id'];
			$discussion_id=$_POST['reportDiscussionId'];
			$cause=$_POST['reportCause'];
			date_default_timezone_set("Asia/Colombo");
			$timestamp=date('Y-m-d H:i:s');
			if($this->objsm->create_report($user_id, $discussion_id, $cause, $timestamp)){
				echo "<script>alert('Report Submit - Success!'); window.location.href='view/lecturer/feed.php';</script>";
			}else{
				echo "<script>alert('Report Submit - Unsuccess!'); window.location.href='view/lecturer/feed.php';</script>";
			}
		}

		//confirm meeting
		public function confirmMeeting(){
			$error=0;
			$meetid= $_POST['meetid'];

			if($_POST['meettime'] != 0){
				$time = $_POST['meettime'];
				$this->objsm->confirmMeeting($meetid,$time);
			}else{
				$error=1; //no time defined
			}

			if($error == 0){
				echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php?page=meeting.php")</script>';
			}else{
				echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php?page=meeting.php&error='.$error.'")</script>';
			}
		}

		//notification seetings on/off
		public function setNotification(){
			if($_POST['notificationon']==''){
				$block=1;
			}else{
				$block=0;
			}

			$this->objsm->setnotification($block,$_SESSION['user_id']);

			echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php?page=profilesetting.php&user_id='.$_SESSION['user_id'].'")</script>';
		}

		//deactivate user
		public function deactivateUser(){
			if(isset($_POST['checkboxslide']) && $_POST['checkboxslide']=='D'){
				$this->objsm->deactivateUser($_SESSION['user_id']);
				session_destroy();
				echo '<script type="text/javascript">'; 
				echo 'alert("Account disabled successfully");'; 
				echo 'window.location.assign("http://localhost/Main/index.php")';	
				echo '</script>';
				
			}
		}
		
    }
?>