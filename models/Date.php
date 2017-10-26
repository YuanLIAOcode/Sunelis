<?php
	class Date{
/*
 *	Properties
 */
		private $id;
		private $année;
		private $mois;
		private $jour;
		private $formatString;
	
/*
 *	Constructor
 */
		function __construct(){
			$this->id = 0;
			$this->année = 1970;
			$this->mois= 1;
			$this->jour = 1;
			$this->formatString = "";
		}

/*
 *	Getters
 */
		function getId(){
			return $this->id;
		}

		function getAnnée(){
			return $this->année;
		}

		function getMois(){
			return $this->mois;
		}

		function getJour(){
			return $this->jour;
		}

		function getFormatString(){
			return $this->formatString;
		}


/*
 *	Setters
 */
		function setId($id){
			if(is_int($id)){
				$this->id = $id;
			}
		}

		function setAnnée($année){
			if(is_int($année)){
				$this->année = $année;
			}
		}

		function setMois($mois){
			if(is_int($mois)){
				$this->mois = $mois;
			}
		}

		function setJour($jour){
			if(is_int($jour)){
				$this->jour = $jour;
			}
		}
        
        function setFormatString($année,$mois,$jour){
            if(is_int($jour) && is_int($mois) && is_int($année)){
                $this->formatString=$année.$mois.$jour;
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
        function setDateFromFormatString($oldFormatString){
			if(is_string($oldFormatString)){
                if (strlen($oldFormatString)==10){
                    $this->formatString=substr($oldFormatString,6,4).substr($oldFormatString,3, 2).substr($oldFormatString,0,2);
                    $this->année = substr($oldFormatString,6,4);
                    $this->mois = substr($oldFormatString,3,2);
                    $this->jour = substr($oldFormatString,0,2);
                }				 
			}
		}
    }
?>