<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>opdracht ajax mail</title>
    <style>
        *{
                font-family: sans-serif;
        }
        label, input {
                display: block;
                margin: 5px;
        }
        input[type="submit"] {
            width: 20%;
            width: 100px;
            background-color: red;
            border-radius: 5px;
            color: white;
        }
        textarea {
            height: 150px;
            max-height: 250px;
            padding-right: 10px;
            max-width: 800px;
        }
        
        input[type="checkbox"] {
            float: left;
        }
        .succes {
            color: green;
        }
        
        .error {
            color: red;
        }
        
    </style>
</head>
<body>

 <form method="POST" action="contact.php">   
          <label for="naam">Voor- en achternaam</label>
          <input type="text" name="naam" id="naam" value="<?php if(isset($_SESSION["naam"])){echo $_SESSION["naam"];} ?>">
   
          <label for="email">Email</label>
          <input type="text" name="email" id="email" value="<?php if(isset($_SESSION["email"])){echo $_SESSION["email"];} ?>">
   
          <label for="bericht">Bericht</label>
          <textarea name="bericht" id="bericht"><?php if(isset($_SESSION["bericht"])){echo $_SESSION["bericht"];} ?></textarea>
          
         <label class="checkb"><input type="checkbox" name="kopie" id="kopie" <?php if(isset($_SESSION["kopie"])){echo "checked";} ?> >Stuur een kopie naar mezelf</label>  
          

          <input type="submit" name="submit" value="Verzenden" class="submit-button">

              </form>
<div class="notif"><?php
 if(isset($_SESSION["notification"])){
    echo "<p class=".$_SESSION['notification']['type'].">".$_SESSION["notification"]["message"]."</p>";
     session_unset();
}?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
$(function()
{
    
    $("form").submit(function()  //Wanneer form word gesubmit
    {
            var input_data = $( this ).serialize(); // De serialize-methode zet automatisch alle inputvelden om naar het nodige formaat om doorgestuurd te kunnen worden als post of get-variabele.
            $.ajax({
                type: 'POST',
                url: 'contact-API.php',
                data: input_data,
                success: function(data) 
                {
                                    // param 'data' is niet verplicht. hangt af van de situatie, maar handig voor debugging
                                    // Je kan de data die werd gereturned bij een succesvolle AJAX-call weer opvangen door de callback een parameter te geven. Aan deze parameter wordt door jQuery automatisch de return-waarde van het PHP-script toegekend
                                    // De data wordt teruggegeven in JSON-formaat, maar wordt voorlopig nog geïnterpreteerd als een normale string
                                    // Deze string moet eerst nog omgezet worden naar leesbare JSON
                                    
                    var received_data	=	JSON.parse(data);
                                          
                if(received_data["type"] == "succes")
                {
                    $("form").fadeOut(500, function()
                    {
                       $('.notif').append('<p class=succes>Bedankt! Uw bericht is goed verzonden!<p>').fadeIn(1000);//in complete function, anders springt bericht naar boven, nu wacht hij tot fadeout complete is (0.5s), dan message tonen.
                    });
                }      
                else if(received_data["type"] == "error" && $("form").children().length == 8)
                {
                     $("form").prepend('<p class=error>Oeps, er ging iets mis. Probeer opnieuw!<p>').fadeIn();
                }
            }
            
            
        });
            return false; // return false toe te passen, anders zal het formulier automatisch verstuurd worden.
				// Dit proberen we tegen te gaan
    })
})
    
</script>

</body>
</html>