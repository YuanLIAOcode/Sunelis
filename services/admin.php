<?php
    function initAdminVariables(){
        if(isset($_SESSION['user'])){
            $user = unserialize($_SESSION['user']);
            $companies = array('SUNELIS','ISOLAVIE','NORD SOLUTIONS TOITURE');
            if(isset($_GET['company']) and in_array($_GET['company'],$companies)){
                if($user->getRights() == 'admin'){
                       $_SESSION['current_company'] = $_GET['company'];
                }
            }
            if(!isset($_SESSION['current_company'])){
                $_SESSION['current_company'] = $user->getComapnies();
            }
            switch($_SESSION['current_company']){
                case 'SUNELIS':
                    define('color','rgb(255,139,0)');
                    define('logo','sunelis.jpg');
                    break;
                case 'ISOLAVIE':
                    define('color','');
                    define('logo','');
                    break;
                case 'NORD SOLUTIONS TOITURE':
                    define('color','');
                    define('logo','');
                    break;
                default:
            }
        }
    }
?>