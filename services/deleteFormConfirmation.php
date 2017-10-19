<?php
    function deleteFormConfirmation(){
        if(!empty($_POST) or !empty($_FILES)){
            $_SESSION['sauvegarde'] = $_POST ;
            if(!empty($_FILES)){
                saveFiles();
            }
            $_SESSION['sauvegarde_files'] = $_FILES;
            $fichierActuel = $_SERVER['REQUEST_URI'] ;
            header('Location: ' . $fichierActuel);
            exit(1);
        }else{
            if(isset($_SESSION['sauvegarde'])){
                $_POST = $_SESSION['sauvegarde'] ;
                $_FILES = $_SESSION['sauvegarde_files'];
                unset($_SESSION['sauvegarde']);
                unset($_SESSION['sauvegarde_files']);
            }
        }
    }

    function saveFiles(){
        $img = $_FILES['photo'];
        if($img['error'] == 0){
            $filename = getFilename($img['tmp_name']);
            copy($img['tmp_name'],appConf('rootpath').'temp/'.$img['name']);
            $_FILES['photo']['tmp_name'] = appConf('rootpath').'temp/'.$img['name'];
        }
    }
?>