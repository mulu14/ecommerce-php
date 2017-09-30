<?php
include '../connect/connect.php';
?>

<?php
if(isset($_POST['submit'])){
    //get user input
   
    $product_cat = $_POST['product_cat'];
    $product_brand = $_POST['product_brand'];
    $product_title = $_POST['product_title'];
    $product_price = $_POST['product_price'];
    $product_desc = $_POST['product_desc'];
    $product_key =  $_POST['product_key'];
    
    //get image from 
     $product_image = $_FILES['product_image']['name'];
     $product_image_temp = $_FILES['product_image']['tmp_name'];
     move_uploaded_file($product_image_temp, "product_images/$product_image");
     
     
    $query = $mysqli ->query("INSERT INTO products (product_cat, product_brand, product_title, product_price, product_desc, product_image, product_keywords )"
            . " VALUES('$product_cat','$product_brand','$product_title', '$product_price', '$product_desc', '$product_image','$product_key')"); 
     
      if($query == TRUE){ 
                echo "New record created successfully"; // echo uplod success
                header('../function/product.php'); 
                
                
            }
            else { 
               echo $mysqli -> error; // save error in session variable
            }

     
     
}


?>
