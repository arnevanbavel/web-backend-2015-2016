<?php
 
    $text = file_get_contents("text-file-opdracht-foreach.txt");  
    $textchars = str_split($text);
    $gesorteerd = array();
    rsort($textchars);
    $omgedraaid = array_reverse($textchars);

    foreach($omgedraaid as $value)
    
    $aantal = array();

	foreach($omgedraaid as $value) //doorlopen omgedraaide array A - Z
	{
		if ( isset ( $aantal[ $value ] ) )  // kijken of key al bestaat
		{
			++$aantal[ $value ];    //zo jha tel bij die key +1
		}
		else                              
		{
			$aantal[ $value ] = 1;  //zo niet maak nieuwe key en tel 1 op
		}
		
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht foreach: deel 1</title>
	</head>
	<body>
		<h1>Opdracht foreach: deel 1</h1>
        <pre><?php print_r($aantal)?></pre>
	</body>
</html>