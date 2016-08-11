<?php
    $password = 'azerty';
    $username = 'arne';
    $message = 'Geef uw paswoord en username op aub';

    if ( isset( $_POST ['username'] ) && isset( $_POST ['paswoord'] ) ) //kijken of ze geset zijn
        {
            if ( $_POST ['username'] == $username && $_POST ['paswoord'] == $password ) //kijken of gelijk is aan username en pssw
            {
                $message = 'welkom'; // klopt het dan welkom
            }
            else
            {
                $message = 'Er ging iets mis bij het inloggen, probeer opnieuw';
            }
        }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht post</title>
	</head>
	<body>
        <h1>Opdracht post</h1>
        <form action="opdracht-post.php" method="post">
			<ul>
				<li>
					<label for="username">Username:</label>
					<input type="text" name="username" id="username">
				</li>
				<li>
					<label for="paswoord">Paswoord:</label>
					<input type="password" name="paswoord" id="paswoord">
				</li>
			</ul>

			<input type="submit"  value="Verzend">
		</form>
        <p><?= $message ?></p>
        <pre>
           <?= var_dump($_POST) ?> 
        </pre>
	</body>
</html>