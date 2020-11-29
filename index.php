<?php
    //session_unset();
	require_once  'controller/userloginController.php';		
    $controller = new userloginController();	
    $page = 'login.php';
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    $controller->viewloginsignup($page);
    $controller->mvchandler();
    
?>