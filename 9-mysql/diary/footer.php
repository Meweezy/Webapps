
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
      
    <script type="text/javascript">
        
                    
          //$('#signup').hide(); 
            
        $('.toggleForms').click(function(){
               
              $('#loginForm').toggle();
                
               $('#signupForm').toggle();
               
          
        });
        
       /* $('#diary').bind('input propertychange', function() {

           $.ajax({
                  method: "POST",
                  url: "updatedatabase.php",
                  data: { content: $("#diary").val() }
                })
               
            
        }); */
        
       
        
        $('#save').click(function(){
            
             $(document).bind("ajaxSend", function(){
               $("#loading").show();
             }).bind("ajaxComplete", function(){
               $("#loading").hide();
        });
            //alert("Saved!");
            
            $.ajax({
                  method: "POST",
                  url: "updatedatabase.php",
                  data: { content: $("#diary").val() }
                }) 
                
                .done(function( ) {
                    alert( "Save Complete! "  );
                  });
            
        });
      
      
    </script>  
    
  </body>
</html>

