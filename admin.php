<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Project 1</title>
    <link rel="stylesheet" href="css/foundation.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
  </head>
  <body>
    <?php
      require_once("LIB_project1.php");
      require_once("DB.class.php");
      session_name("claire");
      session_start();
      $db = new DB();
      $_SESSION["db"] = $db;
    ?>
    <!-- Start Top Bar -->
    <div class="top-bar">
      <div class="top-bar-left">
        <ul class="menu">
          <li class="menu-text"><a href="index.php">Stuffed Animal Friends</a></li>
          <li><a href="admin.php">Admin</a></li>
        </ul>
      </div>
      <div class="top-bar-right">
        <ul class="menu">
          <li><a href="cart.php">Cart</a></li>
        </ul>
      </div>
    </div>
    <!-- End Top Bar -->
    
    <div class="row column text-center">
      <h2>Sales Items</h2>
      <hr>
    </div>
    
    <div class="row column">
      <div class="callout primary">
        <h3>Select an animal friend and edit the information.</h3>
      </div>
    </div>
    
    <div class="admin-animals row">
      <?php
        echo getAllItems();
      ?>
    </div>
    
    <?php
      if (isset($_GET['id'])) {
        echo fillForm($_GET['id']);
      }
    ?>
    
    <div class="row column">
      <div class="callout primary">
        <h3>Add a new Animal Friend</h3>
      </div>
    </div>
    <form method='get'>
      <div class='row'>
          <div class='large-4 columns'>
            <label>Name
              <input type='text' name="add-name" placeholder='Name' required/>
            </label>
          </div>
          <div class='large-4 columns'>
            <label>Price
              <input type='text' name="add-cost" placeholder='$10.00' required/>
            </label>
          </div>
          <div class='large-4 columns'>
            <label>Amount
              <input type='text' name="add-amount" placeholder='##' required/>
            </label>
          </div>
        </div>
        <div class='row'>
          <div class='large-4 columns'>
            <label>Sale Price
              <input type='text' name="add-sale" placeholder='$5.00' required/>
            </label>
          </div>
          <div class='large-8 columns'>
            <label>Description
              <textarea name="add-desc" required></textarea>
            </label>
          </div>
        </div>
        <div class='row'>
          <div class='large-6 columns'>
            <label>Image
              <input type='file' name='add-image' id='fileToUpload' required>
            </label>
          </div>
          <div class='large-6 columns'>
            <label><b>Password</b>
              <input type='password' name='add-pass' placeholder='Password' />
            </label>
          </div>
        </div>
        <div class='row'>
          <div class='large-2 columns'>
              <input type='submit' value='Submit Item' name='add-submit'>
            </div>
            <div class='large-2 columns'>
              <input type='reset' value='Reset Form' name='reset'>
            </div>
          </div>
        </div>
    </form>
    
    <?php
      if(isset($_POST['edit-submit'])){
        if($_POST['edit-pass'] != "password"){
          echo "<h1 class='wrong'>WRONG PASSWORD</h1>";
        }else{
          //send edit data
          editAnimalItem(
            $_POST['edit-name'],$_POST['edit-desc'],$_POST['edit-cost'],$_POST['edit-sale'],$_POST['edit-amount'],$_POST['edit-image']
          );
        }
      }elseif(isset($_POST['add-submit'])){
        if($_POST['add-pass'] != "password"){
          echo "test";
          echo "<h1 class='wrong'>WRONG PASSWORD</h1>";
        }else{
          //send new data
          addAnimalItem(
            $_POST['add-name'],$_POST['add-desc'],$_POST['add-cost'],$_POST['add-sale'],$_POST['add-amount'],$_POST['add-image']
          );
        }
      }
    ?>
    

  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script src="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>  
  <script type="text/javascript" src="slick/slick.min.js"></script>

  <script type="text/javascript" src="js/app.js"></script>
  
  </body>
</html>