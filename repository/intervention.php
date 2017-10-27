<?php
function getInterventions($client_id,$database){
    $sql = 'SELECT * FROM intervention WHERE client_id=:client_id';
    $params = array('client_id'=>$client_id);
    $datas = $database->query($sql,$params);
    if($datas){
        $interventions = array();
        foreach($datas as $data){
            $intervention = new Intervention();
            $intervention->setId((int)$data['id']);
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

function orderInterventions($interventions){
    $taille = count($interventions); 
    for($i = 0; $i < $taille-1; $i++) { 
        for($j = $taille-2; $j >= $i; $j--) { 
            $dateJ=new Date();
            $dateJ1=new Date();
            $dateJ->setDateFromFormatString($interventions[$j]->getIdate());
            $dateJ1->setDateFromFormatString($interventions[$j+1]->getIdate());
            if($dateJ1 ->getFormatString() <$dateJ->getFormatString()) { 
                $temp = $interventions[$j+1]; 
                $interventions[$j+1] = $interventions[$j]; 
                $interventions[$j] = $temp; 
            }
        } 
    } 
    return $interventions;
}