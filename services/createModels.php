<?php
    function createModels($database){
        $classesTree = setTree($database);
        createClassFile('services/verifyType.php','w','<?php'.PHP_EOL);
        createClassesFiles($database,$classesTree);
        createClassFile('services/verifyType.php','a','?>');
    }

    function setTree($database){
        $parentTree = array();
        foreach($database->getTables() as $table){
            foreach($table->getColumns() as $column){
                $column = $column->getName();
                if(!isset($parentTree[$table->getName()])){
                    $parentTree[$table->getName()] = array();
                }
                if(strlen($column) > 2 and substr($column,-2,2) == 'id'){
                    $parent = explode('_',$column)[0];
                    if(isset($parentTree[$parent])){
                        array_push($parentTree[$parent],$table->getName());
                    }else{
                        $parentTree[$parent] = array($table->getName());
                    }
                }
            }
        }
        return $parentTree;
    }

    function createClassesFiles($database,$classesTree){
        foreach($database->getTables() as $table){
            $content = createClassFileContent($table->getName(),$table->getColumns(),$classesTree[$table->getName()]);
            createClassFile('models/'.ucfirst($table->getName()).'.php','w',$content);
        }
    }

    function createClassFileContent($class,$properties,$childs){
        $content = '<?php'.PHP_EOL."\t".'class '.ucfirst($class).'{'.PHP_EOL;
        
        setProperties($content,$properties,$childs);
        setConstructor($content,$properties,$childs);
        setGetters($content,$properties,$childs);
        setSetters($content,$properties,$childs);
        setMethods($content,$properties,$childs);
        
        $content .= "\t".'}'.PHP_EOL.'?>';
        return $content;
    }

    function setMethods(&$content,$properties,$childs){
        $content .= '/*'.PHP_EOL.' *'."\t".'Methods'.PHP_EOL.' */'.PHP_EOL;
        setReplicateMethod($content);
        setIsEqualMethod($content);
        setFlushDatabaseMethod($content);
        setUpdateDatabaseMethod($content);
        setInsertDatabaseMethod($content);
    }

    function setInsertDatabaseMethod(&$content){
        $content .= "\t\t".'private function insertDatabase($database){'.PHP_EOL;
        $content .= "\t\t\t".'$sql = "INSERT INTO ".strtolower(get_class($this))." VALUES(null,";'.PHP_EOL;
        $content .= "\t\t\t".'$params = array();'.PHP_EOL;
        $content .= "\t\t\t".'foreach($this as $property=>$value){'.PHP_EOL;
        $content .= "\t\t\t\t".'if(!is_array($value)){'.PHP_EOL;
        $content .= "\t\t\t\t\t".'if($property != "id"){'.PHP_EOL;
        $content .= "\t\t\t\t\t\t".'$params[$property] = $value;'.PHP_EOL;
        $content .= "\t\t\t\t\t\t".'$sql .= ":".$property.",";'.PHP_EOL;
        $content .= "\t\t\t\t\t".'}'.PHP_EOL."\t\t\t\t".'}'.PHP_EOL."\t\t\t".'}'.PHP_EOL;
        $content .= "\t\t\t".'$sql = substr($sql,0,strlen($sql)-1).");";'.PHP_EOL;
        $content .= "\t\t\t".'$database->query($sql,$params);'.PHP_EOL;
        $content .= "\t\t".'}'.PHP_EOL.PHP_EOL;
    }

    function setUpdateDatabaseMethod(&$content){
        $content .= "\t\t".'private function updateDatabase($database){'.PHP_EOL;
        $content .= "\t\t\t".'$sql = "UPDATE ".strtolower(get_class($this))." SET ";'.PHP_EOL;
        $content .= "\t\t\t".'$params = array();'.PHP_EOL;
        $content .= "\t\t\t".'foreach($this as $property=>$value){'.PHP_EOL;
        $content .= "\t\t\t\t".'if(!is_array($value)){'.PHP_EOL;
        $content .= "\t\t\t\t\t".'$params[$property] = $value;'.PHP_EOL;
        $content .= "\t\t\t\t\t".'if($property != "id"){'.PHP_EOL;           
        $content .= "\t\t\t\t\t\t".'$sql .= $property." = :".$property." , ";'.PHP_EOL;
        $content .= "\t\t\t\t\t".'}'.PHP_EOL."\t\t\t\t".'}'.PHP_EOL."\t\t\t".'}'.PHP_EOL;
        $content .= "\t\t\t".'$sql = substr($sql,0,strlen($sql)-2)." WHERE id=:id";'.PHP_EOL;
        $content .= "\t\t\t".'$database->query($sql,$params);'.PHP_EOL;
        $content .= "\t\t".'}'.PHP_EOL.PHP_EOL;
    }

    function setFlushDatabaseMethod(&$content){
        $content .= "\t\t".'function flushDatabase($database){'.PHP_EOL;
        $content .= "\t\t\t".'if($this->id != 0){'.PHP_EOL;
        $content .= "\t\t\t\t".'$this->updateDatabase($database);'.PHP_EOL;
        $content .= "\t\t\t".'}else{'.PHP_EOL;
        $content .= "\t\t\t\t".'$this->insertDatabase($database);'.PHP_EOL;
        $content .= "\t\t\t".'}'.PHP_EOL."\t\t".'}'.PHP_EOL.PHP_EOL;
    }

    function setReplicateMethod(&$content){
        $content .= "\t\t".'function replicate(){'.PHP_EOL;
        $content .= "\t\t\t".'$copy = new get_class($this);'.PHP_EOL;
        $content .= "\t\t\t".'foreach($this as $property=>$value){'.PHP_EOL;
        $content .= "\t\t\t\t".'$copy->$property = $value;'.PHP_EOL;
        $content .= "\t\t\t".'}'.PHP_EOL."\t\t".'}'.PHP_EOL.PHP_EOL;
    }

    function setIsEqualMethod(&$content){
        $content .= "\t\t".'function isEqual($other){'.PHP_EOL;
        $content .= "\t\t\t".'$class = get_class($this);'.PHP_EOL;
        $content .= "\t\t\t".'if(is_object($other) and ($other instanceof $class)){'.PHP_EOL;
        $content .= "\t\t\t\t".'foreach($this as $property=>$value){'.PHP_EOL;
        $content .= "\t\t\t\t\t".'if($other->$property != $value){'.PHP_EOL;
        $content .= "\t\t\t\t\t\t".'return false;'.PHP_EOL;
        $content .= "\t\t\t\t\t".'}'.PHP_EOL."\t\t\t\t".'}'.PHP_EOL."\t\t\t\t".'return true;'.PHP_EOL;
        $content .= "\t\t\t".'}'.PHP_EOL."\t\t\t".'return false;'.PHP_EOL."\t\t".'}'.PHP_EOL.PHP_EOL;
    }

    function setSetters(&$content,$properties,$childs){
        $content .= '/*'.PHP_EOL.' *'."\t".'Setters'.PHP_EOL.' */'.PHP_EOL;
        foreach($properties as $property){
            $content .= "\t\t".'function set'.ucfirst($property->getName()).'($'.$property->getName().'){'.PHP_EOL;
            if(is_int(strpos($property->getType(),'int'))){
                $content .= "\t\t\t".'if(is_int($'.$property->getName().')){'.PHP_EOL;
            }else if(is_int(strpos($property->getType(),'varchar')) or is_int(strpos($property->getType(),'text'))){
                $content .= "\t\t\t".'if(is_string($'.$property->getName().')){'.PHP_EOL;
            }
            $content .= "\t\t\t\t".'$this->'.$property->getName().' = $'.$property->getName().';'.PHP_EOL;
            $content .= "\t\t\t".'}'.PHP_EOL."\t\t".'}'.PHP_EOL.PHP_EOL;
        }
        foreach($childs as $child){
            $content .= "\t\t".'function set'.ucfirst($child).'s($'.$child.'s){'.PHP_EOL;
            $content .= "\t\t\t".'if(isArrayOf'.ucfirst($child).'s($'.$child.'s)){'.PHP_EOL;
            $content .= "\t\t\t\t".'$this->'.$child.'s = $'.$child.'s;'.PHP_EOL;
            $content .= "\t\t\t".'}'.PHP_EOL."\t\t".'}'.PHP_EOL.PHP_EOL;
            $function = createisArrayOfFunction($child);
            createClassFile('services/verifyType.php','a',$function);
        }
    }

    function setGetters(&$content,$properties,$childs){
        $content .= '/*'.PHP_EOL.' *'."\t".'Getters'.PHP_EOL.' */'.PHP_EOL;
        foreach($properties as $property){
            $content .= "\t\t".'function get'.ucfirst($property->getName()).'(){'.PHP_EOL;
            $content .= "\t\t\t".'return $this->'.$property->getName().';'.PHP_EOL;
            $content .= "\t\t".'}'.PHP_EOL.PHP_EOL;
        }
        foreach($childs as $child){
            $content .= "\t\t".'function get'.ucfirst($child).'s(){'.PHP_EOL;
            $content .= "\t\t\t".'return $this->'.$child.'s;'.PHP_EOL;
            $content .= "\t\t".'}'.PHP_EOL.PHP_EOL;
        }
    }

    function setConstructor(&$content,$properties,$childs){
        $content .= '/*'.PHP_EOL.' *'."\t".'Constructor'.PHP_EOL.' */'.PHP_EOL;
        $content .= "\t\t".'function __construct(){'.PHP_EOL;
        foreach($properties as $property){
            $content .= "\t\t\t".'$this->'.$property->getName().' = ';
            if(is_int(strpos($property->getType(),'int'))){
                if(!$property->getDefval()){
                    $content .= '0';
                }else{
                    $content .= $property->getDefval();   
                }
            }else if(is_int(strpos($property->getType(),'varchar'))){
                if(!$property->getDefval()){
                    $content .= '""';
                }else{
                    $content .= '"'.$property->getDefval().'"';
                }
            }else if(is_int(strpos($property->getType(),'text'))){
                $content .= '""';
            }
            $content .= ';'.PHP_EOL;
        }
        foreach($childs as $child){
            $content .= "\t\t\t".'$this->'.$child.'s = array();'.PHP_EOL;
        }
        $content .= "\t\t".'}'.PHP_EOL.PHP_EOL;
    }

    function setProperties(&$content,$properties,$childs){
        $content .= '/*'.PHP_EOL.' *'."\t".'Properties'.PHP_EOL.' */'.PHP_EOL;
        foreach($properties as $property){
            $content .= "\t\t".'private $'.$property->getName().';'.PHP_EOL;
        }
        foreach($childs as $child){
            $content .= "\t\t".'private $'.$child.'s;'.PHP_EOL;
        }
    }

    function createisArrayOfFunction($class){
        $content = "\t".'function isArrayOf'.ucfirst($class).'s($array){'.PHP_EOL;
        $content .= "\t\t".'if(is_array($array)){'.PHP_EOL;
        $content .= "\t\t\t".'foreach($array as $key=>$value){'.PHP_EOL;
        $content .= "\t\t\t\t".'if(!is_object($value) or !($value instanceof '.ucfirst($class).')){'.PHP_EOL;
        $content .= "\t\t\t\t\t".'return false;'.PHP_EOL;
        $content .= "\t\t\t\t".'}'.PHP_EOL."\t\t\t".'}'.PHP_EOL;
        $content .= "\t\t\t".'return true;'.PHP_EOL;
        $content .= "\t\t".'}'.PHP_EOL;
        $content .= "\t\t".'return false;'.PHP_EOL;
        $content .= "\t".'}'.PHP_EOL.PHP_EOL;
        return $content;
    }

    function createClassFile($filename,$mode,$content){
        $file = fopen($filename,$mode);
        fputs($file,$content);
        fclose($file);
    }
?>