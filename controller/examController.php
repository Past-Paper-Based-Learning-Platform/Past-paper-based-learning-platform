<?php
	require 'model/examModel.php';
	require 'libs/php/class.uploader.php';
	require_once 'config.php';

//	define('BASE_URL','http://localhost/Main/');
	
    //session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    
	class examController 
	{

 		function __construct() 
		{          
			$this->objconfig = new config();
			$this->objsm =  new examModel($this->objconfig);
		}
		public function mvcHandler() 
		{
			if (isset($_POST['enterbtn'])){
				$this->show_papers();
			}
			if (isset($_POST['deletebtn'])){
				$this ->delete_paper();
			}
			if (isset($_POST['upload'])){
				$this ->upload_papers();
			}
			if (isset($_POST['submitDetails'])){
				$this ->paper_details();
			}
			if (isset($_POST['showsubjects'])){
				$this->show_subjects();
			}
			if (isset($_POST['deactivesubjectbtn'])){
				$this->deactivate_subject();
			}
			if (isset($_POST['addsubjectbtn'])){
				$this->add_subject();
			}
			if (isset($_GET['action']) && $_GET['action']=="logout"){
				$this->logout();
			}
		}	

		public function show_papers()
		{	
			$year=trim($_POST['year']);
			$semester=$course=$studyyear='';
			switch (trim($_POST['semester']))
			{
				case "Semester-I":
					$semester='1';
					break;
				case "Semester-II":
					$semester='2';
					break;
			}
			switch (trim($_POST['course']))
			{
				case "Computer Science":
					$course="CS";
					break;
				case "Information Systems":
					$course="IS";
					break;
			}
			switch (trim($_POST['studyyear']))
			{
				case "First Year":
					$studyyear='1';
					break;
				case "Second Year":
					$studyyear='2';
					break;
				case "Third Year":
					$studyyear='3';
					break;
				case "Fourth Year":
					$studyyear='4';
					break;
			}
			$result1=$this->objsm->get_papers($year, $semester, $course, $studyyear);
			
			include 'view/examinationdep/examhome.php';
		}		
		public function delete_paper()
		{
			$row = mysqli_fetch_array($this->objsm->get_paperpath($_POST['deletebtn']));
			unlink('pastpapers/'.$row['past_paper']);
			if ($this->objsm->del_paper($_POST['deletebtn'])){
				$this->show_papers();
				echo '<script>alert("Successfully Deleted Paper!")</script>';
			}
		}
		public function upload_papers(){
			$uploader = new Uploader();
			$data = $uploader->upload($_FILES['files'], array(
				'limit' => 10, //Maximum Limit of files. {null, Number}
				'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
				'extensions' => array('pdf'), //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
				'required' => false, //Minimum one file is required for upload {Boolean}
				'uploadDir' => 'pastpapers/', //Upload directory {String}
				'title' => array('name'), //New file name {null, String, Array} *please read documentation in README.md
				'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
				'replace' => false, //Replace the file if it already exists  {Boolean}
				'perms' => null, //Uploaded file permisions {null, Number}
				'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
				'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
				'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
				'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
				'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
				'onRemove' => null //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
			));

			if($data['isComplete']){
				$files=$data['data']['files'];
				$fileCount=count($files);
				
				if(trim($_POST['course']=='Computer Science')){
					$course="CS";
				}else if(trim($_POST['course']=='Information Systems')){
					$course="IS";
				}else{
					$couse="";
				}

				if($fileCount==0){
					echo "<script>alert('Please select atleast one file to upload!'); window.location.href='view/examinationdep/examhome.php';</script>";
				}else if (is_numeric(trim($_POST['year'])) && is_int(0+trim($_POST['year']))){
					$ressub=$this->objsm->get_subjects($_POST['year'], $course);
					if ($ressub->num_rows == 0){
						echo "<script>alert('No subjects available for entered year and course!'); window.location.href='view/examinationdep/examhome.php';</script>";
					}
					include 'view/examinationdep/upload.php';
				}else{
					echo "<script>alert('Invalid year or course!'); window.location.href='view/examinationdep/examhome.php';</script>";
				}
			}
			if($data['hasErrors']){
				$errors = $data['errors'];
				print_r($errors);
			}					
		}

		public function paper_details(){
			$unsuccess=0;
			for ($i = 0; $i < $_GET['count']; $i++){
				if(!$this->objsm->paper_upload($_POST['subject'][$i], $_SESSION['year'], $_POST['part'][$i], basename($_SESSION['files'][$i]), date('Y-m-d'))){
					unlink('pastpapers/'.basename($_SESSION['files'][$i]));
					$unsuccess++;
				}
			}
			
			if($unsuccess){
				echo "<script>alert('".$unsuccess." paper(s) failed to upload. (Reason: Existing papers cannot be replaced!)'); window.location.href='view/examinationdep/examhome.php';</script>";
			}else{
				echo "<script>alert('Successfully Uploaded Papers!'); window.location.href='view/examinationdep/examhome.php'; </script>";
			}			
		}

		public function show_subjects(){
			$year=trim($_POST['subjectyear']);
			$semester=$course=$studyyear='';
			switch (trim($_POST['subjectsemester']))
			{
				case "Semester-I":
					$semester='1';
					break;
				case "Semester-II":
					$semester='2';
					break;
				case "Semester I & II":
					$semester='0';
					break;
			}
			switch (trim($_POST['subjectcourse']))
			{
				case "Computer Science":
					$course="CS";
					break;
				case "Information Systems":
					$course="IS";
					break;
			}
			switch (trim($_POST['subjectstudyyear']))
			{
				case "First Year":
					$studyyear='1';
					break;
				case "Second Year":
					$studyyear='2';
					break;
				case "Third Year":
					$studyyear='3';
					break;
				case "Fourth Year":
					$studyyear='4';
					break;
			}
			$result2=$this->objsm->semester_subjects($year, $semester, $course, $studyyear);
			$subjects = $this->objsm->all_subjects();
			
			include 'view/examinationdep/examhome.php';
		}

		function deactivate_subject(){
			if ($this->objsm->inactive_subject($_POST['deactivesubjectbtn'])){
				$this->show_subjects();
				echo '<script>alert("Successfully Deactivate Subject!")</script>';
			}else{
				$this->show_subjects();
				echo '<script>alert("Error Occured, Subject Deactivation Unsuccessful!")</script>';
			}
		}

		function add_subject(){
			$semester=$course=$studyyear=$subjectcode=$subjectname=$linkedsubject=$addedyear='';
			switch (trim($_POST['subjectsemester']))
			{
				case "Semester-I":
					$semester='1';
					break;
				case "Semester-II":
					$semester='2';
					break;
				case "Semester I & II":
					$semester='0';
					break;
			}
			switch (trim($_POST['subjectcourse']))
			{
				case "Computer Science":
					$course="CS";
					break;
				case "Information Systems":
					$course="IS";
					break;
			}
			switch (trim($_POST['subjectstudyyear']))
			{
				case "First Year":
					$studyyear='1';
					break;
				case "Second Year":
					$studyyear='2';
					break;
				case "Third Year":
					$studyyear='3';
					break;
				case "Fourth Year":
					$studyyear='4';
					break;
			}
			$subjectcode = trim($_POST['subjectcode']);
			$subjectname = trim($_POST['subjectname']);
			$cut = explode(' ', trim($_POST['subjectlink']));
			$linkedsubject = $cut[0];
			$addedyear = trim($_POST['subjectstartyear']);

			if($this->objsm->newsubject_details($semester, $course, $studyyear, $subjectcode, $subjectname, $linkedsubject, $addedyear)){
				$this->show_subjects();
				echo '<script>alert("Successfully Added a New Subject!")</script>';
			}else{
				$this->show_subjects();
				echo '<script>alert("Update was Unsuccessful!")</script>';
			}
		}
		public function logout(){
			session_destroy();
			echo '<script language="javascript">window.location.href ="http://localhost/Main/index.php"</script>';
		}

        // page redirection
		public function pageRedirect($url)
		{
			header('Location:'.$url);
		}		
    }
?>