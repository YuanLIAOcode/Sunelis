<?php
    function initAdminVariables($database){
        if(isset($_SESSION['user'])){
            $user = unserialize($_SESSION['user']);
            $user = getUser($user->getId(),$database);
            $companies = getSeveralAppConf('comp');
            if(isset($_GET['company']) and in_array($_GET['company'],$companies)){
                if($user->getRights() == 'admin'){
                       $_SESSION['current_company'] = $_GET['company'];
                }
            }else{
                $_SESSION['current_company'] = $user->getCompanies();
            }
            $comp_infos = retrieveCompanyInfos($_SESSION['current_company']);
            define('color',$comp_infos['color']);
            define('logo',$comp_infos['logo']);
            define('power_button',$comp_infos['power_button']);
            define('power_r_button',$comp_infos['power_r_button']);
        }
    }

    function retrieveCompanyInfos($company){
        $companies = getSeveralAppConf('comp');
        $i = 0;
        $find = false;
        while($i < count($companies) and !$find){
            if($companies[$i] == $company){
                $find = true;
            }
            $i += 1;
        }
        return(array('color'=>appConf('comp'.$i.'_color'),'logo'=>appConf('comp'.$i.'_logo'),'power_button'=>appConf('comp'.$i.'_power_button'),'power_r_button'=>appConf('comp'.$i.'_power_r_button')));
    }
?>