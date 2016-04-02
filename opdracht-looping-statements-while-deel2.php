<?php
    
    $i = 0;
    $boodschappenlijstje = array("Cola","Augurk","Vis","Wortel","Appel");
    $aantalboodschappen = count($boodschappenlijstje);
    $aantalboodschappen--;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht while: deel 1</title>
	</head>
	<body>
		<h1>Opdracht while: deel 1</h1>
        <ul>
            <?php while($i < $aantalboodschappen): ?>
            <li><?php echo $boodschappenlijstje[$i] ?></li>
            <?php $i++ ?>
            <?php endwhile ?>
        </ul>
	</body>
</html>