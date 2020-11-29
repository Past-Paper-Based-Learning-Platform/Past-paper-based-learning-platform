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
		}

        //page view
		public function viewHome($userId,$page)
		{
			$subjects = $this->objsm->getInterestList($userId);
			$allSubjects = $this->objsm->getSubjects($userId);
			$result_paper = $this->objsm->get_pastpapers();
			$result_lesson = $this->objsm->getLessons();
			if($page == 'pastpaper.php'){
				$paper_result =$this->objsm->get_paperpath($userId);
				$answer_result = $this->objsm->get_answerpath($userId);
			}
            include 'view/lecturer/'.$page.'';
		}
		
		//update subjects
		public function addsubjects(){
			$subjects=$_POST['addSubjcts'];
            $userId = $_SESSION['user_id'];
			$this->objsm->updateSubjects($userId,$subjects);
			$subjects = $this->objsm->getInterestList($userId);
			$allSubjects = $this->objsm->getSubjects($userId);
			echo '<script language="javascript">window.location.assign("http://localhost/Main/lecturerindex.php")</script>';
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
            }
            else
            {
                echo "<script language='javascript'> alert('Please select a pastpaper'); </script>";
                $uploadOk = 0;
            }

            //Check if there's a file
            $check = filesize($_FILES['answer_script']['tmp_name']);
            if($check !== false)
            {
                $uploadOk = 1;
            }
            else
            {
                echo "You haven't chosen a file";
                $uploadOk = 0;
            }

            //check if the file is a pdf
            if($FileType != "pdf") 
            {
                echo "Sorry, only PDF files are allowed.";
                $uploadOk = 0;
            }

            //Cheack if file already exists
            if (file_exists($target_file))
            {
                echo "You have already uploaded your file or Rename the file and try again";
                $uploadOk = 0;
            }

            if($uploadOk == 0)
            {
                echo "Sorry, Failed to upload the file";
            }
            else
            {
                //upload answer script
                if(move_uploaded_file($_FILES['answer_script']['tmp_name'],$target_file))
                {
                    $result = $this->objsm->uploadscript($target_file,$paperid);
                    if($result)
                    {
                        echo "The file ". htmlspecialchars( basename( $_FILES["answer_script"]["name"])). " has been uploaded.";
                    }
                    else
                    {
                        echo "Sorry, Failed to upload the file";
                    }
                }
            }
        }

    }
?>