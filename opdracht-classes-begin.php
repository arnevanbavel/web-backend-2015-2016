<?php

	function __autoload( $className ) {
	    require_once 'classes/' . $className . '.php';
	}
        
    $percent = new Percent(150,100);

    $absolute = $percent->absolute;
    $relative = $percent->relative;
    $hundred = $percent->hundred;
    $nominal = $percent->nominal;


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Opdracht classes: begin</title>
    <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
    <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
</head>

<body class="web-backend-voorbeeld">

	<section class="body">

		<h1>Opdracht classes: begin</h1>

        <table>
            <tr>
                <td>absoluut</td>
                <td><?= $absolute ?></td>
            </tr>
            <tr>
                <td>relatief</td>
                <td><?= $relative ?></td>
            </tr>
            <tr>
                <td>geheel getal</td>
                <td><?= $hundred ?>%</td>
            </tr>
            <tr>
                <td>nominaal</td>
                <td><?= $nominal ?></td>
            </tr>
        </table>
        
	</section>

</body>
</html>