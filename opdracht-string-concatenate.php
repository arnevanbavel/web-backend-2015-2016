<?php
    $voornaam = "Arne";
    $naam = " Van Bavel";

    $volledigeNaam = $voornaam . $naam;
    $aantalKarakters = strlen( $volledigeNaam );
?>

<!DOCTYPE html>
<html>
	<head>
		<title>concat</title>
	</head>
	<body>
		<h1>concat</h1>
		<p><?php echo $volledigeNaam ?></p>
        <p>Aantal karakters: <?php echo $aantalKarakters ?></p>
	</body>
</html>