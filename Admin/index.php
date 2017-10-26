<?php
    initAdminVariables($database);
    chdir(appConf('adminpath'));
    $url = substr($_GET['url'],6,strlen($_GET['url'])-6);
    if($url === false or $url == ''){
        $url = 'pages/';
    }
    if(isset($_SESSION['page'])){
        $_SESSION['previous_page'] = $_SESSION['page'];
    }else{
        $_SESSION['page'] = 'Connexion';
    }
    if(file_exists($url.'controller.php')){
        chdir(appConf('adminpath').$url);
        require_once('controller.php');
        if(!is_int(strpos($url,'Connexion')) and !isset($_GET['err_code'])){
            chdir(appConf('adminpath'));
            if(file_exists('globalViews/Header/controller.php')){
                chdir(appConf('adminpath').'globalViews/Header/');
                require_once('controller.php');
            }
            chdir(appConf('adminpath'));
            if(file_exists('globalViews/Nav/controller.php')){
                chdir(appConf('adminpath').'globalViews/Nav/');
                require_once('controller.php');
            }   
            chdir(appConf('adminpath'));
            if(file_exists('globalViews/Footer/controller.php')){
                chdir(appConf('adminpath').'globalViews/Footer/');
                require_once('controller.php');
            }
        }
    }else{
        chdir(appConf('rootpath'));
        $url = 'globalViews/Error/';
        $_GET = array('err_code'=>500);
        require_once($url.'controller.php');
    }
?>