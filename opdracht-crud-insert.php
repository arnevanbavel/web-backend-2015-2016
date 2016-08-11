<?php

    $errorbericht = '';
    $bericht = '';
   
    if ( isset( $_POST[ 'submit' ] ) )
    {
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=bieren', 'root','', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));     //connectie maken   
            $query='INSERT INTO brouwers (brnaam, adres, postcode, gemeente, omzet) VALUES ( :brnaam, :adres, :postcode, :gemeente, :omzet )';   //query
            
            $result = $db->prepare( $query );    //prepare en execute
            
            $result->bindValue( ':brnaam', $_POST[ 'brnaam' ] );
            $result->bindValue( ':adres', $_POST[ 'adres' ] );
            $result->bindValue( ':postcode', $_POST[ 'postcode' ] );
            $result->bindValue( ':gemeente', $_POST[ 'gemeente' ] );
            $result->bindValue( ':omzet', $_POST[ 'omzet' ] );
    
            $gelukt = $result->execute();
            
            switch($gelukt)
            {
                case 1:
                $insertId =	$db->lastInsertId();        //geeft laatst toegevoegd if
                $bericht = 'Brouwerij succesvol toegevoegd. Het unieke nummer van deze brouwerij is ' . $insertId;
                break;
                case 0;
                $bericht = 'Er ging iets mis met het toevoegen. Probeer opnieuw.';
                break;
            }
        }
        catch ( PDOException $e )
        {
            $errorbericht	=	'Er ging iets mis: ' . $e->getMessage();
        }
    }

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht Crud insert</title>
		    <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
    <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
	</head>
<body>

    <p><?= $errorbericht ?> <?= $bericht ?></p>
	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
		<ul>
			<li>
				<label for="brnaam">Brouwernaam</label>
				<input type="text" name="brnaam" id="brnaam">
			</li>
			<li>
				<label for="adres">adres</label>
				<input type="text" name="adres" id="adres">
			</li>
			<li>
				<label for="postcode">postcode</label>
				<input type="text" name="postcode" id="postcode">
			</li>
			<li>
				<label for="gemeente">gemeente</label>
				<input type="text" name="gemeente" id="gemeente">
			</li>
			<li>
				<label for="omzet">omzet</label>
				<input type="text" name="omzet" id="omzet">
			</li>
		</ul>
		<input type="submit" value="Verzenden" name="submit">
	</form>
	
</body>
</html>