<?php
include '../connect/connect.php'; 
?>

<form method="post">
    <table>
        <tr> 
        <td> Enter current password </td>
        <td><input type="password" name="currentpassword"required=""></td> 
        </tr>
        <tr> 
            <td>Enter new password </td>
            <td><input type="password" name="newpassword" required=""> </td>
        </tr>
        <tr>
            <td>Confirm password </td>
            <td><input type="password" name="confirmpassword"required=""></td> 
        </tr>
        <tr align="center"> <td colspan="30"><input  type="submit" name="change_pass" value="changePassword" ></td></tr>
    </table>
</form>
<?php



if(isset($_POST['change_pass'])){
    $user = $_SESSION['customer_email'];
    $current_pass = $_POST['currentpassword'];
    $newpassword = $_POST['newpassword']; 
    $confirmpassword = $_POST['confirmpassword'];
    
     $select_pass = "SELECT *FROM customers  where customer_pass ='$current_pass'";
     
     $runn_query = $mysqli ->query($select_pass); 
     
     if($runn_query->num_rows == 0){
         echo "<script> alert('Your current password is wrong') </script>";
         exit();
     }
     
     if($newpassword != $confirmpassword){
          echo "<script> alert('Password does not match') </script>";
          exit();
     }
     else{
         $updatePass = "update customers set customer_pass ='$newpassword' where customer_email='$user'"; 
         $runUpdate = $mysqli-> query($updatePass);
         if($runUpdate){
               echo "<script> alert('Your password is updated!') </script>";
               header('Location: myaccount.php');
         }
     }
    
    
}




?>