<?php

//session_start();

$link = mysqli_connect("localhost", "cl57-users-rha", "m!jwkx3Nw", "cl57-users-rha");

    if(mysqli_connect_error()) {
        
        die("Could not connect to database");
    }

//Signup form
if (array_key_exists('emailSU', $_POST) OR array_key_exists('passwordSU', $_POST)){
    
    $error = "";
    
    if(empty($_POST['emailSU'])){
        
       $error.= "<p>An email address is required.</p>";
        
    } else if (empty($_POST['passwordSU'])){
        
        $error.= "<p>A Password is required.</p>";
    } 
    
    else{
        //Sign up new user
        //check that user does not already exist
       
        $query = "SELECT `email` FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['emailSU'])."'";
        
        $result = mysqli_query($link, $query);
        
        if(mysqli_num_rows($result) > 0){
            
            echo "<p>That email address is already taken.</p>";
            
        } else {
            
            //hashing password
            $hash = password_hash ($_POST['passwordSU'], PASSWORD_DEFAULT);
            
            //inserting new user into database
            $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['emailSU'])."', '".mysqli_real_escape_string($link, $hash)."')";
            
            if(mysqli_query($link, $query)){
                
                //$_SESSION['email'] = $_POST['emailSU'];
                
                header("Location: session.php");
            }
        }
    }
    
    if($error){
        
        $error= "<p>The following error(s) occurred on your form:</p>".$error;
    }
}

//Login form
if (array_key_exists('emailLogin', $_POST) OR array_key_exists('passwordLogin', $_POST)){
    
    $error = "";
    
    if(empty($_POST['emailLogin'])){
        
       $error.= "<p>Your email address is required.</p>";
        
    } else if (empty($_POST['passwordLogin'])){
        
        $error.= "<p>Your password is required.</p>";
    } 
    
    else{
        
        $hash = password_hash ($_POST['passwordLogin'], PASSWORD_DEFAULT);
        
        $query = "SELECT * FROM `users` WHERE email='".mysqli_real_escape_string($link, $_POST['emailLogin'])."'";
        
        $result = mysqli_query($link, $query);
        $row = mysqli_fetch_row($result);
        
        
        //verify your password
        if (mysqli_num_rows($result) > 0 && password_verify($_POST['passwordLogin'], $row[2])){
            
           //$_SESSION['email'] = $_POST['emailLogin'];
            
            header("Location: session.php");
        }
        
               
        //echo "Logged in!";
    }
    
    if($error){
        
       $error= "<p>The following error(s) occurred on your form:</p>".$error;
    }
}


?>



<html>

<head>
    
</head>

    
<body>
    
    <div id="error"><?php echo $error;?></div>
   <form method="post" id="signUp">
    
        <input type="email" name="emailSU" placeholder="Enter your email">
    
        <input type="password" name="passwordSU"  placeholder="Password">
       
        <input type="checkbox" name="stayLoggedIn" value=1> 
       
        <input type="submit" value="Sign Up">
    
    </form> 
    
    <form method="post" id="login">
    
        <input type="email" name="emailLogin" placeholder="Enter your email">
    
        <input type="password" name="passwordLogin"  placeholder="Password">
        
        <input type="checkbox" name="stayLoggedIn" value=1> 
       
        <input type="submit" value="Log in">
    
    </form> 
    
    
    
</body>



</html>