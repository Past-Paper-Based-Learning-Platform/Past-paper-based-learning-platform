<?php
include '../../controller/UserController.php';
class ForgotPassword
{
   function sendRecoveryPassword($email)
    {
       //check email is valid

       
       $userController = new UserController();
       $userController->sendRecoverPWEmail($email);
    }
}
?>