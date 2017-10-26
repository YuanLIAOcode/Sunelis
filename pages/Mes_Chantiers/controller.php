<?php
$user = unserialize($_SESSION['user']);
$user->setInterventions(getInterventions($user->getid(),$database));
$interventions = $user->getInterventions();
$newInterventions = orderInterventions($interventions);

foreach ($newInterventions as $chantier){
    if(isset($_POST['intervention'])){
        $_SESSION['chantier']=serialize($chantier);
        header('Location: '.appConf('urlrootpath').'Mes_Chantiers_');
        exit(1);
    }
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
?>