<?php
	class File{
/*
 *	Properties
 */
		private $id;
		private $intervention_id;
		private $filename;
		private $filepath;
		private $visibility;
/*
 *	Constructor
 */
		function __construct(){
			$this->id = 0;
			$this->intervention_id = 0;
			$this->filename = "";
			$this->filepath = "";
			$this->visibility = 0;
		}

/*
 *	Getters
 */
		function getId(){
			return $this->id;
		}

		function getIntervention_id(){
			return $this->intervention_id;
		}

		function getFilename(){
			return $this->filename;
		}

		function getFilepath(){
			return $this->filepath;
		}

		function getVisibility(){
			return $this->visibility;
		}

/*
 *	Setters
 */
		function setId($id){
			if(is_int($id)){
				$this->id = $id;
			}
		}

		function setIntervention_id($intervention_id){
			if(is_int($intervention_id)){
				$this->intervention_id = $intervention_id;
			}
		}

		function setFilename($filename){
			if(is_string($filename)){
				$this->filename = $filename;
			}
		}

		function setFilepath($filepath){
			if(is_string($filepath)){
				$this->filepath = $filepath;
			}
		}

		function setVisibility($visibility){
			if(is_int($visibility)){
				$this->visibility = $visibility;
			}
		}

/*
 *	Methods
 */
		function replicate(){
			$copy = new get_class($this);
			foreach($this as $property=>$value){
				$copy->$property = $value;
			}
		}

		function isEqual($other){
			$class = get_class($this);
			if(is_object($other) and ($other instanceof $class)){
				foreach($this as $property=>$value){
					if($other->$property != $value){
						return false;
					}
				}
				return true;
			}
			return false;
		}

		function flushDatabase($database){
			if($this->id != 0){
				$this->updateDatabase($database);
			}else{
				$this->insertDatabase($database);
			}
		}

		private function updateDatabase($database){
			$sql = "UPDATE ".strtolower(get_class($this))." SET ";
			$params = array();
			foreach($this as $property=>$value){
				if(!is_array($value)){
					$params[$property] = $value;
					if($property != "id"){
						$sql .= $property." = :".$property." , ";
					}
				}
			}
			$sql = substr($sql,0,strlen($sql)-2)." WHERE id=:id";
			$database->query($sql,$params);
		}

		private function insertDatabase($database){
			$sql = "INSERT INTO ".strtolower(get_class($this))." VALUES(null,";
			$params = array();
			foreach($this as $property=>$value){
				if(!is_array($value)){
					if($property != "id"){
						$params[$property] = $value;
						$sql .= ":".$property.",";
					}
				}
			}
			$sql = substr($sql,0,strlen($sql)-1).");";
			$database->query($sql,$params);
		}

	}
?>