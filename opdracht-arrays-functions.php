<?php
    $dieren = array("Leeuw","Vis","Kat","Hond","Dolfijn");
    
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
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht array functies: deel 1</title>
	</head>
	<body>
		<h1>Opdracht array functies: deel 1</h1>
		<pre>dieren: <?php print_r($dieren) ?></pre>
        <pre>aantal dieren: <?php echo $count ?></pre>
        <pre>te zoeken dier: <?php echo $teZoekenDier ?></pre>
        <pre>resultaat: <?php echo $Resulaat ?></pre>

	</body>
</html>