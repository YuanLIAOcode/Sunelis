<?php
    if(isset($_POST['submit']) and $_SESSION['page'] == 'Connexion'){
        if($_POST['username'] != '' and $_POST['password'] != ''){
            if($user = verifyLogin($_POST['username'],$_POST['password'],$database)){
                $_SESSION['status'] = 'connected';
                $_SESSION['user'] = serialize($user);
                header('Location: '.appConf('urladminpath').'Mes_documents');
                exit(1);
            }else{
                array_push($_SESSION['errors'],'Nom d\'utilisateur ou mot de passe incorrect');
                displaySessionLogs();
            }
        }else{
            array_push($_SESSION['errors'],'Au moins un des champs n\'a pas été remplis');
            displaySessionLogs();
        }
    }
    $_SESSION['page'] = 'Connexion';
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
?>