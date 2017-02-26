<?php
    
    session_start();
    
    $error = "";

    //Logout user
    if (array_key_exists("logout", $_GET)){
        
        unset($_SESSION);
        
        setcookie("id","", time() - 60*60);
        
        $_COOKIE['id'] = "";
        
    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_SESSION['id'])){
        
        header("Location: loggedinpage.php");
    }

    

    if(array_key_exists("submit", $_POST)){
        
       include("connection.php");
        
        
        //user validation
        if(empty($_POST['email'])){
            
            $error.= "<p>An email address is required.</p>";
            
        } 
        
        if(empty($_POST['password'])){
            
            $error.= "<p>A password is required.</p>";
            
        } 
        
        if ($error != "") {
            
            $error = "<p>There following error(s) occured in your form:</p>".$error;
            
        } else {
            
            //signup new user
            
            if ($_POST['signUp'] == '1'){
            
            $query = "SELECT id FROM `users` WHERE email ='".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            
            $result = mysqli_query($link, $query);
            
            if (mysqli_num_rows($result) > 0){
                
                $error = "This user already exists";
                
            }  else {
                
                $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                
                $query = "INSERT INTO `users` (`email`,`password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $hash)."')";
                
                if(!mysqli_query($link, $query)) {
                    
                    $error ="<p>Could not sign you up. Please try again later.</p>";
                    
                } else {
                    
                    //set user session and cookies for user
                    $_SESSION['id'] = mysqli_insert_id($link);
                    
                    if($_POST['stayLoggedIn'] == '1') {
                        
                        setcookie("id", mysqli_insert_id($link), time() + 3600*24*365);
                    }
                    
                        //echo "Sign up successful!";

                        header("Location: loggedinpage.php");
                    }
                
        
                } 
            } else {
                
                //Login existing user
                $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
                
                $result = mysqli_query($link, $query);
                
                $row = mysqli_fetch_array($result);
                
                //print_r($row);
                
                if (password_verify($_POST['password'], $row['password'])){
                    
                         $_SESSION['id'] = mysqli_insert_id($link);
                    
                    if($_POST['stayLoggedIn'] == '1') {
                        
                        setcookie("id", $row['id'], time() + 3600*24*365);
                    }
                    
                        //echo "Sign up successful!";

                        header("Location: loggedinpage.php");
                    
                } else {
                    
                    $error = "<p>Password Incorrect. Please enter the correct password.</p>";
                }
                
                //print_r($_POST);
            }
        }
        
}

?>


    <?php include ("header.php"); ?>

    <div class="container">
        <h1>Secret Diary</h1> <br>
        <p><strong>Store you thoughts permanently and securely.</strong></p>
      
        <div id="error"><?php echo $error ; ?></div>
      

        <form method="post" id="signupForm">
            <p>Interested? Sign Up now!</p>
            <div class="form-group">
                
                <input class="form-control" type="email" name="email" placeholder="Enter your email address">
                
            </div>
            
            <div class="form-group">
                
                <input class="form-control" type="password" name="password" placeholder="Password">
                
            </div>
            
            <div class="checkbox">
                
                <label>
                    <input type="checkbox" name="stayLoggedIn" value="1"> Stay Logged In
                </label>
            </div>
            
            <div class="form-group">
               
                <input type="hidden" name="signUp" value="1">

                <input class="btn btn-success" type="submit" name="submit" value="Sign Up!">
            
            </div>
            
            <p><a class="toggleForms" >Log In</a></p>

        </form>

        <form method="post" id="loginForm">
            
            <p>Log in with your username and password.</p>
           
            <div class="form-group">

                <input class="form-control" type="email" name="email" placeholder="Enter your email address">
                
            </div>
            
            <div class="form-group">

                <input class="form-control" type="password" name="password" placeholder="Password">
            
            </div>
            
            <div class="checkbox">
                
                <label>
                    <input type="checkbox" name="stayLoggedIn" value="1"> Stay Logged In
                </label>
            </div>
            
            <div class="form-group">

                <input type="hidden" name="signUp" value="0">

                <input class="btn btn-success" type="submit" name="submit" value="Log In">
                
            </div>
            
            <p><a class="toggleForms">Sign Up</a></p>
        </form>
        
        
        
      </div>
    
    <?php include("footer.php"); ?>
