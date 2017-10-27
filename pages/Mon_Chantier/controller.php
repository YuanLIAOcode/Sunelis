<?php
if(isset($_SESSION['status'])and $_SESSION['status'] == 'connected'){
    if(isset($_SESSION['user'])){
        $_SESSION['page'] = 'Mon_Chantier';
        $user = unserialize($_SESSION['user']);
        $user->setInterventions(getInterventions($user->getid(),$database));
        $interventions = $user->getInterventions();

        if (isset($_GET['id'])){
            foreach ($interventions as $chantier){
                if ($chantier->getId() == $_GET['id']){
                    if($chantier->getClient_Id()== $user->getId()){
                        $_SESSION['chantier']=serialize($chantier);
                    }
                    else{
                        $url = 'globalViews/Error/';
                        $_GET = array('err_code'=>500);
                        require_once($url.'controller.php');
                    }

                }
            }
        }
        $intervention = unserialize($_SESSION['chantier']);
        $files = $intervention->getFiles();
        $filePaths = getFilePaths($files);
        foreach ($filePaths as $filePath){
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
            
        }
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