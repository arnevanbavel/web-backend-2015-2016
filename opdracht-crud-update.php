<?php

    $errorbericht = '';
    $bericht = '';
    $deleteVraag = false;
	$deleteId =	false;
    $brouwersEdit = false;

        try
        {
            $db = new PDO('mysql:host=localhost;dbname=bieren', 'root','', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));     //connectie maken  
            
            if ( isset( $_POST[ 'edit' ] ) )
            {
                $brouwersEdit	=	query( $db, 'SELECT * FROM brouwers WHERE brouwernr = :brouwernr', array( ':brouwernr' => $_POST[ 'edit' ] ) );
            }
            
            if ( isset( $_POST[ 'edit2' ] ) )
		    {
			$updateQuery	=	'UPDATE brouwers
									SET brnaam 			=	:brnaam,
											adres		=	:adres,
											postcode	=	:postcode,
											gemeente	=	:gemeente,
											omzet		=	:omzet
									WHERE brouwernr	= :brouwernr
									LIMIT 1';

			$update = $db->prepare( $updateQuery );
			
			$update->bindValue( ":brouwernr",  $_POST[ 'brouwernr' ] );						
			$update->bindValue( ":brnaam",  $_POST[ 'brnaam' ] );						
			$update->bindValue( ":adres",  $_POST[ 'adres' ] );						
			$update->bindValue( ":postcode",  $_POST[ 'postcode' ] );						
			$update->bindValue( ":gemeente",  $_POST[ 'gemeente' ] );						
			$update->bindValue( ":omzet",  $_POST[ 'omzet' ] );

			$updategelukt	=	$update->execute();

			 switch($updategelukt)
                {
                    case 1:
                    $bericht = 'Aanpassing succesvol doorgevoerd.';
                    break;
                    case 0;
                    $bericht = 'Aanpassing is niet gelukt. Probeer opnieuw of neem contact op met de systeembeheerder wanneer deze fout blijft aanhouden.';
                    break;
                }			

		}

         
            $query='SELECT * FROM brouwers';   //query
            
            $result = $db->prepare( $query );    //prepare en execute
            $result->execute();
            
            $brouwernamen =	array();
            for ( $i = 0; $i < $result->columnCount(); ++$i )
            {
                $brouwernamen[]	= $result->getColumnMeta( $i )['name'];
            }
            
            $brouwers =	array();
            while( $row = $result->fetch( PDO::FETCH_ASSOC ) )
            {
                $brouwers[]	= $row;
            }
            
            if ( isset( $_POST[ 'confirm' ] ) )
            {
                $deleteVraag = true;
                $deleteId =	$_POST[ 'confirm' ];
            }

            
            if ( isset( $_POST['delete'] ) )
		    {
                $deleteQuery = 'DELETE FROM brouwers WHERE brouwernr = :brouwernr';
                $deleteresult = $db->prepare( $deleteQuery );
                $deleteresult->bindValue( ':brouwernr', $_POST['delete'] );
                $gelukt = $deleteresult->execute();
            
                switch($gelukt)
                {
                    case 1:
                    $bericht = 'De datarij werd goed verwijderd.';
                    break;
                    case 0;
                    $bericht = 'De datarij kon niet verwijderd worden. Probeer opnieuw.';
                    break;
                }
            }
        }
        catch ( PDOException $e )
        {
            $errorbericht	=	'Er ging iets mis: ' . $e->getMessage();
        }


        function query( $db, $query, $tokens = false )
	{
		$statement = $db->prepare( $query );
		
		if ( $tokens )
		{
			foreach ( $tokens as $token => $tokenValue )
			{
				$statement->bindValue( $token, $tokenValue );
			}
		}

		$statement->execute();

		/*  Veldnamen ophalen*/
		$fieldnames	=	array();

		for ( $fieldNumber = 0; $fieldNumber < $statement->columnCount(); ++$fieldNumber )
		{
			$fieldnames[]	=	$statement->getColumnMeta( $fieldNumber )['name'];
		}

		/*De brouwer-data ophalen*/
		$data	=	array();

		while( $row = $statement->fetch( PDO::FETCH_ASSOC ) )
		{
			$data[]	=	$row;
		}

		$returnArray['fieldnames']	=	$fieldnames;
		$returnArray['data']		=	$data;

		return $returnArray;
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht Crud delete</title>
		    <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
    <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
	</head>
<body>

    <p><?= $errorbericht ?> <?= $bericht ?></p>
	
    <?php if ( $deleteVraag ): ?>
		<div>
			Bent u zeker dat u deze record wilt verwijderen?
			<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                <button type="submit" name="delete" value="<?= $deleteId ?>">Ja</button>
                <button type="submit">Nope</button>
			</form>
		</div>
	<?php endif ?>
    
    
    
    
	<?php if ( $brouwersEdit ): ?>
		<div>
			<form action="<?= $_SERVER[ 'PHP_SELF' ] ?>" method="POST">
				<ul>
					<?php foreach ($brouwersEdit['data'][0] as $key => $value): ?>
						
						<?php if ( $key != "brouwernr" ): ?>
							<li>
								<label for="<?= $key ?>"><?= $key ?></label>
								<input type="text" id="<?= $key ?>" name="<?= $key ?>" value="<?= $value ?>">
							</li>
						<?php endif ?>
						
					<?php endforeach ?>
				</ul>
				<input type="hidden" value="<?= $brouwersEdit['data'][0]['brouwernr'] ?>" name="brouwernr">
				<input type="submit" name="edit2" value="Wijzigen">
			</form>
		</div>
	<?php endif ?>
    
    
    
    
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
		<table>
			<thead>
				<tr>
					<th></th>
					<?php foreach ($brouwernamen as $veld): ?>
						<th><?= $veld ?></th>
					<?php endforeach ?>
					<th></th>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($brouwers as $key => $brouwer): ?>
					<tr>
						<td><?= ++$key ?></td>
						<?php foreach ($brouwer as $value): ?>
							<td><?= $value ?></td>
						<?php endforeach ?>
						<td>
							<button type="submit" name="confirm" value="<?= $brouwer['brouwernr'] ?>" class="delete-button">
								<img src="img/icon-delete.png">
							</button>
						</td>
                        <td>
							<button type="submit" name="edit" value="<?= $brouwer['brouwernr'] ?>" class="delete-button">
								<img src="icon-edit.png">
							</button>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</form>
	
</body>
</html>