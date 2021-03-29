<?php
    session_start();
    if(isset($_SESSION) && empty($_SESSION['user_role']))
    {
        require_once  'controller/userController.php';		
        $controller = new userController();	
        $page = 'login.php';
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }
        $controller->viewloginsignup($page);
        $controller->mvchandler();
    }
    else
    {
        if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'S')
        {
                echo '<script language="javascript">window.location.assign("http://localhost/Main/homeindex.php")</script>';
        }
        elseif($_SESSION['user_role'] == 'L' || $_SESSION['user_role'] == 'I')
        {
            echo '<script language="javascript">window.location.href ="http://localhost/Main/lecturerindex.php"</script>';
        }
        elseif($_SESSION['user_role'] == 'E')
        {
            echo '<script language="javascript">window.location.href ="http://localhost/Main/examindex.php"</script>';
        }
    }
    
?>