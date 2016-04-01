<?php
    $getal = 4;

    if ($getal == 1)
    {
        $dag = "maandag";
    }
    if ($getal == 2)
    {
        $dag = "dinsdag";
    }
    if ($getal == 3)
    {
        $dag = "woensdag";
    }
    if ($getal == 4)
    {
        $dag = "donderdag";
    }
    if ($getal == 5)
    {
        $dag = "vrijdag";
    }
    if ($getal == 6)
    {
        $dag = "zaterdag";
    }
    if ($getal == 7)
    {
        $dag = "zondag";
    }

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht conditional statements</title>
	</head>
	<body>
		<h1>Opdracht conditional statements</h1>
		<p>getal: <?php echo $getal ?></p>
        <p>dag: <?php echo $dag ?></p>
	</body>
</html>