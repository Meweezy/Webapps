<?php

//session_start();

setcookie("email", $_POST['emailLogin'], time() + 3600 * 24 );

setcookie("password", $_POST['passwordLogin'], time() + 3600 * 24 );

if($_COOKIE){
    
    echo "<p>You are logged in. Welcome to your homepage.</p>";
    
    
}


?>

<html>

<head>
    
</head>
    
<body>
    
    <form method="post" action="<?php session_destroy(); if(empty($_SESSION)){ header("Location: index.php"); }?>" >
    
        <input type="submit" value="Log Out">
    
    </form>


</body>






</html>