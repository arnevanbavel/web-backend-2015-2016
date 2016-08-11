<?php
 // Configuratie-variabelen
	$cursus = false;
	$voorbeelden = false;
	$opdrachten	= false;
    $zoeken = false;

	if ( isset ( $_GET['link'] ) ) 
	{
		switch ( $_GET['link'] )
		{
			case 'cursus':
				$cursus = true;
				break;
            
            case 'voorbeelden':
				$voorbeelden = true;
                $file = '../cursus/public/cursus/voorbeelden';
				$lijst =	showList($file);
				break;
            
            case 'opdrachten':
				$opdrachten = true;
                $file = '../cursus/public/cursus/opdrachten';
				$lijst =	showList($file);
				break;
		}
	}

    function showList ($file)
    {
        return $lijst = scandir($file);
    }

    if ( isset ( $_GET['zoekterm'] ) ) //kijken of er een zoekterm is ingevuld                 
	{
		// Zet de configuratie-variabele op true zodat we deze in de HTML kunnen opvangen
		$zoeken = true;   //zoekenop true zetten

		$voorbeeldenlijst = showList( '../cursus/public/cursus/voorbeelden' );    //functie showlist me als parameter de dir -> krijgt array terug
		$opdrachtenlijst = showList( '../cursus/public/cursus/opdrachten' );

		$alleBestanden	=	array_merge( $voorbeeldenlijst, $opdrachtenlijst ); //samen voegen van de 2 arrays

		$resultaten	=	array();
		$zoekString =	$_GET['zoekterm'];                                          // te zoeken string

		foreach ($alleBestanden as $bestand)                                          //doorheen alle bestanden gaan
		{
			$zoekStringGevonden = strpos( $bestand, $zoekString );                       //kijken of de te zoeken string er in voor komt en op welke positues
                                                                                    // geeft positie terug of false als het niet gevonden is
			if ( $zoekStringGevonden !== false )
			{
				$resultaten[]	=	$bestand;                                       // zet het gevonden bestand in array
			}
		}

		//var_dump( $resultaten );
        if(empty($resultaten)){
            $lijst[] = 'Geen resultaat gevonden';
        }else
        {
            $lijst = $resultaten;
        }
	}


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht herhalingsopdracht: 01</title>
        <style>
        	iframe
			{
				min-width:1000px;
				min-height:750px;
                max-width:1000px;
				max-height:750px;
			}
		</style>
	</head>
	<body>
        <h1>Opdracht herhalingsopdracht: 01</h1>
        <ul>
            <li><a href="opdracht-herhalingsopdracht-01.php?link=cursus">Cursus</a></li>
            <li><a href="opdracht-herhalingsopdracht-01.php?link=voorbeelden">Voorbeelden</a></li>
            <li><a href="opdracht-herhalingsopdracht-01.php?link=opdrachten">Opdrachten</a></li>
        </ul>
        <form action="opdracht-herhalingsopdracht-01.php" method="get">
			<ul>
				<li>
					<label for="zoekterm">Zoek naar::</label>
					<input type="text" name="zoekterm" id="zoekterm">
				</li>
			</ul>

			<input type="submit"  value="Verzend">
		</form>
     <h1>inhoud</h1>
        
        <?php if ( $cursus ): ?>
			<iframe src=".../web-backend-cursus.pdf"></iframe>
		<?php endif ?>
        
       <?php if ( $voorbeelden || $opdrachten ): ?>
			<ul>
				<?php foreach ( $lijst as $mappen ): ?>
					<li><?php echo $mappen ?></li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
        
         <?php if ( $zoeken ): ?>
			<ul>
				<?php foreach ( $lijst as $resulaat ): ?>
					<li><?php echo $resulaat ?></li>
				<?php endforeach ?>
			</ul>
		<?php endif ?>
        
        <pre>
        <?php var_dump($lijst)  ?>
        </pre>
        
	</body>
</html>