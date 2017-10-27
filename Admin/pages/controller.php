<?php
    if(isset($_SESSION['admin_status']) and $_SESSION['admin_status'] == 'connected'){
        if(file_exists('Mes_documents/controller.php')){
            header('Location: '.appConf('urladminpath').'Mes_documents');
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