
    <?php
    $user = $_SESSION['customer_email'];
    $get_img =  "SELECT *FROM customers where customer_email='$user'"; 
    $run_query = $mysqli ->query($get_img); 
    $row = $run_query->fetch_assoc();

    
    ?>


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
    $insert_customer = "insert into customers (customer_ip, customer_name, customer_email, customer_pass, customer_country,"
            . " customer_city, customer_contact, customer_image, customer_address)"
            . " values('$ip', '$c_name', '$c_email', '$c_password', '$c_country', '$c_city', '$c_contact', '$c_image', '$c_address')";
    
    $post_customer = $mysqli->query($insert_customer); 
    
    $select_cart = "select *from cart where ip_add='$ip'";
    $run_cart = $mysqli->query($select_cart);
    $count_row  = $run_cart -> num_rows;
    if($count_row == 0){
      $_SESSION['customer_email'] = $c_email;
      //echo "<script> alert('Resisteration sucessful Thanks!') </script>";  
      header('Location: myaccount.php');
     
    }
    
     else{
      $_SESSION['customer_email'] = $c_email; 
      echo "<script> alert('Resisteration sucessful Thanks!') </script>";  
       header('Location: ../checkout.php');
      }
    
     
}



?>