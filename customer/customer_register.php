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
                    <a href="index.php" <img  id="logo" src="../image/sunrise.jpg"></a>
                    <img  id="banner" src="../image/sunset.jpg">
               </div>
                <!--  menu  -->
                <div class="menubar">
                    <ul id="menu">
                        <li><a href="../index.php">Home</a></li>
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
                    <form action="customer_register.php" method="post" enctype="multipart/form-data">
                        <table align="center" width="750">
                            
                            <tr>
                                <td align="centre"><h2> Create an Account </h2></td>
                            </tr>
                            <tr>
                                <td align="right">Customer Name</td>
                                <td><input type="text" name="c_name" required></td>
                            </tr>
                            <tr>
                                <td align="right">Customer Email</td>
                                <td><input type="email" name="c_email"required></td>
                            </tr>
                            <tr>
                                <td align="right"> Customer password</td>
                                <td><input type="password" name="c_password" required></td>
                            </tr>
                             <tr>
                                <td align="right"> Customer Image</td>
                                <td><input type="file" name="c_image"></td>
                            </tr>
                            <tr>
                                <td align="right">Customer Country</td>
                                <td>
                                    <select name="c_country">
                                        <option>Afghanistan</option>  
                                        <option>England</option> 
                                        <option>Finland</option>
                                        <option>Norway</option>  
                                        <option>Sweden</option>
                                        <option> USA </option>
                                         
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">Customer city</td>
                                <td><input type="text" name="c_city"required></td>
                            </tr>
                            <tr>
                                <td align="right">Customer Contact</td>
                                <td><input type="text" name="c_contact"required=""></td>
                            </tr>
                            <tr>
                                <td align="right">Customer Address</td>
                                <td><textarea cols="20" rows="10" name="c_address"> </textarea></td>
                            </tr>
                            
                             <tr align="center">
                              
                                 <td colspan="6"><input type="submit" name="register" value="create account"></td>
                            </tr>
                        </table>
                        
                    </form>
                    
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
<?php

if(isset($_POST['register'])){
    
    $ip = getIp();   
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_password = $_POST['c_password'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_temp =$_FILES['c_image']['tmp_name'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];
    
    move_uploaded_file($c_image_temp, "user_picture/$c_image");
    $insert_customer = "insert into customers (customer_ip, customer_name, customer_pass, customer_email, customer_country,"
            . " customer_city, customer_contact, customer_image, customer_address)"
            . " values('$ip', '$c_name', '$c_email', '$c_password', '$c_country', '$c_city', '$c_contact', '$c_image', '$c_address')";
    
    $post_customer = $mysqli->query($insert_customer); 
    
    $select_cart = "select *from cart where ip_add='$ip'";
    $run_cart = $mysqli->query($select_cart);
    $count_row  = $run_cart -> num_rows;
    if($count_row == 0){
      $_SESSION['customer_email'] = $c_email;
      //echo "<script> alert('Resisteration sucessful Thanks!') </script>";  
      header('location:myaccount.php');
     
    }
    
     else{
      $_SESSION['customer_email'] = $c_email; 
      echo "<script> alert('Resisteration sucessful Thanks!') </script>";  
       header('location: ../checkout.php');
      }
    
     
}



?>