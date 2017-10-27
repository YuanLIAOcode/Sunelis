<?php
if(isset($_SESSION['status'])){
    if(isset($_SESSION['user'])){
        $_SESSION['page'] = 'Mon_Chantier';
        $user = unserialize($_SESSION['user']);
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