<?php
  require_once("LIB_project1.php");
  require_once("DB.class.php");
  session_name("claire");
  session_start();
  $_SESSION["db"] = new DB();
?>
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
        <h3>Really big special this week on items.</h3>
      </div>
    </div>
    
    <div class="row small-up-2 large-up-4">
      <?php
        echo getSalesItems();
      ?>
    </div>

    <hr>

    <div class="row column text-center">
      <h2>Catalog</h2>
      <hr>
    </div>

    <div class="catalog row">
      <?php
        echo getCatalogItems();
      ?>
    </div>
    <?php
      if (isset($_GET['id'])) {
        addToCart($_GET['id']);
        updateAnimal($_GET['id']);
      }
    ?>
    

  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script src="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>  
  <script type="text/javascript" src="slick/slick.min.js"></script>

  <script type="text/javascript" src="js/app.js"></script>
  
  </body>
</html>