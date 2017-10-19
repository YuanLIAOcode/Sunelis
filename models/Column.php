<?php
    class Column{
/*
 *  Properties
 */
        private $name;
        private $type;
        private $defval;
/*
 *  Constructor
 */
        function __contruct(){
            $this->name = '';
            $this->type = '';
            $this->defval = '';
        }
/*
 *  Getters
 */
        function getName(){
            return $this->name;
        }
        
        function getType(){
            return $this->type;
        }
        
        function getDefval(){
            return $this->defval;
        }
/*
 *  Setters
 */
        function setName($name){
            if(is_string($name)){
                $this->name = $name;
            }
        }
        
        function setType($type){
            if(is_string($type)){
                $this->type= $type;
            }
        }
        
        function setDefval($defval){
            if(is_string($defval)){
                $this->defval = $defval;
            }
        }
    }
?>