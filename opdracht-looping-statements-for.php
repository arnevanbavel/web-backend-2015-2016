<?php
    $rijen = 10;
    $kolommen = 10;

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht for: deel 1</title>
	</head>
	<body>
		<h1>Opdracht for: deel 1</h1>
        <table>
        <?php for($i=1;$i <= $rijen; $i++): ?>
        <tr>
            <?php for($a=1;$a <= $kolommen; $a++): ?>
            <td><?php echo "kolom" ?></td>
            <?php endfor ?>
        </tr>
        <?php endfor ?>
        </table>
	</body>
</html>