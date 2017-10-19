<?php
    function includeGlobals(){
        if(file_exists('services/conf.php')){
            require_once('services/conf.php');
            $root = appConf('rootpath');
            if(is_dir($root)){
                chdir($root);
                includeFiles('services/',array('conf.php','includeGlobals.php','session.php'));
                includeFiles('models/');
                includeFiles('globalViews/');
                includeFiles('repository/');
            }else{
                array_push($_SESSION['errors'],'Le chemin spécifié dans les configurations est invalide');
            }
        }else{
            array_push($_SESSION['errors'],'Le fichier "services/conf.php" n\'existe pas');
        }
    }

    function includeFiles($dir,$except=array()){
        if(is_dir($dir)){
            chmod($dir,0777);
            $scan = scandir($dir);
            foreach($scan as $file){
                if(is_file($dir.$file)){
                    if(!in_array($file,$except)){
                        if(substr($file,-4,4) != '.css'){
                            require_once($dir.$file);
                        }else{
                            echo '<style>';
                            require_once($dir.$file);
                            echo '</style>';
                        }
                    }
                }
            }
        }else{
            array_push($_SESSION['errors'],'Le dossier "'.$dir.'" n\'existe pas');
        }
    }
?>