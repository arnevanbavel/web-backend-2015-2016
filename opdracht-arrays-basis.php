<?php
    $dieren = array("Leeuw","Vis","Kat","Hond","Dolfijn");

    $dieren[] = "Konijn";
    $dieren[] = "Egel";
    $dieren[] = "Papegaai";
    $dieren[] = "Varken";
    $dieren[] = "Koe";


    $voertuigen = array("landvoertuigen" => array("Auto","Vesp","Fiets"),
                       "watervoertuigen" => array("Vlot","Boot"),
                       "luchtvoertuigen" => array("vliegtuig","B52"));    
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht arrays basis: deel 1</title>
	</head>
	<body>
		<h1>Opdracht arrays basis: deel 1</h1>
		<pre>dieren: <?php print_r($dieren) ?></pre>
        <pre>voertuigen: <?php print_r($voertuigen) ?></pre>
	</body>
</html>