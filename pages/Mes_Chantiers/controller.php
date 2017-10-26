<?php
    $user = unserialize($_SESSION['user']);
    $user->setInterventions(getInterventions($user->getid(),$database));
    $interventions = $user->getInterventions();
    $newInterventions = orderInterventions($interventions);
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