<?php

	function __autoload( $className ) {
	    require_once 'classes/' . $className . '.php';
	}
        
    $leeuw = new Animal('Joerie','male',100);
    $slak = new Animal('Gerath','ander',50);
    $aap = new Animal('Barry','female',80);

    $leeuw->changeHealth(-20);
    $slak->changeHealth(20);
    $aap->changeHealth(10);

    $leeuw1 = new Lion('Simba','ander',50,'Congo Lion');
    $leeuw2 = new Lion('Scar','female',80, 'Kenia Lion');

    $zebra1 = new Zebra('Zeke','ander',50,'Congo Zebra');
    $zebra2 = new Zebra('Zana','female',80, 'Kenia Zebra');

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Opdracht classes: extends</title>
    <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
    <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
</head>

<body class="web-backend-voorbeeld">

	<section class="body">

		<h1>Opdracht classes: extends</h1>
        
        <p><?=  $leeuw->getName() ?> zijn geslacht is <?=  $leeuw->getGender() ?> en heeft <?=  $leeuw->getHealth() ?> health (special move: '<?=  $leeuw->doSpecialMove() ?>')</p>
        <p><?=  $slak->getName() ?> zijn geslacht is <?=  $slak->getGender() ?> en heeft <?=  $slak->getHealth() ?> health (special move: '<?=  $slak->doSpecialMove() ?>')</p>
        <p><?=  $aap->getName() ?> zijn geslacht is <?=  $aap->getGender() ?> en heeft <?=  $aap->getHealth() ?> health (special move: '<?=  $aap->doSpecialMove() ?>')</p>
        
        <h1>Instanties van lion class</h1>
        
        <p><?=  $leeuw1->getName() ?> (special move: '<?=  $leeuw1->doSpecialMove() ?>')</p>
        <p><?=  $leeuw2->getName() ?> (special move: '<?=  $leeuw2->doSpecialMove() ?>')</p>
        
	</section>
    
    <h1>Instanties van Zebra class</h1>
        
        <p><?=  $zebra1->getName() ?> (special move: '<?=  $zebra1->doSpecialMove() ?>')</p>
        <p><?=  $zebra2->getName() ?> (special move: '<?=  $zebra1->doSpecialMove() ?>')</p>
        


</body>
</html>