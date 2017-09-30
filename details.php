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
              <img  id="logo" src="image/sunrise.jpg">
               <img  id="banner" src="image/sunset.jpg">
               </div>
                <!--  menu  -->
                <div class="menubar">
                    <ul id="menu">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Product</a></li>
                        <li><a href="#">Account</a></li><li>
                        <li><a href="#">Sign up</a></li>
                        <li><a href="#">Shopping cart</a></li>
                        <li><a href="#">contact</a></li>
                    </ul>
                    <div id="form">
                        <form method="get" action="result.php" enctype="multipart/form-data">
                            <input type="text" name="user_query" placeholder="search product">
                            <input type="submit" name="search" value="Search">
                        </form>
                    </div>
                </div> 
            </div>
            <div class="main-content">
              
                <div id="content">
                    <div id="shopping_cart" >
                        <span>Welcome to page! <b style="color:red"> Shopping Cart </b><b>Total Items: Total Price: </b><a href="cart.php"> Go to Cart</a>
                        </span>  
                    </div>
                    <div id="products_box">
        <?php
                      
       if(isset($_GET['pro_id'])){
       $productId = $_GET['pro_id'];
                    
       global $mysqli; 
       $get_pro = "SELECT * FROM products  where product_id ='$productId'"; 
       $result = $mysqli ->query($get_pro);
       while($row= $result->fetch_assoc()){
       
       $pro_id = $row['product_id'];
       $pro_title = $row['product_title'];
       $pro_price = $row['product_price'];
       $pro_des = $row['product_desc'];
       $pro_image = $row['product_image'];
       
       
       echo "
               <div id='single_product'>
               <h3>$pro_title </h3>
               <img src='function/product_images/$pro_image' width='400' height='400'>
               <p><b>$ $pro_price</b></p>
               <p>$pro_des</p>
               <a  href='index.php?pro_id=$pro_id' style='float:left;'> Go back </a>
               <a href='index.php?pro_id = $pro_id'><button style='float: right;' > Add to Cart </button></a>
               
               </div>
               ";
               
     }
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