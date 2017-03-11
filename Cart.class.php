<?php

Class Cart{
  private $cartID;
  private $animalID;
  private $animalCost;
  
  function __construct(){
	}
 
 function getID(){
   return $this->id;
 }
 
 function getAnimalID(){
   return $this->animalID;
 }
 
 function getAnimalCost(){
   return $this->animalCost;
 }

}