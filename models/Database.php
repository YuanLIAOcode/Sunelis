<?php
    class Database{
/*
 *  Properties
 */
        private $name;
        private $tables;
        private $PDO;
/*
 *  Constructor
 */
        function __construct(){
            $host = appConf('dbHost');
            $port = appConf('dbPort');
            $name = appConf('dbName');
            $username = appConf('dbUsername');
            $password = appConf('dbPassword');
            try{
                $url = $host;
                if($port != ''){
                    $url .= ':'.$port;
                }
                $this->PDO = new PDO('mysql:host='.$url.';dbname='.$name.';charset=utf8',$username,$password);
                $this->name = $name;
                $this->setTables();
            }catch(Exception $e){
                $this->PDO = null;
                $this->name = '';
                $this->tables = array();
            }
        }
/*
 *  Getters
 */
        function getName(){
            return $this->name;
        }
        
        function getPDO(){
            return $this->PDO;
        }
        
        function getTables(){
            return $this->tables;
        }
        
        function getTable($table_name){
            foreach($this->tables as $table){
                if($table->getName() == $table_name){
                    return $table;
                }
            }
            return null;
        }
/*
 *  Setters 
 */
        private function setTables(){
            $this->tables = array();
            $sql = 'SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = :schema;';
            $params = array('schema'=>$this->name);
            $datas = $this->query($sql,$params);
            foreach($datas as $data){
                $table = new Table($this,$data['TABLE_NAME']);
                array_push($this->tables,$table);
            }
        }
/*
 *  Methods
 */
        function query($sql,$params=array()){
            $query = $this->PDO->prepare($sql);
            $query->execute($params);
            if($query){
                $datas = array();
                while($data = $query->fetch()){
                    array_push($datas,$data);
                }
                return $datas;
            }
            return false;
        }
    }
?>