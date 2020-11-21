<?php
include '../../model/UserModel.php';
class ForgotPassword
{
   function sendRecoveryPassword($email)
    {
       //check email is valid

       
       $userModel = new UserModel();
       $userModel->sendRecoverPWEmail($email);
    }
}
?>