<?php

    $link = mysqli_connect("localhost", "cl57-users-rha", "m!jwkx3Nw", "cl57-users-rha");

    if(mysqli_connect_error()) {
        
        die("The connection could not be established");
    }

    if (array_key_exists('email', $_POST) OR array_key_exists('password', $_POST)){
        
        if (empty($_POST['email'])){
            
            echo "<p>Your email address is required.</p>";
            
        } else if (empty($_POST['password'])){
            
            echo "<p>Your password is required</p>";
            
        } else {
            
            $query = "SELECT `email` FROM `users` WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."'";
            
            $result = mysqli_query($link,$query);
            
            if(mysqli_num_rows($result) > 0){
                
                echo "<p>This user is already taken.</p>";
                
            } else {
               
                $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($_POST['email'])."', '".mysqli_real_escape_string($_POST['password'])."')";
                
                if(mysqli_query($link, $query)) {
                    
                    echo "<p>You are signed up</p>";
                    
                } else {
                    
                    echo "<p>Unable to sign you up. Please try again later.</p>";
                }
                
            }
        }
        
    }


?>


<html>


<head></head>
    
<body>
    
    
    <form method="post">
    
        <input type="email" name="email" placeholder="Enter your email">
        
        <input type="password" name="password" placeholder="Password">
        
        <input type="submit" value="Sign Up">
    
    
    </form>
    
    
    
    
</body>






</html>