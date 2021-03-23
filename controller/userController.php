<?php
	require 'model/userModel.php';
	require_once 'config.php';

    //session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();
    
	class userController 
	{

 		function __construct() 
		{          
			$this->objconfig = new config();
			$this->objsm =  new userModel($this->objconfig);
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
				$this->sendRecoverdetail($_POST['email']);
			}
			if (isset($_POST['sendagain'])){
				$this->sendRecoverdetail($_POST['email']);
			}
			if(isset($_POST['resetPW'])){
				$this->sendRecoveryPassword($_POST['emailtext'], $_POST['newPw']);
			}
			if(isset($_POST['changepwd'])){
				$this->changePassword($_SESSION['user_name'], trim($_POST['currentpass']), trim($_POST['newpass']));
			}
			
			// if(isset($_POST['continueBtn'])){
			// 	$this->checkEmailandUsernameExist($_POST['email'], $_POST['uname']);
			// }
			
		}		

		//check email
		public function checkEmailandUsernameExist($email, $username){
			
			// $undata = $this->objsm->checkUsernameIsExist($username);
			// if(!is_null($undata)){
			// 	echo '<script> alert("Entered username already exist") </script>';
			// 	return;
			// }

			// $data = $this->objsm->checkEmailIsExist($email);
			// echo '<script> alert("maaaaaaaa'.$email.'") </script>';
			// if(!is_null($data)){
			// 	echo '<script> alert("Entered email already exist") </script>';
			// 	return;
			// }
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
			$first_name = $_POST['first_name'];
			$middle_name = $_POST['middle_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$password = $_POST['pw'];
			$user_flag = null;
			$designation = null;
			$academicYear = null;
			$indexNum = null;
			$subjects = [];

			//check email is already in db
			$data = $this->objsm->checkEmailIsExist($email);
			if(!is_null($data)){
				
			}

			//check uname is already in db
			$undata = $this->objsm->checkUsernameIsExist($username);
			if(!is_null($undata)){
				
			}

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

			$this->objsm->signupUser($username, $first_name, $middle_name, $last_name, $email,  $password, $user_flag, $subjects, $designation, $academicYear, $indexNum);
			echo '<script language="javascript">window.location.href ="http://localhost/Main/index.php?page=login.php"</script>';
		}

		//login user
		function loginMember($username, $password)
		{
			$svariable=$this->objsm->userLogin($username, $password);
			if(!is_null($svariable))
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
				echo '<script>var alert=document.getElementById("alert"); alert.style.display="block";</script>';
			}
		}

		function sendRecoverdetail($email){
			$data = $this->objsm->checkEmailIsExist($email);
			
			if(is_null($data)){
				echo '<script> alert("Entered email is invalid") </script>';
				return;
			}

			$mail = $_POST['email'];
			echo '<script language="javascript">window.location.href ="http://localhost/Main/view/user/resetPassword.php?email='.$mail.'"</script>';
		}

		function sendRecoveryPassword($email, $password){
			$this->objsm->resetPassword($email, $password);
		}

		function changePassword($username, $curpassword, $newpassword){
			if($this->objsm->checkCurrentPassword($username, $curpassword)){
				$this->objsm->updateNewPassword($username, $newpassword);
				session_destroy();
				echo '<script> alert("Password Changed Successfully! Login Using New Password."); window.location.href="http://localhost/Main/index.php";</script>';
			}
			else
			{
				echo '<script> alert("Wrong Current Password!"); window.location.href="http://localhost/Main/view/examinationdep/changepassword.php";</script>';

			}
		}
    }
		
	
