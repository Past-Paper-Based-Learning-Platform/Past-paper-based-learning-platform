<?php
	session_unset();
    require_once  'controller/examController.php';
    $controller = new examController();	
    $controller->mvcHandler();
?>