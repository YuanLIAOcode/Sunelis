<?php
    function sessionInit(){
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['infos'])){
            $_SESSION['infos'] = array();
        }
        if(!isset($_SESSION['warnings'])){
            $_SESSION['warnings'] = array();
        }
        if(!isset($_SESSION['errors'])){
            $_SESSION['errors'] = array();
        }
    }

    function displaySessionLogs(){
        if(isset($_SESSION['errors'])){
            foreach($_SESSION['errors'] as $error){
                echo '<span id="error"><img src="'.appConf('urlrootpath').'globalViews/images/icons/error.png" alt="ERROR :"/>'.$error.'</span>';
            }
            $_SESSION['errors'] = array();
        }
        if(isset($_SESSION['warnings'])){
            foreach($_SESSION['warnings'] as $warning){
                 echo '<span id="warning"><img src="'.appConf('urlrootpath').'globalViews/images/icons/warning.png" alt="WARNING :"/>'.$warning.'</span>';
            }
            $_SESSION['warnings'] = array();
        }
        if(isset($_SESSION['infos'])){
            foreach($_SESSION['infos'] as $info){
                echo '<span id="info"><img src="'.appConf('urlrootpath').'globalViews/images/icons/info.png" alt="info :"/>'.$info.'</span>';
            }
            $_SESSION['infos'] = array();
        }
    }
?>