<?php
    function getAdminAccounts($database,$company){
        $accounts = array();
        $sql = 'SELECT * FROM client WHERE rights="admin" AND companies=:companies;';
        $params = array('companies'=>$company);
        $datas = $database->query($sql,$params);
        if($datas){
            foreach($datas as $data){
                $admin = new Client();
                $admin->setId(intval($data['id']));
                $admin->setUsername($data['username']);
                $admin->setEmail($data['email']);
                $admin->setRights($data['rights']);
                array_push($accounts,$admin);
            }
        }
        return $accounts;
    }
?>