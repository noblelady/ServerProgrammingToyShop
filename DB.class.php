<?php

class DB
{
    private $dbh;

    function __construct()
    {
        require_once("../../../serverinfo.php");
        require_once("Animal.class.php");
        require_once("Cart.class.php");
        try{
            $this->dbh = new PDO("mysql:host=$host;dbname=$db",$user,$pass);
            //change error reporting
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch (PDOException $e){
            echo $e->getMessage();
        }
    }//constructor
    
    //returns all animals
    function getAllAnimals(){
        try{
			$data = array();
			$stmt = $this->dbh->prepare("SELECT * from animals");
			$stmt->execute();
			$data = $stmt->fetchAll(PDO::FETCH_CLASS,"Animal");
			return $data;
      }catch (PDOException $e){
          echo $e->getMessage();
          die();
      }
    }//end function
    
    //returns all sale animals
    function getAllSaleAnimals(){
      try{
  			$data = array();
  			$stmt = $this->dbh->prepare("SELECT * from animals WHERE saleprice <> 0");
  			$stmt->execute();
  			$data = $stmt->fetchAll(PDO::FETCH_CLASS,"Animal");
  			while($temp=$stmt->fetch()){
				  $data[] = $temp;
  			}
  			return $data;
       }catch (PDOException $e){
            echo $e->getMessage();
            die();
       }
    }//end function
    
    function getCatalogAnimals(){
      try{
  			$data = array();
  			$stmt = $this->dbh->prepare("SELECT * from animals WHERE saleprice = 0");
  			$stmt->execute();
  			$data = $stmt->fetchAll(PDO::FETCH_CLASS,"Animal");
  			while($temp=$stmt->fetch()){
				  $data[] = $temp;
  			}
  			return $data;
      }catch (PDOException $e){
        echo $e->getMessage();
        die();
      }
    }//end catalog function
    
    function getAnimalByID($id){
      try{
  			$data = array();
  			$stmt = $this->dbh->prepare("SELECT * FROM animals where id = :id");
  			$stmt->bindParam(":id",$id,PDO::PARAM_INT);
  			$stmt->execute();
  			$data = $stmt->fetchAll(PDO::FETCH_CLASS,"Animal");
  			return $data;
      }catch (PDOException $e){
        echo $e->getMessage();
        die();
      }
    }//end function
    
    //function adds to cart
    function insertIntoCart($id,$cost){
      try{
  			$data = array();
  			$stmt = $this->dbh->prepare("INSERT INTO cart VALUES(NULL,:id,:cost)");
  			$stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->bindParam(":cost",$cost,PDO::PARAM_INT);
  			$stmt->execute();
  			return $data;
      }catch (PDOException $e){
        echo $e->getMessage();
        die();
      }
    }
    
    //updates the animal
    function updateAnimalAmount($id){
      try{
  			$data = array();
  			$stmt = $this->dbh->prepare("UPDATE animals SET amount = amount-1 WHERE id=:id");
  			$stmt->bindParam(":id",$id,PDO::PARAM_INT);
  			$stmt->execute();
  			return $data;
      }catch (PDOException $e){
        echo $e->getMessage();
        die();
      }
    }
    
    //gets all items in the cart
    function getAllCartItems(){
      try{
  			$data = array();
  			$stmt = $this->dbh->prepare("SELECT * FROM cart");
  			$stmt->execute();
  			$data = $stmt->fetchAll(PDO::FETCH_CLASS,"Cart");
  			while($temp=$stmt->fetch()){
				  $data[] = $temp;
  			}
  			return $data;
      }catch (PDOException $e){
        echo $e->getMessage();
        die();
      }
    }//end function
    
    function truncateCart(){
      try{
  			$stmt = $this->dbh->prepare("truncate cart");
  			$stmt->execute();
      }catch (PDOException $e){
        echo $e->getMessage();
        die();
      }
    }
    
    //this function makes a new animal item
    function insertIntoAnimals($name,$desc,$cost,$sale,$amount,$image){
      try{
  			$data = array();
  			$stmt = $this->dbh->prepare("INSERT INTO animals VALUES(NULL,:name,:desc,:cost,:sale,:amount,:image)");
  			$stmt->bindParam(":name",$name,PDO::PARAM_STR);
        $stmt->bindParam(":desc",$desc,PDO::PARAM_STR);
        $stmt->bindParam(":cost",$cost);
        $stmt->bindParam(":sale",$sale);
        $stmt->bindParam(":amount",$amount,PDO::PARAM_INT);
        $stmt->bindParam(":image",$image,PDO::PARAM_STR);
  			$stmt->execute();
  			return $data;
      }catch (PDOException $e){
        echo $e->getMessage();
        die();
      }
    }
    
    //this function updates existing with all information
    function updateAnimal($name,$desc,$cost,$sale,$amount,$image){
      try{
  			$data = array();
  			$stmt = $this->dbh->prepare("UPDATE animals SET name = :name, SET description =:desc,SET cost = :cost,SET saleprice=:sale, SET amount=:amount, SET image= :image WHERE name=:name");
  			$stmt->bindParam(":name",$name,PDO::PARAM_STR);
        $stmt->bindParam(":desc",$desc,PDO::PARAM_STR);
        $stmt->bindParam(":cost",$cost);
        $stmt->bindParam(":sale",$sale);
        $stmt->bindParam(":amount",$amount,PDO::PARAM_INT);
        $stmt->bindParam(":image",$image,PDO::PARAM_STR);
  			$stmt->execute();
  			return $data;
      }catch (PDOException $e){
        echo $e->getMessage();
        die();
      }
    }//end of function
}