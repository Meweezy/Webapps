<?php

$error = "";
$successMsg = "";

 if ($_POST){  
     
    if($_POST['email'] == ""){
        
       $error.="The email field is required.<br>";
    }
    
    if($_POST['subject'] == ""){
        
       $error.="The subject field is required.<br>";
    }
   
    if($_POST['content'] == ""){
        
       $error.="The contents field is required.";
    }
     
     if($error != ""){
        
        $error ='<div class="alert alert-danger" role="alert"><strong>The following errors occurred:</strong><br>'.$error.'</div>';
                        
    } else {
        
         $emailTo = "muizz.bolaji@yahoo.com";
         
         $subject = $_POST['subject'];
         
         $body = $_POST['content'];
         
         $headers = "From: ".$_POST['email'];
        
     if (mail($emailTo, $subject, $body, $headers)){
         
         $successMsg = '<div class="alert alert-success" role="alert">Your message was sent successfully!</div>';
         
        } else {
         
         $error = '<div class="alert alert-danger" role="alert">Your message could\'nt be sent!</div>';
        }
    }
               
}

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
  </head>
    
    
    
  <body>
    
      <div class="container">
        <h1 class="display-4">Contact Us</h1>
        <div id="errorMsg">
            <?   echo $error.$successMsg;?>
          </div>
          
     <form method="post">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email address" name="email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
         
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject">
          </div>
  
        <div class="form-group">
            <label for="content">What would you like to ask us?</label>
            <textarea class="form-control" id="content" rows="3" name="content"></textarea>
        </div>
  
      <button type="submit" class="btn btn-primary">Submit</button>
         
    </form> 
      
 </div>     
   
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
      
      
      
    <script type="text/javascript">
      
                $("form").submit( function (e){
         
            var error = "";
            
             if($("#email").val() == ""){
                
                error += "The email field is required.</br>";
                
            }
            
            if($("#subject").val() == ""){
                
                error += "The subject field is required.</br>";
                
            }
            
            if($("#content").val() == ""){
                
                error += "The content field is required.</br>";
                
            }
            
                 
            if (error != ""){
                
                $("#errorMsg").html('<div class="alert alert-danger" role="alert"><strong>The following errors occured:</strong><br>'+ error +'</div>');
                
                return false;
                
            } else {
                
                return true;
            }
         
        });

        
      
    </script>
      
  </body>
</html>