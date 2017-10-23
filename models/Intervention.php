<?php
	class Intervention{
/*
 *	Properties
 */
		private $id;
		private $client_id;
		private $state;
		private $date;
		private $name;
		private $description;
		private $address;
		private $files;
/*
 *	Constructor
 */
		function __construct(){
			$this->id = 0;
			$this->client_id = 0;
			$this->state = "";
			$this->date = "";
			$this->name = "";
			$this->description = "";
			$this->address = "";
			$this->files = array();
		}

/*
 *	Getters
 */
		function getId(){
			return $this->id;
		}

		function getClient_id(){
			return $this->client_id;
		}

		function getState(){
			return $this->state;
		}

		function getDate(){
			return $this->date;
		}

		function getName(){
			return $this->name;
		}

		function getDescription(){
			return $this->description;
		}

		function getAddress(){
			return $this->address;
		}

		function getFiles(){
			return $this->files;
		}

/*
 *	Setters
 */
		function setId($id){
			if(is_int($id)){
				$this->id = $id;
			}
		}

		function setClient_id($client_id){
			if(is_int($client_id)){
				$this->client_id = $client_id;
			}
		}

		function setState($state){
			if(is_string($state)){
				$this->state = $state;
			}
		}

		function setDate($date){
			if(is_string($date)){
				$this->date = $date;
			}
		}

		function setName($name){
			if(is_string($name)){
				$this->name = $name;
			}
		}

		function setDescription($description){
			if(is_string($description)){
				$this->description = $description;
			}
		}

		function setAddress($address){
			if(is_string($address)){
				$this->address = $address;
			}
		}

		function setFiles($files){
			if(isArrayOfFiles($files)){
				$this->files = $files;
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