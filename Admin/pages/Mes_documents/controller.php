<?php
    if(isset($_SESSION['status']) and $_SESSION['status'] == 'connected'){
        $user = unserialize($_SESSION['user']);
        $folder_root_path = appConf('rootpath').'globalViews/images/clients/'.$_SESSION['current_company'].'/';
        if(!isset($_GET['dir'])){
            $_SESSION['current_dir'] = '';
        }else{
            if(substr($_GET['dir'],strlen($_GET['dir'])-1,1) != '/' and $_GET['dir'] != ''){
                $_GET['dir'] .= '/';
            }
            if(!is_dir($folder_root_path.$_GET['dir'])){
                $_GET['dir'] = '';
            }
            $_SESSION['current_dir'] = $_GET['dir'];
        }
        $dir = scandir($folder_root_path.$_SESSION['current_dir']);
        $_SESSION['page'] = 'Mes_documents';
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
        header('Location: '.appConf('urlrootpath').'Error?err_code=404');
        exit(1);
    }
?>