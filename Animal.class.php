<?php

class Animal{
  private $id;
	private $name;
	private $description;
	private $cost;
 	private $saleprice;
  private $amount;
  private $image;
	
	function __construct(){
	}
 
 function getID(){
		return $this->id;
	}
	
	function getName(){
		return $this->name;
	}
	
	function setName($temp){
   $this->name = $nm;
		return $this->name;
	}
 
 	function getDesc(){
		return $this->description;
	}
	
	function setDesc($temp){
   $this->desc = $temp;
		return $this->description;
	}
 
 	function getCost(){
		return $this->cost;
	}
	
	function setCost($temp){
   $this->cost = $temp;
		return $this->cost;
	}
 
 function getSale(){
		return $this->saleprice;
	}
	
	function setSale($temp){
   $this->sale = $temp;
		return $this->saleprice;
	}
 function getAmount(){
		return $this->amount;
	}
	
	function setAmount($temp){
   $this->amount = $temp;
		return $this->amount;
	}
 
 function getImage(){
		return $this->image;
	}
	
	function setImage($temp){
   $this->image = $temp;
		return $this->image;
	}
}