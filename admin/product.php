<!DOCTYPE>
<?php 
include '../connect/connect.php';

?>
<html>
    
    <head>
        <title> Insert product</title>
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
         <script>tinymce.init({ selector:'textarea' });</script>
</head>
    </head>
    
    <body>
        <form action="../function/post.php" method="post" enctype="multipart/form-data">
            <table align="center" width="1000" border="2" bgcolor="blue" >
                <tr align="center">
                    <td colspan="8"><h2>Insert New Post here</h2></td>
                </tr>
                <tr>
                    <td align="right"><b>Product title: </b> </td>
                    <td><input type="text" name="product_title" required ></td>
                </tr>
                <tr>
                    <td align="right"> <b>Product Category: </b></td>
                    <td>
                        <select name="product_cat">
                            <option>Select a Category</option>
                            <?php 
                            $get_cats ="select *from catagories"; 
                             $result = $mysqli ->query($get_cats);
                             while($row= $result->fetch_assoc()){
                             $catId = $row['cat_id'];
                             $cat_title = $row['cat_title'];
                            echo "<option value='$catId'> <a href='#'>$cat_title</option>";
                                             //echo "<li> <a href='#'>$catId</li>";
                              }

                            ?>
                        </select>
                    
                    </td>
                </tr>
                <tr>
                    <td align="right"> <b>Product Brand: </b></td>
                    <td >
                        <select name="product_brand">
                            <option >Select a Brand</option>
                                <?php
                               $get_cats ="select *from brand"; 
                                $result = $mysqli ->query($get_cats);
                                while($row= $result->fetch_assoc()){

                                   $brand_title = $row['brand_title'];
                                   $brand_id =  $row['brand_id'];
                                   echo "<option value='$brand_id'> <a href='#'>$brand_title</option>";
                                    //echo "<li> <a href='#'>$catId</li>";
                                 }  
                                
                                ?>
                          
                        </select>
                        
                    </td>
                </tr>
                 <tr >
                    <td align="right"><b>Product price: </b></td>
                    <td><input type="number" name="product_price" required></td>
                </tr>
                <tr >
                    <td align="right"><b>Product Image: </b></td>
                    <td><input type="file" name="product_image"></td>
                </tr>
               
                <tr >
                    <td align="right"><b>Product description: </b></td>
                    <td><textarea name="product_desc" cols="20" rows="10"></textarea></td>
                </tr>
                <tr >
                    <td align="right"><b>Product Key: </b></td>
                    <td><input type="text" name="product_key" required></td>
                </tr>
                 <tr align="center">
                   
                     <td colspan="8"><input type="submit" name="submit" value="Insert now"></td>
                </tr>
                
            </table>
             
        </form>
    </body>
</html>

