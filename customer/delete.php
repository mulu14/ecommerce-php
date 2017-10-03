<?php
include '../connect/connect.php'; 
?>
<h2> Do you like to delete your account?  </h2>
<form method="post">
        <input  type="submit" name="deleteaccount" value="Yes, delete account" >
        <input  type="submit" name="no_delete" value="No, i don't want delete account" >
    
</form>
<?php



if(isset($_POST['deleteaccount'])){
    $user = $_SESSION['customer_email'];
   
     $deleteaccount = "delete from customers where customer_email='$user'"; 
     $run_delete = $mysqli-> query($deleteaccount);
     if($run_delete){
           echo "<script> alert('Your account has been deleted!') </script>";
           header('Location: myaccount.php');
     }


    
}

if(isset($_POST['no_delete'])){
    echo "<script> alert('Your account is not deleted!') </script>"; 
    header('Location: myaccount.php');
}




?>

