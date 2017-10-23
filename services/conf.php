<?php
    function appConf($config_name){
        $filename = 'c:/wamp64/www/Sunelis/app.conf';
        if(is_file($filename)){
            $file = fopen($filename,'r');
            while($line = fgets($file)){
                $datas = explode('=',$line);
                if($datas[0] == $config_name){
                    return str_replace("\r\n","",str_replace("\r","",str_replace("\n","",$datas[1])));
                }
            }
        }else{
            array_push($_SESSION['errors'],'"c:/wamp64/www/Sunelis/app.conf" does not exist');
        }
        return null;
    }

    function setConfig($config_name){
        
    }
?>