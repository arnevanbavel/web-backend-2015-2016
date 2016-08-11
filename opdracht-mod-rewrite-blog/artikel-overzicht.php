<?php
    session_start();
    
    $message='';
    if(isset($_SESSION['notification']))
    {
        $message = $_SESSION['notification'];
        unset($_SESSION['notification']);
    }
    try
    {
       $db = new pdo('mysql:host=localhost;dbname=opdracht_mod_rewrite_blog','root','', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
        
        $queryString = "Select * from artikels";
       
        $statement = $db -> prepare($queryString);
        $statement->execute();
                              
        $fetchRow = array();
		while ( $row = $statement->fetch(PDO::FETCH_ASSOC) )
		{
			$fetchRow[]	=	$row;
		}  
        
    }
    catch( PDOException $e ){
    $_SESSION['notification'] = 'Er ging iets mis: '.$e->getmessage();
    }
?>
<!DOCTYPE html>
<html>
    <head>
     <style>
        *{
                font-family: sans-serif;
        }
        label, input {
                display: block;
                margin: 5px;
        }
        
        input[type="text"], select {
            float: left;
        }
        input[type="submit"] {
            width: 20%;
            width: 100px;
            background-color: #cd081a;
            border-radius: 5px;
            color: white;
        }
        
        #submit-datum {
            margin-top: -2px;
        }
        
        #submit-titel {
            margin-top: 15px;
        }
        
        
        input[type="text"] {
            display: block;
            background-color: rgba(0,0,0,0.2);
            border-radius: 5px;
            border: none;
            height: 30px;
            width: 400px;
            margin-bottom: 10px;
            padding-left: 10px;
        }
        .succes {
            color: green;
        }
        
        .error {
            color: red;
        }
        
        form {
            margin-bottom: 30px;
        }
        
        h1 {
            border-bottom: 1px solid lightgrey;
        }
        
        article {
            border-bottom: 1px solid lightgrey;
        }
    </style>
    </head>
    <body>
        <p><?php echo $message ?></p>
        <form action="artikel-zoeken.php" method="get">
            <label for="artikel">Zoeken in artikels:</label>
            <input type="text" name="artikel" id="artikel" >
            <input type="submit" name="zoekInArtikel" value="Zoeken">
        <form><br><br>
            
        <form action="artikel-zoeken.php" method="get">          
            <label for="jaar">Zoeken op datum:</label>
            <select name="jaar">
                <?php for($i=2010;$i<2019;$i++): ?>
                <option value="2010"><?php echo $i ?></option>
                <?php endfor ?>
            </select>
            <input type="submit" name="zoekOpDatum" value="Zoeken">
        </form>
            
        <h2>Artikels Overzicht</h2>
        <a href="artikel-toevoegen-form.php">Artikel toevoegen</a>
        
        <?php foreach ($fetchRow as $row => $rowdata): ?>
            <article>
                <h3><?php echo $rowdata['Titel'] ?> | <?php echo $rowdata['Datum'] ?></h3>
                <p><?php echo $rowdata['Artikel'] ?></p>
                <p>Keywords: <?php echo $rowdata['Kernwoorden'] ?></p>
            </article>
        <?php endforeach ?>
    </body>
</html>