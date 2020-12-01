<?php
    session_start();
    if(!empty($_SESSION['user_id']))
    {
        require_once  'controller/discussionController.php';		
        $controller = new discussionController();	
        $userId =$_SESSION['user_id'];
        $page='pastpaper.php';
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }

        if (isset($_GET['paper_id']))
        {
            $paper_id = $_GET['paper_id'];
            $controller->routpage($paper_id,$page);
        }
        else
        {
            $controller->routpage($userId,$page);
        }
        $controller->mvchandler($page);
    }
    else
    {
        header('location:http://localhost/Main/index.php');
    }
?>