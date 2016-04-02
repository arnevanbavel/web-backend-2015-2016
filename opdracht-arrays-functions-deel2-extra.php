<?php
    $dieren = array("Leeuw","Vis","Kat","Hond","Dolfijn");
    $zoogdieren = array("Geit","Bizon","Gans");
    
    sort($dieren);
    $count = count($dieren);

    $teZoekenDier = "Ho0nd";
    $gevonden = in_array($teZoekenDier,$dieren);
    
    if($gevonden)
    {
        $Resulaat = "gevonden";
    }
    else
    {
        $Resulaat = "dier bestaat niet";
    }

    $dierenlijst = array_merge($dieren,$zoogdieren);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht array functies: deel 2</title>
	</head>
	<body>
		<h1>Opdracht array functies: deel 2</h1>
		<pre>dieren: <?php print_r($dieren) ?></pre>
        <pre>aantal dieren: <?php echo $count ?></pre>
        <pre>te zoeken dier: <?php echo $teZoekenDier ?></pre>
        <pre>resultaat: <?php echo $Resulaat ?></pre>
        <pre>dieren: <?php print_r($dierenlijst) ?></pre>

	</body>
</html>