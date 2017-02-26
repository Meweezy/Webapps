<?php

    session_start();
    
    if($_SESSION['email']){
        
        echo "<p>You are logged in! Welcome to your session</p>";
    } else {
        
        header("Location: index.php");
    }

?>