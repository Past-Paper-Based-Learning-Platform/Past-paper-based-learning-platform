<?php
	require 'model/examModel.php';
	require 'libs/php/class.uploader.php';
	require_once 'config.php';

	define('BASE_URL','http://localhost/Main/');
	
    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    
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
				case "Four Year":
					$studyyear='4';
					break;
			}
			$result=$this->objsm->get_papers($year, $semester, $course, $studyyear);
			
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
				}else{
					$course="IS";
				}
				$ressub=$this->objsm->get_subjects($_POST['year'], $course);				
				include 'view/examinationdep/upload.php';
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
		
        // page redirection
		public function pageRedirect($url)
		{
			header('Location:'.$url);
		}		
    }
?>