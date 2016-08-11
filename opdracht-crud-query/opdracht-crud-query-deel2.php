<?php

    $errorbericht = '';
    $geselecteerdeBrouwer = '';
    try
    {
	    $db = new PDO('mysql:host=localhost;dbname=bieren', 'root','', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));     //connectie maken   
        $query='SELECT brouwernr , brnaam FROM brouwers';   //query
        
        $brouwersStatement = $db->prepare( $query );    //prepare en execute
        $brouwersStatement->execute();

		$brouwers =	array();  
		while ( $row = $brouwersStatement->fetch( PDO::FETCH_ASSOC ) )    //alle brouwers overlopen en in array zette,
		{
			$brouwers[] = $row;
		}

		// Bieren query die bij brouwer horen
		if ( isset( $_GET[ 'brouwernr' ] ) )  //zien of brouwnr is gegeven
		{
			$geselecteerdeBrouwer	=	$_GET[ 'brouwernr' ];
            $bierenQueryString	=	'SELECT bieren.naam FROM bieren WHERE bieren.brouwernr = :brouwernr';  //querry maken

			$bierenStatement = $db->prepare( $bierenQueryString );
            $bierenStatement->bindParam( ':brouwernr', $_GET[ 'brouwernr' ] );  //placeholder in vulle,

		}
		else
		{
			$bierenQueryString	=	'SELECT bieren.naam FROM bieren';
            $bierenStatement = $db->prepare( $bierenQueryString );
		}

		$bierenStatement->execute();

		/* kolomnamen van het bierenresultaat ophalen */
		$bierenHeader	=	array();
		$bierenHeader[]	=	'Aantal';       //aantal op 0 zetten

		for ($columnNumber = 0; $columnNumber  < $bierenStatement->columnCount( );  ++$columnNumber) 
		{ 
			$bierenHeader[] = $bierenStatement->getColumnMeta( $columnNumber )['name'];
		}

		/* bieren in een leesbare array plaatsen */
		$bieren	=	array();

		while( $row = $bierenStatement->fetch( PDO::FETCH_ASSOC ) )
		{
			$bieren[ ]	=	$row[ 'naam' ];
		}

	}
	catch ( PDOException $e )
	{
        $errorbericht	=	'Er ging iets mis: ' . $e->getMessage();
	}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>opdracht crud query</title>
		<style>
			.even
			{
				background-color:lightgreen;
			}
		</style>
	</head>
<body>

    <p><?= $errorbericht ?></p>
	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
		
		<select name="brouwernr">
			<?php foreach ($brouwers as $key => $brouwer): ?>
				<option value="<?= $brouwer['brouwernr'] ?>" <?= ( $geselecteerdeBrouwer != $brouwer['brouwernr'] ) ? 'selected' : '' ?>><?= $brouwer['brnaam'] ?></option>
			<?php endforeach ?>
		</select>
		<input type="submit" value="Geef mij alle bieren van deze brouwerij">
	</form>
	

	<table>
		
		

		<thead>
			<tr>
				<?php foreach ($bierenHeader as $columnName): ?>
					<th><?= $columnName ?></th>
				<?php endforeach ?>
			</tr>
		</thead>

		<tbody>
		
			<?php foreach ($bieren as $key => $biernaam): ?>
				<tr class="<?= ( ( $key + 1) %2 == 0 ) ? 'even' : '' ?>">
					<td><?= ( $key + 1 ) ?></td>
					<td><?= $biernaam ?></td>
				</tr>
			<?php endforeach ?>

		</tbody>

	</table>

</body>
</html>