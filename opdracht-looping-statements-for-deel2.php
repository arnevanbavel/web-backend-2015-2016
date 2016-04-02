<?php
    $rijen = 10;
    $kolommen = 10;

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht while: deel 2</title>
        <style>
			
			.oneven
			{
				background-color	:	lightgreen;
			}

		</style>
	</head>
	<body>
		<h1>Opdracht while: deel 2</h1>
        <table>
        <?php for($i=0;$i <= $rijen; $i++): ?>
        <tr>
            <?php for($a=0;$a <= $kolommen; $a++): ?>
            <td class="<?= ( ( $i * $a ) % 2 > 0 ) ? 'oneven' : '' ?>"><?php echo $i * $a ?></td>
            <?php endfor ?>
        </tr>
        <?php endfor ?>
        </table>
	</body>
</html>