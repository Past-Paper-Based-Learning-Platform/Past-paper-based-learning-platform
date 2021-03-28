<?php
    class userModel{
		// set database config for mysql
		function __construct($consetup)
		{
			$this->host = $consetup->host;
			$this->user = $consetup->user;
			$this->pass =  $consetup->pass;
			$this->db = $consetup->db;            					
		}
		// open mysql data base
		public function open_db()
		{
			$this->condb=new mysqli($this->host,$this->user,$this->pass,$this->db);
			if ($this->condb->connect_error) 
			{
				die("Erron in connection: " . $this->condb->connect_error);
			}
		}
		// close database
		public function close_db()
		{
			$this->condb->close();
		}

		//get all subjects
		function getSubjects(){
			try
			{
				$this->open_db();
				$subjects=array();
				$query = "SELECT * FROM subject";
				$results = mysqli_query($this->condb,$query);
				while ($row_ah = mysqli_fetch_assoc($results)) {
					array_push($subjects, $row_ah);
				}
				$this->close_db();
				return $subjects;
			}
			catch (Exception $e)
			{
				$this->close_db();
				throw $e;
			}

		}

		//hash password
		function hashPassword($password){ 
        	$hashedPW = sha1($password); 
			return $hashedPW;
		}

		//sign up user
		function signupUser($username, $first_name, $middle_name, $last_name, $email,  $password, $user_flag, $subjects, $designation, $academicYear, $indexNum)
		{
			try
			{
				$this->open_db();
				$encryptPw = $this->hashPassword($password);
				//print_r($subjects);
				$sql = "INSERT INTO registered_user (email, user_name, password, first_name, middle_name, last_name, user_flag, activeStatus) 
				VALUES ('".$email."', '".$username."', '".$encryptPw."', '".$first_name."', '".$middle_name."', '".$last_name."', '".$user_flag."', '1')";
			
				$results = mysqli_query($this->condb,$sql);
	
				if (!$results) {
					echo "<script language='javascript'> alert('Sign Up unsuccessful! You have already signed up using this email!');</script>";
					//$qerror = mysqli_error($this->condb);
					//echo "Error: " . $sql . "<br>" . $qerror ;
				}
	
				//get userId
				$userId = '';
				$selectQuery = 'SELECT * FROM registered_user where email = "'.$email.'"';
				$sekectresult = mysqli_query($this->condb,$selectQuery);
				if ($sekectresult->num_rows > 0) {
					while($row = $sekectresult->fetch_assoc()) {
						$userId = $row["user_id"];
					}
				}

				//add subjects to the data base
				if(!empty($subjects)){
					foreach($subjects as $subject){
						$query="INSERT INTO interest_list (user_id,subject_code) VALUES ('".$userId."','".$subject."')";
						$result = mysqli_query($this->condb,$query);
					}
				}
	
				if(strpos($email, 'lec') !== false){
					
					//insert lecturer data
					$sql = "INSERT INTO lecturer (designation, user_id) 
					VALUES ('".$designation."', '".$userId."')";
		
					$results = mysqli_query($this->condb,$sql);
		
					if (!$results) {
						$qerror = mysqli_error($this->condb);
						echo "Error: " . $sql . "<br>" . $qerror ;
					}
				}
				else
				{
					//insert studnt data
					$sql = "INSERT INTO student (user_id, index_number, year) 
					VALUES ('".$userId."', '".$indexNum."', '".$academicYear."')";
		
					$results = mysqli_query($this->condb,$sql);
		
					if (!$results) {
						$qerror = mysqli_error($this->condb);
						echo "Error: " . $sql . "<br>" . $qerror ;
					}
				}
				$this->close_db();
			}
			catch (Exception $e)
			{
				$this->close_db();
				throw $e;
			}
			
		}

		//login user
		function userLogin($username, $password)
		{
			try
			{
				$this->open_db();
				$encryptPW = $this->hashPassword($password);
		
				$query = 'SELECT * FROM registered_user where password= "'.$encryptPW.'" and (email = "'.$username.'" or user_name ="'.$username.'")';
				
				$result = mysqli_query($this->condb,$query);
				
				if ($result->num_rows > 0) 
				{
					while($row = $result->fetch_assoc())
					{
						if($row['activeStatus'] == '1')
						{
							$svariable['user_name'] = $row["user_name"];
							$svariable['user_id'] = $row["user_id"];
							$svariable['user_role'] = $row["user_flag"];
							$svariable['user_image'] = $row["image"];
							return $svariable;

						}
						else
						{
							return null;
						}
					}
				}
				else
				{
					return null;
				}
				$this->close_db();
			}
			catch (Exception $e)
			{
				$this->close_db();
				throw $e;
			}
		}

		function sendRecoverPWEmail($email)
		{
			echo "controller: ".$email;
			// $to = "sandu.scooby@gmail.com";
			// $subject = "This is subject";
			
			// $message = "<b>This is HTML message.</b>";
			// $message .= "<h1>This is headline.</h1>";
			
			// $header = "From:uyanhewajanadhi@gmail.com \r\n";
			// $header .= "MIME-Version: 1.0\r\n";
			// $header .= "Content-type: text/html\r\n";
			
			// $retval = mail ($to,$subject,$message,$header);
	
			// $retval = mail('sandu.scooby@gmail.com', 'My Subject', 'test');
			
			// if( $retval == true ) {
			//    echo "Message sent successfully...";
			// }else {
			//    echo "Message could not be sent...";
			// }
		}

		function resetPassword($email, $password){
			try{
				$this->open_db();
				$encryptPW = $this->hashPassword($password);
			
				//get user id by email
				$user = "";
				$selectQuery = 'SELECT * FROM registered_user where email = "'.$email.'"';
				$sekectresult = mysqli_query($this->condb,$selectQuery);
				if ($sekectresult->num_rows > 0) {
					while($row = $sekectresult->fetch_assoc()) {
						$user = $row["user_id"];
					}
				}
				
				$sql = "UPDATE registered_user SET password='".$encryptPW."' WHERE user_id=".$user;
				mysqli_query($this->condb,$sql);
				$this->close_db(); 

				return true;
			}catch (Exception $e)
			{
				$this->close_db();
				return false;
			}    
		}

		function checkEmailIsExist($email){
			$this->open_db();
		
			//get user id by email
			$user = null;
			$selectQuery = 'SELECT * FROM registered_user where email = "'.$email.'"';
			$sekectresult = mysqli_query($this->condb,$selectQuery);
			if ($sekectresult->num_rows > 0) {
				while($row = $sekectresult->fetch_assoc()) {
					$user = $row["user_id"];
				}
			}

			return $user;
			
			$this->close_db();  
		}

		function checkUsernameIsExist($uname){
			$this->open_db();
		
			//get user id by user
			$user = null;
			$selectQuery = 'SELECT * FROM registered_user where user_name = "'.$uname.'"';
			$sekectresult = mysqli_query($this->condb,$selectQuery);
			if ($sekectresult->num_rows > 0) {
				while($row = $sekectresult->fetch_assoc()) {
					$user = $row["user_id"];
				}
			}

			return $user;
			
			$this->close_db();
		}

		

		function validateEmailExist($email){
			try{
				$this->open_db();
			
				//get user id by user
				$user = null;
				$selectQuery = 'SELECT * FROM registered_user where email = "'.$email.'"';
				$sekectresult = mysqli_query($this->condb,$selectQuery);
				if ($sekectresult->num_rows > 0) {
					while($row = $sekectresult->fetch_assoc()) {
						$user = $row["user_id"];
					}
				}

				return $user;
				
				$this->close_db();
			}
			catch (Exception $e)
			{
				$this->close_db();
				throw $e;
			}
		}
}
