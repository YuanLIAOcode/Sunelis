<?php
    if(isset($_SESSION['status']) and $_SESSION['status'] == 'connected'){
        $_SESSION['page'] = 'Accueil';
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