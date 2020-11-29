<?php
    session_start();
	require_once  'controller/homeController.php';		
    $controller = new homeController();	
    $userId =$_SESSION['user_id'];
    $page='home.php';
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }

    if (isset($_GET['paper_id']))
    {
        $paper_id = $_GET['paper_id'];
        $controller->viewHome($paper_id,$page);
    }
    else
    {
        $controller->viewHome($userId,$page);
    }
    $controller->mvchandler();
?>