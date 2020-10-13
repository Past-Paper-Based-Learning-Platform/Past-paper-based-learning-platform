<?php
include_once('../../controller/Configuration.php');
class UserController{
   
    function userLogin($username, $password){
       $config = new Configuration();
       $con = $config->createConnection();
       
       $encryptPW = $config->hashPassword($password);

       $query = 'SELECT * FROM registred_user where email = "'.$username.'" or user_name = "'.$username.'" and password ="'.$encryptPW.'"';
       $result = $con->query($query);
       if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            return $row["user_name"];
          }
          return null;
       }else{
           //print("invalid user name or password");
           return null;
       }
      $config->closeConnection();
    }

    function signupUser($username, $email,  $password, $subject, $designation, $academicYear, $indexNum){
       
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
            $sql = "INSERT INTO lecturer (designation, user_id) 
            VALUES ('".$designation."', '".$userId."')";

            $results = $con->query($sql);

            if ($results === TRUE) {
            //echo "New record created successfully: lecturer";
            }else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        }else{
            //insert studnt data
            $sql = "INSERT INTO stduent (user_id, index_number, year, course) 
            VALUES ('".$userId."', '".$indexNum."', '".$academicYear."', '".$subject."')";

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
}
?>