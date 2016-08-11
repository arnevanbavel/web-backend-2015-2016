<?php
    $startbedrag = 100000;
    $jaar = 0;
    $data = array();

    function bereken ($startbedrag, $jaar, $data)
    {
        $bedrag = floor($startbedrag * 1.08);
        $rente = floor($startbedrag * 0.08);
        ++$jaar;
        
        if($jaar == 10)
        {
            
            $data[ $jaar ] = 'Na ' . $jaar . ' jaar heeft hans ' . $bedrag . ' euro   - ' . $rente . ' euro rente. -';
            return $data;
            
        }else
        {
            $data[ $jaar ] = 'Na ' . $jaar . ' jaar heeft hans ' . $bedrag . ' euro   - ' . $rente . ' euro rente. -';
            return bereken($bedrag, $jaar, $data);
        }
        
    }

   $datahans = bereken($startbedrag, $jaar, $data);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht functies recursive: deel 2</title>
	</head>
	<body>
		<h1>Opdracht functies recursive: deel 2</h1>
        <pre><?php var_dump($datahans) ?></pre>
        <?php foreach($datahans as $value): ?>
				<li><?php echo $value ?></li>
        <?php endforeach ?>
	</body>
</html>