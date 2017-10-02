<!DOCTYPE >
<?php 
include 'function/function.php';
session_start(); 
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
                        <span>Welcome to page! <b style="color:red"> Shopping Cart </b>Total Items:<?php total_item()?> Total Price:<?php total_price()?>  </b><a href="index.php">Back to shop</a>
                        
                             <?php 
                            if(!isset($_SESSION['customer_email'])){
                                echo "<a href='checkout.php'> Login</a>";
                            }
                            else{
                                echo "<a href='function/logout.php'> Logout </a>"; 
                            }

                        ?>
                        </span>  
                    </div>
                    <div id="products_box">
                        <form action="" method="post" enctype="multipart/form-data">
                            <table align="center" width="700" bgcolor="skyblue">
                                <tr align="center">
                                    <th>Remove</th>
                                     <th>Product(s)</th>
                                     <th>Quantity</th>
                                     <th>Total Price</th>
                                    
                                </tr>
                           <?php
                            global $mysqli; 
                            $totalprice = 0; 
                            $ip = getIp();
                            $find_p_id = "select *from cart where ip_add='$ip'";
                            $result = $mysqli->query($find_p_id);
                             while($row = $result->fetch_assoc()){
                                 $p_id = $row['p_id'];
                                 $return_pr = "select *from products where product_id='$p_id'"; 
                                 $output = $mysqli->query($return_pr); 
                                 while($productList = $output->fetch_assoc()){
                                     $product_price = array($productList['product_price']);
                                     $product_title = $productList['product_title'];
                                     $product_image = $productList['product_image'];
                                     $single_price = $productList['product_price'];
                                     $values = array_sum($product_price); 
                                     $totalprice += $values; 
                             
                               ?>
                                <tr align="center">
                                    <td><input type="checkbox" name="remove[]" value="<?php echo $p_id;?>"></td>
                                    <td ><?php echo $product_title;?><br>
                                        <img src="function/product_images/<?php echo $product_image;?>" width="60" height="60"> 
                                    </td>
                                    <td><input type="number" size="4" name="qty" value="<?php echo $_SESSION['qty']; ?>"></td>
                                    <?php 
                                    global $mysqli; 
                                    if(isset($_POST['update_cart'])){
                                        $qty = $_POST['qty'];
                                        $update_qunt = "update cart set qty='$qty'"; 
                                        $run_update = $mysqli ->query($update_qunt); 
                                        if($run_update == TRUE){
                                            echo 'Success';
                                            $_SESSION['qty'] = $qty; 
                                        }
                                        else{
                                            $mysqli -> error;
                                        } 
                                        $totalprice = $totalprice*$qty; 
                                    }
                                    
                                    ?>
                                    
                                    
                                  
                                     <td><?php echo '$' . $single_price ?></td>
                                </tr>
                               
                             <?php }}?>
                                 <tr align="right">
                                     <td colspan="4">Sub Total</td>
                                     <td colspan="4"><?php echo  '$'. $totalprice?></td>
                                </tr>
                                <tr align="center">
                                    <td colspan="2">
                                        
                                            <input type="submit" name="update_cart" value="Update Cart"> 
                                       </td>
                                    <td colspan="1"><input type="submit" name="continue" value="Continue Shopping"></td>
                                    <td id="idlink"><a href="checkout.php"><button>Checkout</a></button></td>
                                </tr>
                            </table>
                            
                        </form>
                     
                    </div>
                    
                        
             <?php 
             
             function updatecart(){
                global $mysqli; 
                 $ip = getIp(); 
                if(isset($_POST['update_cart'])){
                   foreach($_POST['remove'] as $remove_id){ 
                     $delte_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
                     $run_delete = $mysqli-> query($delte_product); 
                     if($run_delete == TRUE){
                         echo "<script>window.open('cart.php', '_self')</script>";
                     }
                     else {
                         echo $mysqli -> error; 
                     }
                   } 
                }
                
                if(isset($_POST['continue'])){
                    echo "<script>window.open('index.php', '_self')</script>";
                }
               echo @$up_cart = updatecart();  //      
             }            
                    
    ?>
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