<?php
    class Table{
/*
 *  Properties
 */
        private $name;
        private $columns;
/*
 *  Constructor
 */
        function __construct($database,$name){
            $this->setName($name);
            $this->setColumns($database);
        }
/*
 *  Getters
 */
        function getName(){
            return $this->name;
        }
        
        function getColumns(){
            return $this->columns;
        }
/*
 *  Setters
 */
        function setName($name){
            if(is_string($name)){
                $this->name = $name;
            }
        }
        
        private function setColumns($database){
            $this->columns = array();
            $sql = 'SELECT COLUMN_NAME,COLUMN_TYPE,COLUMN_DEFAULT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :name;';
            $params = array('name'=>$this->name);
            $datas = $database->query($sql,$params);
            foreach($datas as $data){
                $column = new Column();
                $column->setName($data['COLUMN_NAME']);
                $column->setType($data['COLUMN_TYPE']);
                $column->setDefval($data['COLUMN_DEFAULT']);
                array_push($this->columns,$column);
            }
        }
/*
 *  Methods
 */
        function getFreeId($database){
            $sql = 'SELECT id FROM '.$this->getName().' WHERE ';
            foreach($this->getColumns() as $column){
                if($column->getName() != 'id'){
                    if($column->getDefval()){
                        if(is_int(strpos($column->getType(),'int'))){
                            $sql .= $column->getName().' = '.$column->getDefval();
                        }else if(is_int(strpos($column->getType(),'varchar')) or is_int(strpos($column->getType(),'text'))){
                            $sql .= $column->getName().' = "'.$column->getDefval().'"';
                        }
                    }else{
                        if(is_int(strpos($column->getType(),'int'))){
                            $sql .= $column->getName().' = 0';
                        }else if(is_int(strpos($column->getType(),'varchar')) or is_int(strpos($column->getType(),'text'))){
                            $sql .= $column->getName().' = ""';
                        }
                    }
                    $sql .= ' AND ';
                }
            }
            $sql = substr($sql,0,strlen($sql)-4).' ORDER BY id LIMIT 1;';
            $datas = $database->query($sql);
            if(count($datas) == 1){
                return intval($datas[0]['id']);
            }else{
                return 0;
            }
        }
        
        function setFreeId($database,$id){
            if($this->idExist($database,$id)){
                $sql = 'UPDATE '.$this->getName().' SET ';
                foreach($this->getColumns() as $column){
                    if($column->getName() != 'id'){
                        if($column->getDefval()){
                            if(is_int(strpos($column->getType(),'int'))){
                                $sql .= $column->getName().' = '.$column->getDefval();
                            }else if(is_int(strpos($column->getType(),'varchar')) or is_int(strpos($column->getType(),'text'))){
                                $sql .= $column->getName().' = "'.$column->getDefval().'"';
                            }
                        }else{
                            if(is_int(strpos($column->getType(),'int'))){
                                $sql .= $column->getName().' = 0';
                            }else if(is_int(strpos($column->getType(),'varchar')) or is_int(strpos($column->getType(),'text'))){
                                $sql .= $column->getName().' = ""';
                            }
                        }
                        $sql .= ' , ';
                    }
                }
                $sql = substr($sql,0,strlen($sql)-2).' WHERE id=:id;';
                $params = array('id'=>$id);
                $database->query($sql,$params);
            }
        }
        
        private function idExist($database,$id){
            $sql = 'SELECT id FROM '.$this->getName().' WHERE id=:id;';
            $params = array('id'=>$id);
            $datas = $database->query($sql,$params);
            return($datas != null);
        }
    }
?>