<?php
    function getInterventions($client_id,$database){
        $sql = 'SELECT * FROM intervention WHERE client_id=:client_id';
        $params = array('client_id'=>$client_id);
        $datas = $database->query($sql,$params);
        if($datas){
            $interventions = array();
            foreach($datas as $data){
                $intervention = new Intervention();
                $intervention->setId($data['id']);
                $intervention->setClient_id($client_id);
                $intervention->setState($data['state']);
                $intervention->setIdate($data['idate']);
                $intervention->setName($data['name']);
                $intervention->setDescription($data['description']);
                $intervention->setAddress($data['address']);
                $intervention->setFiles(getFiles($intervention->getId(),$database));
                array_push($interventions,$intervention);
            }
            return $interventions;
        }
        return array();
    }
?>