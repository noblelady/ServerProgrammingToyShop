<?php
	require_once("DB.class.php");
   session_name("claire");
   if(session_id() == '') {
    session_start();
    }
   
   //this function returns all the sales items
   function getSalesItems(){
     //$data = $db->getAllSaleAnimals(); //should return 4 items.
     $_SESSION["tempDB"] = $_SESSION["db"];
     $data = $_SESSION["db"]->getAllSaleAnimals();
     foreach($data as $animal){//loops thru the array of objects
       $html .= "<div class= column>" .
       "<img class='thumbnail' src='images/".$animal->getImage()."'>".
       "<h5>".$animal->getName()." Friend</h5>" .
       "<p>Sales Price: $".$animal->getSale()." (Usually $".$animal->getCost().")</p>" .
       "<p>".$animal->getDesc()."</p>".
       "<p># left: ".$animal->getAmount()."</p>" .
       "<a href='index.php?id=".$animal->getID()."' class='button expanded'>Buy</a>" .
       "</div>";
     }
     return $html;
   }//end get slaes item function
   
   function getCatalogItems(){
     $data = $_SESSION["db"]->getCatalogAnimals();
     foreach($data as $animal){//loops thru the array of objects
       $html .=  "<div class='item'>" .
            "<img class='thumbnail' src='images/".$animal->getImage()."'>".
            "<h5>".$animal->getName()."</h5>" . 
            "<p>Price: $".$animal->getCost()."</p>".
            "<p>".$animal->getDesc()."</p>".
            "<p># left: ".$animal->getAmount()."</p>" .
            "<a href='index.php?id=".$animal->getID()."' class='button expanded'>Buy</a>".
          "</div>";
     }
     return $html;
   }//

   //this function is to add to the cart
   function addToCart($id){
     $data = $_SESSION["db"]->getAnimalByID($id);
     $_SESSION["db"]->insertIntoCart($id,$data[0]->getCost());
   }
   
   //updates the animal after added to the cart
   function updateAnimal($id){
     $_SESSION["db"]->updateAnimalAmount($id);
   }
   
   //gets all the items that are in the cart
   function getCartItems(){
     $data = $_SESSION["db"]->getAllCartItems();
     foreach($data as $cartItem){//loops thru the array of objects
       $animal = $_SESSION["db"]->getAnimalByID($cartItem->getAnimalID());
       $html .=  "<div class='cart-item'>" .
            "<h5>".$animal[0]->getName()."</h5>" . 
            "<p>Price: $".$animal[0]->getCost()."</p>".
          "</div>";
     }
     return $html;
   }//end function
   
   function clearCart(){
     $_SESSION["db"]->truncateCart();
   }
   
   //adds the toal of the cart
   function addCartTotal(){
     $total = 0;
     $data = $_SESSION["db"]->getAllCartItems();
     foreach($data as $cartItem){//loops thru the array of objects
       $total += $cartItem->getAnimalCost();
     }
     return $total;
   }
   
   //returns all items for the admin page
   function getAllItems(){
     $data = $_SESSION["db"]->getAllAnimals();
     foreach($data as $animal){//loops thru the array of objects
       $html .=  "<div class='item'>" .
            "<img class='thumbnail' src='images/".$animal->getImage()."'>".
            "<h5>".$animal->getName()."</h5>" . 
            "<p>Price: $".$animal->getCost()."</p>".
            "<p># left: ".$animal->getAmount()."</p>" .
            "<a href='admin.php?id=".$animal->getID()."' class='button expanded'>Edit</a>".
          "</div>";
     }
     return $html;
   }//end function
   
   function addAnimalItem($name,$desc,$cost,$sale,$amount,$image){
     $_SESSION["db"]->insertIntoAnimals($name,$desc,$cost,$sale,$amount,$image);
   }
   
   function editAnimalItem($name,$desc,$cost,$sale,$amount,$image){
     $_SESSION["db"]->updateAnimal($name,$desc,$cost,$sale,$amount,$image);
   }
   
   //this function returns the form to edit exsisting information
   function fillForm($id){
     $data = $_SESSION["db"]->getAnimalByID($id);
     $html = "<form method='get'>
      <div class='row'>
        <div class='large-4 columns'>
          <label>Name
            <input type='text' name='edit-name' placeholder='Name' value='".$data[0]->getName()."'required/>
          </label>
        </div>
        <div class='large-4 columns'>
          <label>Price
            <input type='text' name='edit-cost' placeholder='$10.00' value='".$data[0]->getCost()."'required/>
          </label>
        </div>
        <div class='large-4 columns'>
          <label>Amount
            <input type='text' name='edit-amount' placeholder='##' value='".$data[0]->getAmount()."' required/>
          </label>
        </div>
      </div>
      <div class='row'>
        <div class='large-4 columns'>
          <label>Sale Price
            <input type='text' name='edit-sale' placeholder='$5.00' value='".$data[0]->getSale()."' required/>
          </label>
        </div>
        <div class='large-8 columns'>
          <label>Description
            <textarea name='edit-desc' required>".$data[0]->getDesc()."</textarea>
          </label>
        </div>
      </div>
      <div class='row'>
        <div class='large-6 columns'>
          <label>Image
            <input type='file' name='edit-imafe' id='fileToUpload' required>
          </label>
        </div>
        <div class='large-6 columns'>
          <label><b>Password</b>
            <input type='password' name='edit-pass' placeholder='Password' />
          </label>
        </div>
      </div>
      <div class='row'>
        <div class='large-2 columns'>
            <input type='submit' value='Submit Item' name='edit-submit'>
          </div>
          <div class='large-2 columns'>
            <input type='reset' value='Reset Form' name='reset'>
          </div>
        </div>
      </div>
    </form>";
    return $html;
   }//end function
 ?>