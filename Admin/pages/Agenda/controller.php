<?php
    if(isset($_SESSION['admin_status']) and $_SESSION['admin_status'] == 'connected'){
        $user = unserialize($_SESSION['user']);
        $_SESSION['page'] = 'Agenda';
        if(file_exists('view/view.css')){
            echo '<style>';
            require_once('view/view.css');
            echo '</style>';
        }
        if(file_exists('view/view.php')){
            require_once('view/view.php');   
        }
        if(file_exists('view/javascripts.php')){
            require_once('view/javascripts.php');
        }
    }else{
        header('Location: '.appConf('urladminpath').'Connexion');
        exit(1);
    }
?>