<?php
include '../connect/connect.php'
?>
    <?php
    global $mysqli; 
    $user = $_SESSION['customer_email'];
    $get_img =  "SELECT *FROM customers where customer_email='$user'"; 
    $run_query = $mysqli ->query($get_img); 
    $row = $run_query->fetch_assoc();
     $customer_id = $row['customer_id'];
     $customername = $row['customer_name'];
     $customeremail = $row['customer_email'];
     $customerpass = $row['customer_pass'];
     $customercountry = $row['customer_country'];
     $customercity = $row['customer_city'];
     $customercontact = $row['customer_contact'];
     $customerimage = $row['customer_image'];
     $customeraddress = $row['customer_address'];

    
     
    ?>


<form action="" method="post" enctype="multipart/form-data">
                        <table align="center" width="750">
                            
                            <tr>
                                <td align="centre"><h2> Create an Account </h2></td>
                            </tr>
                            <tr>
                                <td align="right">Customer Name</td>
                                <td><input type="text" name="c_name" value="<?php  echo $customername;?>" required></td>
                            </tr>
                            <tr>
                                <td align="right">Customer Email</td>
                                <td><input type="email" name="c_email" value="<?php  echo $customeremail;?>"required></td>
                            </tr>
                            <tr>
                                <td align="right">  Customer password</td>
                                <td><input type="password" name="c_password" value="<?php  echo $customerpass;?>"required></td>
                            </tr>
                             <tr>
                                <td align="right"> Customer Image</td>
                                <td><input type="file" name="c_image" <img src="user_picture/<?php  echo $customerimage;?>" width="150" height="150"></td>
                            </tr>
                            <tr>
                                <td align="right">Customer Country</td>
                                <td>
                                        <select name="c_country" disabled>
                                        <option> <?php echo $customercountry?> </option>
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
                                <td><input type="text" name="c_city" required value="<?php  echo $customercity;?>" ></td>
                            </tr>
                            <tr>
                                <td align="right">Customer Contact</td>
                                <td><input type="text" name="c_contact"required value="<?php  echo $customercontact;?>"></td>
                            </tr>
                            <tr>
                                <td align="right">Customer Address</td>
                                <td><input  type="text" name="c_address" value="<?php  echo $customeraddress;?>"></td>
                            </tr>
                            
                             <tr align="center">
                              
                                 <td colspan="6"><input type="submit" name="register" value="Update Account"></td>
                            </tr>
                        </table>
                        
                    </form>
              
<?php

if(isset($_POST['register'])){
    
    $c_id = $customer_id;
    $ip = getIp();   
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_password = $_POST['c_password'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_temp =$_FILES['c_image']['tmp_name'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];
    
    move_uploaded_file($c_image_temp, "user_picture/$c_image");
    $update_customer = "update customers set customer_name ='$c_name', customer_email='$c_email', customer_pass='$c_password',"
            . " customer_city ='$c_city', customer_contact='$c_contact', customer_image='$c_image', customer_address='$c_address' where customer_id='$c_id'";
      
    
    $edit_customer = $mysqli->query($update_customer); 
 
    if($edit_customer){
     echo "<script> alert('Your account update!') </script>";  
     header('Location: myaccount.php'); 
    
    }
    
     else{
     
      echo $edit_customer ->error;  
       header('Location: myaccount.php');
      }
    
     
}



?>