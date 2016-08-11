<?php

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}


?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Opdracht manipulation thumb gallery</title>
    <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
    <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
</head>

<body class="web-backend-voorbeeld">

	<section class="body">

		<h1>Opdracht manipulation thumb gallery</h1>
        <a href="gallery.php">Terug naar gallerij</a>
        <form action="photo-upload.php" method="POST" enctype="multipart/form-data">
		<ul>
            <li>
            <label for="imafilege">image</label>
            <input type="file" name="file" id="file">
            </li>
            <li>
            <label for="title">Title</label>
            <input type="text" name="title" id="title">
            </li>
            <li>
            <label for="beschrijving">Beschrijving</label>
            <input type="text" name="beschrijving" id="beschrijving">
            </li>
            <li>
		      <input type="submit" name="submit" value="Verzenden">
            </li>
		</ul>
	</form>
	</section>

</body>
</html>