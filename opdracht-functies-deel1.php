<?php

    /* afdrukken in functie niet goed*/
    function berekenSom($getal1,$getal2)
    {
        $resultaat = $getal1 + $getal2;
        return $resultaat;
    }
    
    /* afdrukken buiten functie goed*/
    function vermenigvuldig($getal1,$getal2)
    {
        $resultaat = $getal1 * $getal2;
        return $resultaat;
    }
    
    function isEven($getal)
    {
        $resultaat = "";
        if($getal%2 == 0)
        {
           return $resultaat = true;
        }else{
           return $resultaat = false;   
        }
    }
    
    function uitbreiding($string)
    {
        $lengte = strlen($string);
        $upper = strtoupper($string);
        return $resultaat = array($lengte,$upper);
    }

    $vermenig = vermenigvuldig(10,6);

    $getaleven = 11;
    $iseven = isEven($getaleven);

    $string = 'Dit is een string';
    $upEnLeng = uitbreiding($string);
    
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht functies: deel 1</title>
	</head>
	<body>
		<h1>Opdracht functies: deel 1</h1>
        <p>De som van 10 en 6 = <?= berekenSom(10,6) ?></p>
        <p>De vermenigvuldeging van 10 en 6 = <?= $vermenig ?></p>
        
        <?php if ($iseven): ?>
            <p>getal <?= $getaleven ?> is even </p>
        <?php else: ?>
            <p>getal <?= $getaleven ?> is oneven </p>
		<?php endif ?>
        
        <p>'<?= $string ?>' heeft een lengte van: <?=$upEnLeng[0] ?></p>
        <p>'<?= $string ?>' in uppercase = <?=$upEnLeng[1] ?></p>
	</body>
</html>