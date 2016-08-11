<?php

    $errorbericht = '';
    $bericht = '';
    $deleteVraag = false;
	$deleteId =	false;

        try
        {
            $db = new PDO('mysql:host=localhost;dbname=bieren', 'root','', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));     //connectie maken   
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
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</form>
	
</body>
</html>