<?php
    $i = 0;
    $a = 0;

     while ( $i <= 100 )
    {
        $getallen[] = $i;
        $i++;
    }
    
    $zin = implode(", ",$getallen);

    while( $a <= 100 )
    {
        if ($a % 3 == 0 && $a > 40 && $a < 80)
        {
            $getallen2[] = $a;
        }
        $a++;
    }

    $zin2 = implode(", ",$getallen2);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht while: deel 1</title>
	</head>
	<body>
		<h1>Opdracht while: deel 1</h1>
        <pre><?php echo $zin ?></pre>
        <pre><?php echo $zin2 ?></pre>
	</body>
</html>