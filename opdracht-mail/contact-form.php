<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
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
            color: forestgreen;
        }
        
        .error {
            color: firebrick;
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
              
              <?php
 if(isset($_SESSION["notification"])){
    echo "<p class=".$_SESSION['notification']['type'].">".$_SESSION["notification"]["message"]."</p>";
     session_unset();
}?>

</body>
</html>