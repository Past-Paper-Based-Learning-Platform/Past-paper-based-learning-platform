<?php
    session_start();
    if(!empty($_SESSION['user_id']) && $_SESSION['user_role']=='S')
    {
        require_once  'controller/homeController.php';		
        $controller = new homeController();	
        $userId =$_SESSION['user_id'];
        $page='home.php';
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $controller->mvchandler();
            
        }else{
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
    }
    }
    else
    {
        header('location:http://localhost/Main/index.php');
    }
?>