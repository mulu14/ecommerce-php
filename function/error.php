<?php
session_start(); // start session 
?>
 <!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="error">
        <?php
        /** echo any session variable 
         * 
         * 
         */
        if(isset($_SESSION['error']) AND !empty($_SESSION['error'])){
            echo $_SESSION['error'];
        }
        else{
            header('location: ../index.php'); // direct to index page
            }
        
        ?>
            <p><a href="../index.php"><button >Click here to go back to Home page</button></a></p>
        </div>   
    
    
           
    </body>
</html>
         



