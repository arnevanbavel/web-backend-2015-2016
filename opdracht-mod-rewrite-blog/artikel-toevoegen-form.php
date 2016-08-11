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
            background-color: #cd081a;
            border-radius: 5px;
            color: white;
        }
        input[type="text"], textarea, input[type="date"] {
            display: block;
            background-color: rgba(0,0,0,0.2);
            border-radius: 5px;
            border: none;
            height: 30px;
            width: 400px;
            margin-bottom: 10px;
            padding-left: 10px;
        }
        textarea {
            height: 150px;
            max-height: 250px;
            padding-right: 10px;
            max-width: 800px;
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
 <form method="POST" action="artikel-toevoegen.php">   
          <label for="titel">Titel</label>
          <input type="text" name="titel" id="titel" value="<?php if(isset($_SESSION["titel"])){echo $_SESSION["titel"];} ?>">
          
          <label for="artikel">Artikel</label>
          <textarea name="artikel" id="artikel"><?php if(isset($_SESSION["artikel"])){echo $_SESSION["artikel"];} ?></textarea>
   
          <label for="kernwoorden">Kernwoorden</label>
          <input type="text" name="kernwoorden" id="kernwoorden" value="<?php if(isset($_SESSION["kernwoorden"])){echo $_SESSION["kernwoorden"];} ?>">
          
          <label for="datum">Datum</label>
          <input type="date" id="datum" name="datum" value="<?php if(isset($_SESSION["datum"])){echo $_SESSION["datum"];} ?>">          

          <input type="submit" name="submit" value="Verzenden" class="submit-button">

              </form>
              
              <?php
 if(isset($_SESSION["notification"]))
 {
    echo "<p class=".$_SESSION['notification']['type'].">".$_SESSION["notification"]["message"]."</p>";
     session_unset();
}
    ?>
</body>
</html>