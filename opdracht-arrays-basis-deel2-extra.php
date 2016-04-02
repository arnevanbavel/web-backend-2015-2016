<?php
    $getal = array(1,2,3,4,5);
    $maal = $getal[0] *  $getal[1] * $getal[2] * $getal[3] * $getal[4]; 

    $getal2 = array(5,4,3,2,1);
    $getallen = array($getal[0]+$getal2[0],$getal[1]+$getal2[1],$getal[2]+$getal2[2],$getal[3]+$getal2[3],$getal[4]+$getal2[4]);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht arrays basis: deel 2</title>
	</head>
	<body>
		<h1>Opdracht arrays basis: deel 2</h1>
        <pre>getalen reeks1: <?php print_r($getal) ?></pre>
		<p>maal: <?php echo $maal ?></p>
        <pre>getalen reeks2: <?php print_r($getal2) ?></pre>
        <pre>getalen reek1 + reeks2: <?php print_r($getallen) ?></pre>
	</body>
</html>