<?php
    $jaar = 2016;

    if ((($jaar % 4 == 0) && ($jaar % 100 != 0)) || ($jaar % 400 == 0) )
    {
        $resultaat = "schrikkeljaar!!";
    }
    else
    {
        $resultaat = "geen schrikkeljaar";
    }
    
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht conditional statements</title>
	</head>
	<body>
		<h1>Opdracht conditional statements</h1>
		<p>jaar: <?php echo $jaar ?></p>
        <p>schrikkeljaar?: <?php echo $resultaat ?></p>
	</body>
</html>