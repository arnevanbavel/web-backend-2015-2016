<?php
    $getallen = array(8,7,8,7,3,2,1,2,4);
    
    $getallen2 = array_unique($getallen);
    
    $getallen3 = $getallen2;
        
    rsort($getallen3)

    
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht array functies: deel 3</title>
	</head>
	<body>
		<h1>Opdracht array functies: deel 3</h1>
		<pre>getallen: <?php print_r($getallen) ?></pre>
        <pre>getallen zonder duplicaten: <?php print_r($getallen2) ?></pre>
        <pre>descending getallen: <?php print_r($getallen3) ?></pre>
	</body>
</html>