<?php
	$artikels = array(

						array ('titel' => 'Drie agenten doodgeschoten in Baton Rouge',
								'datum' => '17/07/2016',
								'inhoud' => 'In Baton Rouge, in de Amerikaanse staat Louisiana, zijn drie agenten doodgeschoten. Verschillende andere agenten raakten gewond. Dat heeft de burgemeerster van de stad bevestigd.

De agenten waren uitgerukt voor een melding over een gewapende man die in de buurt rondliep. Toen ze op de opgegeven plaats aankwamen, werden ze onder vuur genomen. Drie agenten hebben die aanval niet overleefd. Er zouden ook drie andere agenten gewond geraakt zijn. Ook een schutter doodgeschoten zijn. Er zou nog druk gezocht worden naar 2 andere medeplichtigen. 

De schietpartij deed zich voor op iets meer dan een kilometer van het politiekantoor, waar eerder deze maand tientallen demonstranten opgepakt werden. Het is al een tijd onrustig in in Baton Rouge, waar begin deze maand Alton Sterling door de politie doodgeschoten werd toen hij in bedwang gehouden werd door agenten. Amper drie dagen geleden werden in Baton Rouge nog drie mannen opgepakt omdat ze agenten dreigden te vermoorden.   

Een tweetal weken geleden werden in Dallas, in de staat Texas, ook al vijf agenten doodgeschoten. Dat gebeurde door een man die kwaad was vanwege de recente schietpartijen waarbij agenten (zwarte) burgers doodgeschoten hebben. ',
								'afbeelding' => 'batonrouge.jpg',
								'afbeeldingBeschrijving' => 'Baton Rouge',
								),

						array ('titel' => 'Strijd tegen IS vanuit Turkije hervat',
								'datum' => '17/07/2016',
								'inhoud' => 'De internationale coalitie tegen IS hervat zijn strijd tegen de terreurgroep vanuit Turkije. Dat heeft woordvoerder Peter Cook van het Pentagon zondag aangekondigd. De luchtaanvallen vanop de luchtmachtbasis Incirlik waren opgeschort nadat de Turkse autoriteiten het vliegverkeer verboden hadden. De basis was zelfs tijdelijk zonder stroom gezet.

Na de mislukte staatsgreep vrijdagnacht verboden de Turkse autoriteiten verplaatsingen van en naar de luchtmachtbasis, waar onder meer Amerikaanse en Duitse militairen gestationeerd zijn. Druk overleg tussen Washington en Ankara leverde urenlang niets op.

Intussen kan de strijd vanop Incirlik wel weer worden voortgezet. Na nauw overleg met onze Turkse bondgenoten zijn de luchtoperaties van de anti-IS-coalitie hervat, stuurde Pentagon-woordvoerder Cook via Twitter de wereld in.

Generaal opgepakt

Eerder was bekendgeraakt dat generaal Bekir Ercan Van, die de leiding had over de zuidelijke basis, gearresteerd was op verdenking van medeplichtigheid aan de staatsgreep. Ook tien van zijn ondergeschikten zijn opgepakt.

De Koerdische strijders die op het terrein strijd voeren tegen de terreurgroep, lieten dan weer verstaan dat de tijdelijke opschorting van de aanvallen van op Incirlik geen invloed heeft op de gevechten. De luchtsteun blijft voortduren, de operaties en de coördinatie vinden plaats zoals normaal, zei woordvoerder Shervan Darwish.',
								'afbeelding' => 'jet.jpg',
								'afbeeldingBeschrijving' => 'Jet',
								),

						array ('titel' => 'Peeters breekt elleboog en twee ribben bij val',
								'datum' => '17/07/2016',
								'inhoud' => 'CD&V-vicepremier Kris Peeters heeft zijn elleboog en twee ribben gebroken bij een botsing met de fiets. Hij zal maandag wel aan het werk gaan.

Dat meldt de politicus, zonder veel bijkomende details te geven over het ongeval.Peeters staat erom bekend dat hij graag fietst. Zaterdag liep het echter mis en kwam het tot een botsing met enkele andere fietsers. Wiens gebrek aan wendbaarheid aan de oorzaak lag van de botsing, is niet bekend.',
								'afbeelding' => 'peeters.jpg',
								'afbeeldingBeschrijving' => 'Fietsende Kris Peeters',
								),
					);

///// Van oplossing genomen want wist niet hoe ik dit moest doen

   	$individueelArtikel		=	false;

	// Controleren of de get-variabele ID geset is om een individueel artikel op te halen
	if ( isset ( $_GET['id'] ) )   //isset kijkt of variable is ingevuld en niet null is
	{
		$id = $_GET['id'];

		// Controleren of de opgevraagde key (=id) bestaat in de array $artikels
		if ( array_key_exists( $id , $artikels ) )    // geeft true or false
		{
			$artikels 			= 	array( $artikels[$id] );
			$individueelArtikel	=	true;
		}		
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht get</title>
        <style>
		body
		{
			font-family:"Segoe UI";
			color:#423f37;
		}

		.container
		{
			width:	1024px;
			margin:	0 auto;
		}

		img
		{
			max-width: 100%;
		}

		.multiple
		{
			float:left;
			width:288px;
			margin:16px;
			padding:16px;
			box-sizing:border-box;
			background-color:#EEEEEE;
		}

		.multiple:nth-child(3n+1)
		{
			margin-left:0px;
		}

		.multiple:nth-child(3n)
		{
			margin-right:0px;
		}

		.single img
		{
			float:right;
			margin-left: 16px;
		}


	</style>
	</head>
	<body>
        <?php if ( !$individueelArtikel ): ?>
		<h1>Opdracht get</h1>
        <?php else: ?>
        <h1>Artikel</h1>
        <?php endif ?>
        <div class="container">
            <?php foreach ( $artikels as $key => $artikel ): ?>
                    <article class="<?= ( !$individueelArtikel ) ? 'multiple': 'single' ; ?>">
                        
                        <h2><?= $artikel['titel'] ?></h2>
                        
                        <p><?= $artikel['datum'] ?></p>
                        
                        <img src="img/<?= $artikel['afbeelding'] ?>" alt="<?= $artikel['afbeeldingBeschrijving'] ?>">
                        
                        <p>
                            <?php echo ( !$individueelArtikel ) ? 
                            str_replace ( "\r\n", "</p><p>", substr( $artikel['inhoud'], 0, 100 ) ) . '...'
                            : 
                            str_replace ( "\r\n", "</p><p>",$artikel['inhoud'] ) ; ?>
                        </p>
                        
                        <?php if ( !$individueelArtikel ): ?>
						  <a href="opdracht-get.php?id=<?php echo $key ?>">Lees meer</a>
					   <?php endif ?>
                    </article>
            <?php endforeach ?>
        </div>

	</body>
</html>