<?php
	class Client{
/*
 *	Properties
 */
		private $id;
		private $username;
		private $password;
		private $email;
		private $token;
		private $rights;
		private $interventions;
/*
 *	Constructor
 */
		function __construct(){
			$this->id = 0;
			$this->username = "";
			$this->password = "";
			$this->email = "";
			$this->token = "";
			$this->rights = "";
			$this->interventions = array();
		}

/*
 *	Getters
 */
		function getId(){
			return $this->id;
		}

		function getUsername(){
			return $this->username;
		}

		function getPassword(){
			return $this->password;
		}

		function getEmail(){
			return $this->email;
		}

		function getToken(){
			return $this->token;
		}

		function getRights(){
			return $this->rights;
		}

		function getInterventions(){
			return $this->interventions;
		}

/*
 *	Setters
 */
		function setId($id){
			if(is_int($id)){
				$this->id = $id;
			}
		}

		function setUsername($username){
			if(is_string($username)){
				$this->username = $username;
			}
		}

		function setPassword($password){
			if(is_string($password)){
				$this->password = $password;
			}
		}

		function setEmail($email){
			if(is_string($email)){
				$this->email = $email;
			}
		}

		function setToken($token){
			if(is_string($token)){
				$this->token = $token;
			}
		}

		function setRights($rights){
			if(is_string($rights)){
				$this->rights = $rights;
			}
		}

		function setInterventions($interventions){
			if(isArrayOfInterventions($interventions)){
				$this->interventions = $interventions;
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