<?php
	require 'model/userloginModel.php';
	require_once 'config.php';

    //session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    
	class userloginController 
	{

 		function __construct() 
		{          
			$this->objconfig = new config();
			$this->objsm =  new userloginModel($this->objconfig);
		}
        // mvc handler request
		public function mvchandler() 
		{
			
			if (isset($_POST['loginBtn'])){
				$svariable=$this->loginMember($_POST["email_un"], $_POST["password"]);
				//print_r ($svariable);
				return $svariable;
			}
			if (isset($_POST['signUpBtnStu'])){
                $this->signUpMember();
			}
			if (isset($_POST['signUpBtnLec'])){
                $this->signUpMember();
			}
			if (isset($_POST['sendRecoverPW'])){
                $this->sendRecoverdetail();
			}
			if (isset($_POST['sendagain'])){
                $this->sendRecoverdetail();
			}
		}		
		
		//page view
		public function viewloginsignup($page)
		{
			$subjects = $this->objsm->getSubjects();
				include 'view/user/'.$page.'';
		}

		//signup user
		function signUpMember()
		{
			$username =  $_POST['uname'];
			$email = $_POST['email'];
			$password = $_POST['pw'];
			$user_flag = null;
			$designation = null;
			$academicYear = null;
			$indexNum = null;
			$subjects = [];

			if(strpos($email, 'lec') !== false)
			{
				//lecturer
				$user_flag = "L";
				$designation = $_POST['designation'];
				if($designation == 'instructor'){
					$user_flag = 'I';
				}
				$subjects = $_POST['lecSubjcts'];
			} 
			else
			{
				//student
				$user_flag = "S";
				$academicYear = $_POST['year'];
				$indexNum = $_POST['indexNum'];
				$subjects = $_POST['stuSubjcts'];
			}

			$this->objsm->signupUser($username, $email,  $password, $user_flag, $subjects, $designation, $academicYear, $indexNum);

		}

		//login user
		function loginMember($username, $password)
		{
			$svariable=$this->objsm->userLogin($username, $password);
			if($svariable)
			{ 
					$_SESSION['user_name'] = $svariable['user_name'];
					$_SESSION['user_id'] = $svariable['user_id'];
					$_SESSION['user_role'] = $svariable['user_role'];

				if($svariable['user_role'] == 'S')
				{
						echo '<script language="javascript">window.location.assign("http://localhost/Main/homeindex.php")</script>';
				}
				elseif($svariable['user_role'] == 'L' || $svariable['user_role'] == 'I')
				{
					echo '<script language="javascript">window.location.href ="http://localhost/Main/lecturerindex.php"</script>';
				}
				elseif($svariable['user_role'] == 'E')
				{
					echo '<script language="javascript">window.location.href ="http://localhost/Main/view/examinationdep/examhome.php"</script>';
				}
				elseif($svariable['user_role'] == 'A')
				{
					echo '<script language="javascript">window.location.href ="http://localhost/Main/view/admin/adminhome.php"</script>';
				}
			}
			else
			{
				$loginerr = "Invalid user name or password";
			}
		}

		function sendRecoverdetail(){
			$email = $_POST['email'];
			$this->objsm->sendRecoverPWEmail($email);
		}
    }
		
	
