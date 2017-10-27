<?php
    function verifyLogin($username,$password,$database,$rights=array()){
        if($user = verifyPassword($username,$password,$database,$rights)){
            return $user;
        }else{
            if($user = verifyToken($username,$password,$database,$rights)){
                swapPasswordAndToken($user->getId(),$database);
                //return $user;
                return null;
            }
            return null;
        }
    }

    function verifyPassword($username,$password,$database,$rights){
        $sql = 'SELECT * FROM client WHERE username=:username AND password=:password';
        if($rights != array()){
            $sql .= ' AND (';
            foreach($rights as $right){
                $sql .= 'rights = "'.$right.'" OR ';
            }
            $sql = substr($sql,0,strlen($sql)-3).');';
        }
        $params = array('username'=>$username,'password'=>hash('sha256',$password));
        $datas = $database->query($sql,$params);
        if($datas){
            return(createClient($datas[0],$database));            
        }
        return null;
    }

    function verifyToken($username,$password,$database,$rights){
        $sql = 'SELECT * FROM client WHERE username=:username AND token=:password';
        if($rights != array()){
            $sql .= ' AND (';
            foreach($rights as $right){
                $sql .= 'rights = "'.$right.'" OR ';
            }
            $sql = substr($sql,0,strlen($sql)-3).');';
        }
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