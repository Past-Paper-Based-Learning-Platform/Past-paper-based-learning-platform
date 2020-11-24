<?php
include_once('../../model/Configuration.php');
class UserModel{
   
    function userLogin($username, $password){
       $config = new Configuration();
       $con = $config->createConnection();
       
       $encryptPW = $config->hashPassword($password);

       $query = 'SELECT * FROM registred_user where email = "'.$username.'" or user_name = "'.$username.'" and password ="'.$encryptPW.'"';
       $result = $con->query($query);
       if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            return $row["user_name"]."-".$row["user_id"];
          }
          return null;
       }else{
           //print("invalid user name or password");
           return null;
       }
      $config->closeConnection();
    }

    function signupUser($username, $email,  $password, $subjects, $designation, $academicYear, $indexNum){
      
        $config = new Configuration();
        $con = $config->createConnection();

        $encryptPw = $config->hashPassword($password);

        $sql = "INSERT INTO registred_user (email, user_name, password, user_flag) 
        VALUES ('".$email."', '".$username."', '".$encryptPw."', 'A')";
        
        $results = $con->query($sql);

        if ($results === TRUE) {
           //echo "New record created successfully";
        }else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }

        //get userId
        $userId = '';
        $selectQuery = 'SELECT * FROM registred_user where email = "'.$email.'"';
        $sekectresult = $con->query($selectQuery);
        if ($sekectresult->num_rows > 0) {
            while($row = $sekectresult->fetch_assoc()) {
                $userId = $row["user_id"];
            }
        }

        if(strpos($email, 'lec') !== false){
            
            //insert lecturer data
            $sql = "INSERT INTO lecturer (designation, user_id, Subjects ) 
            VALUES ('".$designation."', '".$userId."', '".$subjects."')";

            $results = $con->query($sql);

            if ($results === TRUE) {
            //echo "New record created successfully: lecturer";
            }else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        }else{
            //insert studnt data
            $sql = "INSERT INTO student (user_id, index_number, year, Subjects) 
            VALUES ('".$userId."', '".$indexNum."', '".$academicYear."', '".$subjects."')";

            $results = $con->query($sql);

            if ($results === TRUE) {
            //echo "New record created successfully: student";
            }else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        }

        $config->closeConnection();
    }

    function sendRecoverPWEmail($email){
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

    function getInterestList($user){
        $config = new Configuration();
        $con = $config->createConnection();
        $subjects = null;
        $selectQuery = 'SELECT * FROM student where user_id = "'.$user.'"';
        $sekectresult = $con->query($selectQuery);
        if ($sekectresult->num_rows > 0) {
            while($row = $sekectresult->fetch_assoc()) {
                $subjects = $row["Subjects"];               
            }
        }

        return $subjects;
    }

    function getInterestListDesc($iterestList){
        $config = new Configuration();
        $con = $config->createConnection();
        $interstListDesc = null;
        $arrList = [];
        $selectQuery = 'SELECT subject_name FROM subject where subject_code in(\''.implode("','",$iterestList).'\')';
        
        $selectresult = $con->query($selectQuery);
        if ($selectresult->num_rows > 0) {
            while($row = $selectresult->fetch_assoc()) {
                $interstListDesc = $row["subject_name"];             
                array_push($arrList, $interstListDesc);
            }
        }

        return $arrList;
    }

    function get_pastpapers(){
        $config = new Configuration();
        $con = $config->createConnection();

        try
			{
				$query="SELECT past_paper.paper_id, past_paper.subject_code, past_paper.year, subject.semester, subject.subject_name, past_paper.part FROM past_paper INNER JOIN subject ON past_paper.subject_code=subject.subject_code";
				$result = mysqli_query($con,$query);
				return $result;
				$config->closeConnection();
			}
			catch (Exception $e)
			{
				$config->closeConnection();
				throw $e;
			}
    }
}
?>