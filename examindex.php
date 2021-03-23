<?php
	if(!isset($_SESSION)) session_start();
    if($_GET['tag']=="user"){
        require_once 'controller/userController.php';
        $controller = new userController();
        $controller->mvchandler();
    }
    else
    {
        require_once  'controller/examController.php';
        $controller = new examController();	
        $controller->mvcHandler();
    }
    

?>