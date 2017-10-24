<?php
    function verifyLogin($username,$password,$database){
        $sql = 'SELECT * FROM client WHERE username=:username AND password=:password;';
        $params = array('username'=>$username,'password'=>hash('sha256',$password));
        $datas = $database->query($sql,$params);
        if($datas){
            return(createClient($datas[0],$database));            
        }
        return null;
    }

    function createClient($db_infos,$database){
        $client = new Client();
        $client->setId(intval($db_infos['id']));
        $client->setUsername($db_infos['username']);
        $client->setRights($db_infos['rights']);
        $client->setCompanies($db_infos['companies']);
        if($client->getRights() != 'admin'){
            $client->setInterventions(getInterventions($client->getId(),$database));
        }
        return $client;
    }
?>