<!DOCTYPE >
<?php 
include 'function/function.php';
?>
<html>
    <head>
        <title> Online Market </title>
        <link rel="stylesheet" href="style/style.css" media ="all">
    </head>
    
    
    <body>
        <!--  main container  -->
        <div class="main-wrapper"> 
        
            <div class="header">
                <div class="image-logo"> 
                    <a href="index.php" <img  id="logo" src="image/sunrise.jpg"></a>
                    <img  id="banner" src="image/sunset.jpg">
               </div>
                <!--  menu  -->
                <div class="menubar">
                    <ul id="menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="allproduct.php">Product</a></li>
                        <li><a href="#">Account</a></li><li>
                        <li><a href="#">Sign up</a></li>
                        <li><a href="#">Shopping cart</a></li>
                        <li><a href="#">contact</a></li>
                    </ul>
                    <div id="form">
                        <form method="get" action="search.php" enctype="multipart/form-data">
                            <input type="text" name="user_query" placeholder="search product">
                            <input type="submit" name="search" value="Search">
                        </form>
                    </div>
                </div> 
            </div>
            <div class="main-content">
             
                <div id="content">
                      
                    <div id="shopping_cart" >
                        <span>Welcome to page! <b style="color:red"> Shopping Cart </b>Total Items:<?php total_item()?> Total Price:<?php total_price()?>  </b><a href="cart.php"> Go to Cart</a>
                        </span>  
                    </div>
                     <?php cart();?>
                    <div id="products_box">
                     <?php
                     if(!isset($_SESSION['customer_email'])){
                         include("customer_log.php");
                     }
                     else{
                          include("function/paypale.php");
                     }
                     
                     ?>
                     
                    </div>
                    
                </div> 
              <div id="sidebar">
                  <div id="sidebar_title">Categories</div>
                  
                  <ul id="cats">
                        <?php  getCats();?> 
                  </ul>
                  
                   <div id="sidebar">
                 <div id="sidebar_title">Brands</div>
                  
                  <ul id="cats">
                       <?php  getBrands();?> 
                  </ul>
              </div>
              </div>
             
            </div>
            
            <div id="footer">
                
                <p>&copy; 2017 Mulugeta Forsido<p>
            </div>
        
        </div>
    </<body>
</html>