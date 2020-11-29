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
		}

		//page view
		public function viewHome($userId,$page)
		{
			$subjects = $this->objsm->getInterestList($userId);
			$allSubjects = $this->objsm->getSubjects($userId);
			$result_paper = $this->objsm->getPastpapers();
			$result_lesson = $this->objsm->getLessons();
			if($page == 'pastpaper.php'){
				$paper_result =$this->objsm->get_paperpath($userId);
				$answer_result = $this->objsm->get_answerpath($userId);
			}
            include 'view/registered user/'.$page.'';
		}
		
		//update subjects
		public function addsubjects(){
			$subjects=$_POST['addSubjcts'];
            $userId = $_SESSION['user_id'];
			$this->objsm->updateSubjects($userId,$subjects);
			$subjects = $this->objsm->getInterestList($userId);
			$allSubjects = $this->objsm->getSubjects($userId);
			echo '<script language="javascript">window.location.assign("http://localhost/Main/homeindex.php")</script>';
		}

    }
?>