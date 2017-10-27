<?php
    if(isset($_SESSION['admin_status']) and $_SESSION['admin_status'] == 'connected'){
        $user = unserialize($_SESSION['user']);
        if($user->getRights() == 'Admin'){
            if(isset($_POST['submit']) and $_SESSION['page'] == 'Comptes_client' and $_POST['submit'] == 'Ajouter'){
                if($_POST['username'] != '' and $_POST['email'] != '' and isset($_POST['rights'])){
                    $token = addClient($_POST['username'],$_POST['email'],$_POST['rights'],$_SESSION['current_company'],$database);
                    if($token){
                        /*if(sendTokenByEmail($token,$_POST['email'],$_POST['username'],$_SESSION['current_company'])){

                        }else{

                        }*/   
                    }else{
                        array_push($_SESSION['errors'],'Ce nom d\'utilisateur existe déjà');
                        displaySessionLogs();
                    }
                }else{
                    array_push($_SESSION['errors'],'Un ou plusieurs champs n\'ont pas été remplis');
                    displaySessionLogs();
                }
            }
            $client_accounts = getClientAccounts($database,$_SESSION['current_company']);
            $_SESSION['page'] = 'Comptes_client';
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
            header('Location: '.appConf('urlrootpath').'Error=403');
            exit(1);
        }
    }else{
        header('Location: '.appConf('urladminpath').'Connexion');
        exit(1);
    }
?>