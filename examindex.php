<?php
	session_start();
    if(!empty($_SESSION['user_id'])){
        require_once  'controller/examController.php';
        $controller = new examController();	
        $page='examhome.php';
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $controller->mvcHandler();
        }else{
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }
            $controller->viewHome($page);
       //     $controller->mvcHandler();
        }
    }
    else
    {
        header('location:http://localhost/Main/index.php');
    }
    

?>