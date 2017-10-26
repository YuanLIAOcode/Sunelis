<?php
function initClientVariables(){
    if(isset($_SESSION['user'])){
        $user = unserialize($_SESSION['user']);
        $companies = getSeveralAppConf('comp');
        if(isset($_GET['company']) and in_array($_GET['company'],$companies)){
            if($user->getRights() != 'admin'){
                $_SESSION['current_company'] = $_GET['company'];
            }
        }
        if(!isset($_SESSION['current_company'])){
            $_SESSION['current_company'] = $user->getCompanies();
        }
        $comp_infos = retrieveCompanyInfos($_SESSION['current_company']);
        define('color',$comp_infos['color']);
        define('logo',$comp_infos['logo']);
        define('power_button',$comp_infos['power_button']);
        define('power_r_button',$comp_infos['power_r_button']);
    }
}
?>