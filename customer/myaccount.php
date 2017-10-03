<!DOCTYPE >
<?php 
include '../function/function.php';
include '../connect/connect.php'; 
session_start();
?>
<html>
    <head>
        <title> Online Market </title>
        <link rel="stylesheet" href="../style/style.css" media ="all">
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
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../allproduct.php">Product</a></li>
                        <li><a href="myaccount.php">Account</a></li><li>
                        <li><a href="customer_register.php">Sign up</a></li>
                        <li><a href="../cart.php">Shopping cart</a></li>
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
                        <span>
                             <?php
                                 if(isset($_SESSION['firstname'])){
                                        echo "<b> Welcome: </b>" . $_SESSION['firstname']." <b> your: </b>";
                                   }
                        
                               ?>  
                            
                            
                            <b style="color:red"> Shopping Cart </b>Total Items:<?php total_item()?> Total Price:<?php total_price()?>  </b><a href="../cart.php"> Go to Cart</a>
                       
                                  <?php 
                                        if(!isset($_SESSION['customer_email'])){
                                            echo "<a href='../checkout.php'> Login</a>";
                                        }
                                        else{
                                            echo "<a href='../function/logout.php'> Logout </a>"; 
                                        }

                                    ?>
                        
                        
                        </span>  
                    </div>
                     
                    <div id="products_box">
                       
                     <?php 
                     if(!isset($_GET['my_orders'])){
                         if(!isset($_GET['edit_account'])){
                             if(!isset($_GET['change_password'])){
                                 if(!isset($_GET['delete_account'])){
                                     echo "<h2>". "Welcome:". $_SESSION['firstname'] ."</h2>";
                                     echo "<b> You can see your order by clicking this <a href='myaccount.php?my_orders'> Link </a>";
                                 }
                             }
                         }
                         
                     }
                     
                     
                     ?>
                        
                     <?php
                     if(isset($_GET['edit_account'])){
                         include 'edit_account.php'; 
                     }
                     if(isset($_GET['change_password'])){
                         include 'changepassword.php' ; 
                     }
                     if(isset($_GET['delete_account'])){
                         include 'delete.php';
                     }
                     ?>
                    </div>
                    
                </div> 
              <div id="sidebar">
                  <div id="sidebar_title">My Account:</div>
                  
                  <ul id="cats">
                      <li>
                      <?php
                 
                      global $mysqli; 
                            $user = $_SESSION['customer_email'];

                            $get_img =  "SELECT *FROM customers where customer_email='$user'"; 
                            $run_query = $mysqli ->query($get_img); 
                            $row = $run_query->fetch_assoc();
                            $c_image = $row['customer_image']; 
 
                            echo "<img src='user_picture/$c_image' width='150' height='150'";
                            
                         
                      ?>
                      </li>
                      <li> <a href="myaccount.php?my_orders"> My Orders</a></li>
                      <li ><a href="myaccount.php?edit_account">Edit Account</a></li>
                      <li> <a href="myaccount.php?change_password">Change password</a></li>
                      <li ><a href="myaccount.php?delete_account">Delete Account</a></li>
                  </ul>
                  
 
              </div>
             
            </div>
            
            <div id="footer">
                
                <p>&copy; 2017 Mulugeta Forsido<p>
            </div>
        
        </div>
    </<body>
</html>