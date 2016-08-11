<?php
		
	$tijd = mktime(22,35,25,1,21,1904);
    $notatie = date('d F Y, h:i:s A',$tijd);
    // d is dag, F is maan volledig, y is 2 digits , Y is vier digits , A is AM of PM
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Opdracht date</title>
    <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
    <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
</head>

<body class="web-backend-voorbeeld">

	<section class="body">

		<h1>Opdracht date</h1>
		
        <p><?php echo $notatie ?></p>
		
	</section>

</body>
</html>