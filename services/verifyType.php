<?php
	function isArrayOfInterventions($array){
		if(is_array($array)){
			foreach($array as $key=>$value){
				if(!is_object($value) or !($value instanceof Intervention)){
					return false;
				}
			}
			return true;
		}
		return false;
	}

	function isArrayOfFiles($array){
		if(is_array($array)){
			foreach($array as $key=>$value){
				if(!is_object($value) or !($value instanceof File)){
					return false;
				}
			}
			return true;
		}
		return false;
	}

?>