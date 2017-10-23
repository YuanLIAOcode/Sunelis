<?php
    if(isset($_SESSION['status']) and $_SESSION['status'] == 'connected'){
        $user = unserialize($_SESSION['user']);
        if(!isset($_SESSION['current_company'])){
            $_SESSION['current_company'] = $user->getCompanies();
        }
        if(!isset($_GET['dir']) or !is_dir(appConf('rootpath').'globalViews/images/clients/'.$_SESSION['current_company'].'/'.$_GET['dir'])){
            $_GET['dir'] = '';
        }
        $folder_path = appConf('rootpath').'globalViews/images/clients/'.$_SESSION['current_company'].'/'.$_GET['dir'];
        if($folder_path.substr(strlen($folder_path)-1,1) != '/'){
            $folder_path .= '/';
        }
        $dir = scandir($folder_path);
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
    }
?>