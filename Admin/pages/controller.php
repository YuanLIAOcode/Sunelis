<?php
    if(isset($_SESSION['status']) and $_SESSION['status'] == 'connected'){
        if(file_exists('Accueil/controller.php')){
            header('Location: '.appConf('urladminpath').'Accueil');
            exit(1);
        }else{
            chdir(appConf('rootpath'));
            $url = 'globalViews/Error/';
            $_GET = array('err_code'=>500);
            require_once($url.'controller.php');
        }
    }else{
        if(file_exists('Connexion/controller.php')){
            header('Location: '.appConf('urladminpath').'Connexion');
            exit(1);
        }else{
            chdir(appConf('rootpath'));
            $url = 'globalViews/Error/';
            $_GET = array('err_code'=>500);
            require_once($url.'controller.php');
        }
    }
?>