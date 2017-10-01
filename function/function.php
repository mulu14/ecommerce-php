<?php
$dbServer = "localhost";    // make connection to server
 $dbUser = "root";  // user name 
 $dbPass =  "uppsala12345"; // password
 $dbName = "ecommerce";  // database 
 $mysqli = new mysqli($dbServer, $dbUser, $dbPass, $dbName); 

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
 // add user purchasing in the cart
 function cart(){
     if(isset($_GET['add_cart'])){
         global $mysqli;
         $ip = getIp();
         $pro_id = $_GET['add_cart'];
         $check_pro ="select *from cart where ip_add='$ip' AND p_id='$pro_id'"; 
         $result = $mysqli ->query($check_pro);
         $row_cnt = $result ->num_rows; 
          if($row_cnt > 0){
            echo '';  
          }
          else{
              $query = $mysqli ->query("INSERT INTO cart(p_id, ip_add) values('$pro_id', '$ip')");
              if($query == TRUE){
                  echo 'I am here';
                  // header('location:../ecommerce/search.php'); 
              }
              else{
                  echo $mysqli -> error;
              }
            
          }
         
     }
 }
 
// getting the totla added item
 
function total_item(){
    global  $mysqli;
    if(isset($_GET['add_cart'])){
        
        $ip = getIp(); 
        $get_item = "select *from cart where ip_add='$ip'";
        $result = $mysqli ->query($get_item);
        $row_cnt = $result ->num_rows;   
    }
    else{
        $ip = getIp(); 
        $get_item = "select *from cart where ip_add='$ip'";
        $result = $mysqli ->query($get_item);
        $row_cnt = $result ->num_rows;   
    }
    echo $row_cnt; 

    
}
// gett the total price of the items in the cart

function total_price(){
    global $mysqli; 
    $totalprice = 0; 
    $ip = getIp();
    $sel_price = "select *from cart where ip_add='$ip'";
    $result = $mysqli->query($sel_price);
     while($row = $result->fetch_assoc()){
         $p_id = $row['p_id'];
         $find_price = "select *from products where product_id='$p_id'"; 
         $output = $mysqli->query($find_price); 
         while($priceList = $output->fetch_assoc()){
             $product_price = array($priceList['product_price']);
             $values = array_sum($product_price); 
             $totalprice += $values; 
         }
     }
     echo '$'. $totalprice;
}


    
function getCats(){
    global $mysqli;
    $get_cats ="select *from catagories"; 
    $result = $mysqli ->query($get_cats);
    while($row= $result->fetch_assoc()){
       $catId = $row['cat_id'];
       $cat_title = $row['cat_title'];
       echo "<li> <a href='index.php? cat=$catId'>$cat_title</li>";
        
     }
    
}
function getBrands(){
    global $mysqli;
    $get_cats ="select *from brand"; 
    $result = $mysqli ->query($get_cats);
    while($row= $result->fetch_assoc()){
       
       $brand_title = $row['brand_title'];
       $brandId = $row['brand_id'];
       echo "<li> <a href='index.php?brand=$brandId'>$brand_title</li>";
       
     }
}
     
   function getProd(){
       if(!isset($_GET['cat'])){
           if(!isset($_GET['brand'])){
                global $mysqli; 
                $get_pro = "SELECT * FROM products order by RAND () LIMIT 0,6"; 
                $result = $mysqli ->query($get_pro);
                while($row= $result->fetch_assoc()){


                $pro_id = $row['product_id'];
                $pro_cat = $row['product_cat'];
                $pro_brand = $row['product_brand'];
                $pro_title = $row['product_title'];
                $pro_price = $row['product_price'];
                $pro_des = $row['product_desc'];
                $pro_image = $row['product_image'];
                $pro_key = $row['product_keywords'];


                echo "
                        <div id='single_product'>
                        <h3>$pro_title </h3>
                        <img src='function/product_images/$pro_image' width='180' height='180'/>
                        <p><b> Price $ $pro_price</b></p>
                        <a  href='details.php?pro_id=$pro_id' style='float:left;'> Details </a>
                        <a href='index.php?add_cart=$pro_id'><button style='float: right;' > Add to Cart </button></a>

                        </div>
                        ";
               
     }
       
       }
       } 
       
   }
    
      
   function getProd_cat(){
       
       if(isset($_GET['cat'])){
          $cat_id = $_GET['cat'];
                 global $mysqli; 
                $get_cat_pro = "SELECT * FROM products where product_cat ='$cat_id'"; 
                $result = $mysqli ->query($get_cat_pro);
                $row_cnt = $result ->num_rows; 
                if($row_cnt == 0){
                    echo "<h2> There is no item in this category</h2>";
                  
                }
               
                while($row= $result->fetch_assoc()){
                $pro_id = $row['product_id'];
                $pro_cat = $row['product_cat'];
                $pro_brand = $row['product_brand'];
                $pro_title = $row['product_title'];
                $pro_price = $row['product_price'];
                $pro_des = $row['product_desc'];
                $pro_image = $row['product_image'];
                $pro_key = $row['product_keywords'];


                echo "
                        <div id='single_product'>
                        <h3>$pro_title </h3>
                        <img src='function/product_images/$pro_image' width='180' height='180'/>
                        <p><b>$ $pro_price</b></p>
                        <a  href='details.php?pro_id=$pro_id' style='float:left;'> Details </a>
                        <a href='index.php?pro_id=$pro_id'><button style='float: right;' > Add to Cart </button></a>

                        </div>
                        ";
               
     }
       
       }
       } 
     
        function getProd_Brand(){
       
       if(isset($_GET['brand'])){
          $brand_id = $_GET['brand'];
                 global $mysqli; 
                $get_brand_pro = "SELECT * FROM products where product_brand ='$brand_id'"; 
                $result = $mysqli ->query($get_brand_pro);
                $row_cnt = $result ->num_rows; 
                if($row_cnt == 0){
                    echo "<h2> There is no product assocated with this brand</h2>";
                  
                }
               
                while($row= $result->fetch_assoc()){
                $pro_id = $row['product_id'];
                $pro_cat = $row['product_cat'];
                $pro_brand = $row['product_brand'];
                $pro_title = $row['product_title'];
                $pro_price = $row['product_price'];
                $pro_des = $row['product_desc'];
                $pro_image = $row['product_image'];
                $pro_key = $row['product_keywords'];


                echo "
                        <div id='single_product'>
                        <h3>$pro_title </h3>
                        <img src='function/product_images/$pro_image' width='180' height='180'/>
                        <p><b>$ $pro_price</b></p>
                        <a  href='details.php?pro_id=$pro_id' style='float:left;'> Details </a>
                        <a href='index.php?pro_id=$pro_id'><button style='float: right;' > Add to Cart </button></a>

                        </div>
                        ";
               
     }
       
       }
       } 
       
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

    
  
  