<?php










   $link = mysqli_connect("localhost", "cl57-users-rha", "m!jwkx3Nw", "cl57-users-rha");
    
        if (mysqli_connect_error()){
        
        die( "Could not connect to Database. ");
        
    } 

    //$query = "INSERT INTO `users` (`email`,`password`) VALUES ('jibran@jibranbolaji.com', 'ilovemydad')";

    //$query = "UPDATE `users` SET email='muizzbolaji@aol.com' WHERE id = 1 LIMIT 1";
    //$query = "UPDATE `users` SET password='123§sdadaA' WHERE email = 'muizzbolaji@aol.com' LIMIT 1";

   // mysqli_query($link, $query);

   /* $name = "Rob O'Grady";

    $query = "SELECT `email` FROM `users` WHERE `name` = '".mysqli_real_escape_string($link, $name)."'";

    if ($result = mysqli_query($link, $query)){
        
        while($row = mysqli_fetch_array($result)){
            
            print_r($row);
        }
        
        
    }*/
    $newUser = false;
    $email =$_POST['email'];
    $password = $_POST['password'];
   
    if (array_key_exists('email', $_POST) OR array_key_exists('email', $_POST)) {
        
        if (empty($_POST['email'])){
            
           echo "<p>An email address is required</p>";
            
        } else if (empty($_POST['password'])) {
            
            echo "<p>Your passwrd is required</p>";
            
       
        } else {
            
            $query = "SELECT `id` FROM `users` WHERE email = '".mysqli_real_escape_string($link, $email)."'";
            
            $result = mysqli_query($link, $query);
            
            if(mysqli_num_rows($result) > 0){
                
                echo "<p>That email address has already been taken.</p>";
            } else {
                
                $query = "INSERT INTO `users` (`email`,`password`) VALUES ('".mysqli_real_escape_string($link, $email)."','".mysqli_real_escape_string($link, $password)."')";
                
                $result = mysqli_query($link, $query);
                
                if ($result){
                    
                    echo "User Signed up!";
                } else {
                    
                    echo "User could not be signed up. Please try again later";
                    
                }
            }
            
            
        }
}
    
?>


<html>

    <head>
    
    </head>



    <body>
    
        <div>
            <form method="post">
                
                <label for="email">Email: </label>
                <input type="email" id="email" placeholder="Enter your email address" name="email" ><br><br>
                
                <label for="password">Password: </label>
                 <input type="password" id="password" name= "password" ><br><br>

                <input type="submit" value="Sign up!">
            </form>
        </div>
    
    
    
    
    
    
    
    </body>

</html>