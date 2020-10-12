<?php
include '../../controller/UserController.php';
class SignUp
{

   function signUpMember()
   {
       $username =  $_POST['uname'];
       $email = $_POST['email'];
       $password = $_POST['pw'];
       $subject = $_POST['subject'];
       $designation = null;
       $academicYear = null;
        $indexNum = null;

       if(strpos($email, 'lec') !== false){
         //lecturer
         $designation = $_POST['designation'];
       } else{
        //student
        $academicYear = $_POST['year'];
        $indexNum = $_POST['indexNum'];
       }

       $userController = new UserController();
       $userController->signupUser($username, $email,  $password, $subject, $designation, $academicYear, $indexNum);

    }

    function getSubjects(){
      $config = new Configuration();
      $con = $config->createConnection();

      $subjects = $config->getSubjects();
      return $subjects;
    }
}
?>