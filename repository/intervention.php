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

    function orderInterventions($interventions){
        $taille = count($interventions); 
            for($i = 0; $i < $taille-1; $i++) { 
                for($j = $taille-2; $j >= $i; $j--) { 
                    if(transformationDate($interventions[$j+1]) <transformationDate( $interventions[$j])) { 
                        $temp = $interventions[$j+1]; 
                        $interventions[$j+1] = $interventions[$j]; 
                        $interventions[$j] = $temp; 
                }
            } 
        } 
        return $interventions;
    }
    
    function copyIntervention($intervention1,$intervention2){
                $intervention1->setId($intervention2->getId());
                $intervention1->setClient_id($intervention2->getClient_Id());
                $intervention1->setState($intervention2->getState());
                $intervention1->setIdate($intervention2->getIdate());
                $intervention1->setName($intervention2->getName());
                $intervention1->setDescription($intervention2->getDescription());
                $intervention1->setAddress($intervention2->getAddress());
                $intervention1->setFiles($intervention2->getFiles());
    }
    function transformationDate($Intervention){
        $Date =$Intervention->getIdate();
        $newDate='';
        if (strlen($Date)==10){
            $newDate=substr($Date,6,4).substr($Date,3, 2).substr($Date,0,2);
        }
        else{
            echo 'error in intervention date format';
        }
        return $newDate;
    }
?>