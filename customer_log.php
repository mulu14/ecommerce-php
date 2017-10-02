<!DOCTYPE >
<?php

include 'connect/connect.php';
session_start(); 

?>


<html>
    
    <head>
        
    </head>
    
    <body>
        <div>
            <form method="post" action="">
                <table width="500" align="center" bgcolor="skyblue">
                    <tr align="center">
                        <td colspan="4"><h2>Login or Register to buy</h2></td>
                    </tr>
                    
               
                <tr>
                    <td align="right"><b>Email: </b></td>
                    <td><input type="text" name="email" placeholder="enter email"required=""></td>
                </tr>
                <tr>
                    <td align="right"><b>Password: </b></td>
                    <td><input type="password" name="pass" placeholder="enter password" required=""></td>
                </tr>
                <tr align="center">
                    <td colspan="3"><a href="checkout.php?forgot_pass"><b> Forgot Password</b></a></td>
                </tr>
                <tr align="center">
                    <td colspan="4" ><input type="submit" name="login" value="Login"></td>
                </tr>
               </table>
                <h2 style="float: left; padding:5px;"><a href="customer/customer_register.php" style="text-decoration:none;"> Register here</a></h2>
            </form>
        </div>
        
    </body>
</html>
<?php
if(isset($_POST['login'])){
    global $mysqli; 
    $c_email = $_POST['email']; 
    $c_pass = $_POST['pass'];
    
    $select_from_customer = "SELECT * FROM customers where customer_email='$c_email' AND customer_pass='$c_pass' ";
    
    $check_customer = $mysqli ->query($select_from_customer); 
    while($row = $check_customer -> fetch_assoc()){
        $_SESSION['firstname'] = $row['customer_name']; 
        
    }
   
    if( $check_customer -> num_rows == 0){
        echo "<script> alert('email or password incorrect, please try again') </script>";
    }
    else{
        $ip = getIp(); 
        $select_cart = "select *from cart where ip_add='$ip'";
        $run_cart = $mysqli->query($select_cart);
        $count_row  = $run_cart -> num_rows;
        if($check_customer -> num_rows > 0 AND $count_row == 0){
            $_SESSION['customer_email'] = $c_email;
            echo "<script> 'You logged in sucessful, Thanks!' </script>"; 
             header('Location: customer/myaccount.php'); 
           
        }
        else{
            $_SESSION['customer_email'] = $c_email;
            echo "<script> 'You logged in sucessful, Thanks!' </script>"; 
           
            header('Location: checkout.php');
            
        }
    }
}



?>
