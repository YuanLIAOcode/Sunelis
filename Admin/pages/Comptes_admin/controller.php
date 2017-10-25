<?php
    if(isset($_SESSION['status']) and $_SESSION['status'] == 'connected'){
        $user = unserialize($_SESSION['user']);
        if($user->getRights() == 'Admin'){
            if(isset($_POST['submit']) and $_SESSION['page'] == 'Comptes_admin' and $_POST['submit'] == 'Ajouter'){
                if($_POST['username'] != '' and $_POST['email'] != '' and isset($_POST['rihghts'])){
                    //add admin
                }else{
                    array_push($_SESSION['errors'],'Un ou plusieurs champs n\'ont pas été remplis');
                    displaySessionLogs();
                }
            }
            $admin_accounts = getAdminAccounts($database,$_SESSION['current_company']);
            $_SESSION['page'] = 'Comptes_admin';
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
        }
    }
?>