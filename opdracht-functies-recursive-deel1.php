<?php
    $startbedrag = 100000;
    
    function bereken ($startbedrag)
    {
        static $data = array();
        static $jaar = 0;
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
            return bereken($bedrag);
        }
        
    }

   $datahans = bereken($startbedrag);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht functies recursive: deel 1</title>
	</head>
	<body>
		<h1>Opdracht functies recursive: deel 1</h1>
        <pre><?php var_dump($datahans) ?></pre>
        <?php foreach($datahans as $value): ?>
				<li><?php echo $value ?></li>
        <?php endforeach ?>
	</body>
</html>