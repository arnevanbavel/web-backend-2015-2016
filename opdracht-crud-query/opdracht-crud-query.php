<?php

    $errorbericht = '';
    try
    {
	    $db = new PDO('mysql:host=localhost;dbname=bieren', 'root','', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));     //connectie    
        $query='SELECT * FROM bieren                
				         INNER JOIN brouwers
				         ON bieren.brouwernr = brouwers.brouwernr
						 WHERE bieren.naam LIKE "Du%" AND brouwers.brnaam LIKE "%a%"';        
        $result = $db->prepare($query);                 //query
		$result->execute();                               //uitvoeren
        
        $bieren	=	array();                  //array bieren
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) )   //alle rijen overlopen en in bieren zetten
		{
			$bieren[] 	=	$row;
		}
        //$bieren1 = $bieren; //debug
		$columnNames = array();
		$columnNames[] = 'Biernummer';    

		foreach( $bieren[0] as $key => $bier )        //kolom namen pakken uit bieren[0] zijn de keys
		{
			$columnNames[]	=	$key;
            //echo $key;
		}

	}
	catch ( PDOException $e )
	{
        $errorbericht	=	'Er ging iets mis: ' . $e->getMessage();
    }
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Opdracht crud query</title>
    <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
    <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
    <style>
			.even
			{
				background-color:lightgreen;
			}
		</style>
</head>

<body class="web-backend-voorbeeld">

	<section class="body">

		<h1>Opdracht crud query</h1>	
        <p><?php echo $errorbericht ?></p>
		<!--<pre></?= var_dump($bieren1[0]) ?></pre>
        <pre></?= var_dump($columnNames) ?></pre>  -->      
        
        <table>
		  <thead>
              <tr>
                  <?php foreach ($columnNames as $columnName): ?>
                        <th><?= $columnName ?></th>
				  <?php endforeach ?>
			 </tr>
		  </thead>

		  <tbody>
              <?php foreach ($bieren as $key => $bier): ?>
                <p><?= $key  ?></p>
				<tr class="<?= ( ( $key + 1) %2 == 0 ) ? 'even' : '' ?>">
					<td><?= ($key + 1) ?></td>
					<?php foreach ($bier as $value): ?>
						<td><?= $value ?></td>
					<?php endforeach ?>
				</tr>
			<?php endforeach ?>
		  </tbody>

	</table>
		</section>
		
</body>
</html>