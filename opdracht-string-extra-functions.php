<?php
    $fruit = "kokosnoot";
    $letter = "o";
    $pos = strpos($fruit,$letter);

    $fruit1 = "ananas";
    $letter1 = "a";
    $pos1 = strrpos($fruit,$letter);
    $FRUIT1 = strtoupper($fruit1);

    $lettertje = "e";
    $cijfertje = "3";
    $langstewoord = "zandzeepsodemineralenwatersteenstralen";
    $nieuwezin = str_replace($lettertje,$cijfertje,$langstewoord);

?>

<!DOCTYPE html>
<html>
	<head>
		<title></title>
	</head>
	<body>
		<h1>title</h1>
		<p> positie o in kokosnoot: <?php echo $pos ?></p>
        <p> positie laatste a in ananas: <?php echo $pos1 ?></p>
        <p> ananas in grote letters: <?php echo $FRUIT1 ?></p>
        <p> nieuwe zin: <?php echo $nieuwezin ?></p>
	</body>
</html>