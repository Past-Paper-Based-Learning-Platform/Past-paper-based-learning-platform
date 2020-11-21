<?php
include_once '../../model/UserModel.php';
class Login
{
   function loginMember($username, $password)
   {
       $userModel = new UserModel();
       $user_name = $userModel->userLogin($username, $password);
       return $user_name;      
   }
}
?>