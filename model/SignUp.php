<?php
include '../../controller/UserController.php';
class SignUp
{

   function signUpMember()
   {
       $username =  $_POST['uname'];
       $email = $_POST['email'];
       $password = $_POST['pw'];
       $designation = null;
       $academicYear = null;
        $indexNum = null;
        $subjects = [];

       if(strpos($email, 'lec') !== false){
         //lecturer
         $designation = $_POST['designation'];
         $subjects = $_POST['lecSubjcts'];
       } else{
        //student
        $academicYear = $_POST['year'];
        $indexNum = $_POST['indexNum'];
        $subjects = $_POST['stuSubjcts'];
       }

      $userController = new UserController();
      $userController->signupUser($username, $email,  $password, implode(",",$subjects), $designation, $academicYear, $indexNum);

    }

    function getSubjects(){
      $config = new Configuration();
      $con = $config->createConnection();

      $subjects = $config->getSubjects();
      return $subjects;
    }
}
?>