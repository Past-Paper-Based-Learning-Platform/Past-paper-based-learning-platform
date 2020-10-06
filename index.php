<?php
	session_unset();
	require_once  'controller/homeController.php';		
    $controller = new homeController();	
    $controller->();
?>