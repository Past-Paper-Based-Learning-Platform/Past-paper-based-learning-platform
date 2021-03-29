<?php
    session_start();
    if(!empty($_SESSION['user_id']) && $_SESSION['user_role']=='L')
    {
        require 'controller/lecturerController.php';
        $controller = new lecturerController();
        $userId =$_SESSION['user_id'];
        $page='lecturerHome.php';
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
        $controller->mvcHandler();
    }
    }
    else
    {
        header('location:http://localhost/Main/index.php');
    }
?>