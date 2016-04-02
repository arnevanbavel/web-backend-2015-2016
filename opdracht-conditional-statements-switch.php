<?php
    $getal = 7;
    
    switch($getal)
    {
        case 1 : $dag = "maandag";
        break;
        case 2 : $dag = "dinsdag";
        break;
        case 3 : $dag = "woensdag";
        break;
        case 4 : $dag = "donderdag";
        break;
        case 5 : $dag = "vrijdag";
        break;
        case 6 : $dag = "zaterdag";
        break;
        case 7 : $dag = "zondag";
        break;
        default: $dag = "Verkeerd getal";
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht switch</title>
	</head>
	<body>
		<h1>Opdracht switch</h1>
		<p>getal: <?php echo $getal ?></p>
        <p>dag: <?php echo $dag ?></p>
	</body>
</html>