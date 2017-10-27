<?php 
    if(isset($_SESSION['admin_status']) and $_SESSION['admin_status'] == 'connected'){
        if($user->getRights() == 'admin'){
            $companies_access = array('SUNELIS','ISOLAVIE','NORD SOLUTIONS TOITURE');   
        }else{
            $companies_access = explode(';',$user->getCompanies());
        }
        $unselected_companies = getUnselectedCompanies($_SESSION['current_company']);
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