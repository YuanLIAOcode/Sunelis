<?php
    function getAdminAccounts($database,$company){
        $accounts = array();
        $sql = 'SELECT * FROM client WHERE (rights="Admin" OR rights="Employe") AND companies=:companies;';
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

    function getUser($user_id,$database){
        $sql = 'SELECT * FROM client WHERE id=:id;';
        $params = array('id'=>$user_id);
        $datas = $database->query($sql,$params);
        if($datas){
            return createClient($datas[0],$database);
        }
        return null;
    }

    function existClient($username,$rights,$database){
        $sql = 'SELECT id FROM client WHERE username=:username AND rights=:rights;';
        $params = array('username'=>$username,'rights'=>$rights);
        $datas = $database->query($sql,$params);
        return(!empty($datas));
    }

    function addClient($username,$email,$rights,$companies,$database){
        if(!existClient($username,$rights,$database)){
            $token = bin2hex(random_bytes(4));
            $hashed_token = hash('sha256',$token);
            $free_id = $database->getTable('client')->getFreeId($database);
            $params = array('username'=>$username,'email'=>$email,'rights'=>$rights,'companies'=>$companies,'token'=>$hashed_token);
            if($free_id){
                $sql = 'UPDATE client SET username=:username,email=:email,token=:token,companies=:companies,rights=:rights WHERE id=:id;';
                array_push($params,$free_id);
            }else{
                $sql = 'INSERT INTO client(username,email,token,companies,rights) VALUES(:username,:email,:token,:companies,:rights);';
            }
            $database->query($sql,$params);
            return $token;
        }
        return null;
    }

    function swapPasswordAndToken($user_id,$database){
        $sql = 'SELECT token FROM client WHERE id=:id';
        $params = array('id'=>$user_id);
        $datas = $database->query($sql,$params);
        if($datas){
            $token = $datas[0]['token'];
            $sql = 'UPDATE client SET password=:token, token = "" WHERE id=:id;';
            $params['token'] = $token;
            $database->query($sql,$params);
        }
    }
?>