<?php
include '../../controller/UserController.php';
class Login
{
   function loginMember($username, $password)
    {
       $userController = new UserController();
       $user_name = $userController->userLogin($username, $password);
       return $user_name;
    }
}
?>