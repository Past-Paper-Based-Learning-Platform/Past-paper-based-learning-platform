<?php
    session_start();
    require 'controller/lecturerController.php';
    $controller = new lecturerController();
    $userId =$_SESSION['user_id'];
    $page='lecturerHome.php';
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
?>