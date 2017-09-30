<?php
session_start();  //start session 
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
        /** echo success session value 
         * 
         * 
         * 
         */
        if(isset($_SESSION['sucess']) AND !empty($_SESSION['sucess'])){
            echo $_SESSION['sucess'];
        }
        else{
            header('location: ../index.php'); // direct to index page
            }
        
        ?>
            <p><a href="../otherFile/blogg.php"><button >Click here to go back to Post Page</button></a></p>
        </div>   
    
    
           
    </body>
</html>
         



