<?php
function getFiles($intervention_id,$database){
    $sql = 'SELECT * FROM file WHERE intervention_id=:intervention_id;';
    $params = array('intervention_id'=>$intervention_id);
    $datas = $database->query($sql,$params);
    if($datas){
        $files = array();
        foreach($datas as $data){
            $file = new File();
            $file->setId($data['id']);
            $file->setIntervention_id($data['intervention_id']);
            $file->setFilename($data['filename']);
            $file->setFilepath($data['filepath']);
            $file->setVisibility((int)$data['visibility']);
            array_push($files,$file);
        }
        return $files;
    }
    return array();
}
function getFilePaths($files){
    $filePaths=array();
    foreach($files as $file){
        if (!(in_array($file->getFilePath(),$filePaths))){
            array_push($filePaths,$file->getFilePath());
        }
    }
    return $filePaths;
}
?>