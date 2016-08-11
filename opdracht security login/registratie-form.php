<?php
    
    session_start();
    //session_destroy();

    $email = '';
    $password = '';
    
    if ( isset( $_SESSION[ 'registration' ] ) )         //kijkt of er iets in de sessie zit
    {
        $email		=	$_SESSION[ 'registration' ][ 'email' ];   //email word uit sessie gehaald om in in form als value te kunnen steken idem met pasw
        $password	=	$_SESSION[ 'registration' ][ 'password' ];
    }

     if ( isset( $_SESSION[ 'error' ] ) )         //kijkt of er iets in de sessie zit
    {
        $message['type'] = $_SESSION[ 'error' ][ 'type' ];
        $message['text'] = $_SESSION[ 'error' ][ 'text' ];
    }


	var_dump( $_SESSION );

?>

<!DOCTYPE html>
<html>
	<head>
        <title>Opdracht security login</title>
        <link rel="stylesheet" href="http://web-backend.local/css/global.css">
        <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
        <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
	</head>
	<body>
	
		<h1>Registreren</h1>
		
		<?php if ( $message ): ?>
			<div class="modal <?php echo $message['type'] ?>">
				<?php echo $message['text'] ?>
			</div>
		<?php endif ?>
		
		<form action="registratie-process.php" method="post">
			<ul>
				<li>
					<label for="email">Email</label>
					<input type="text" name="email" id="email" value="<?= $email ?>">
				</li>
				<li>
					<label for="password">Paswoord</label>
					<input type="<?= ( $password != '' ) ? 'text' : 'password' ?>" name="password" id="password" value="<?= $password ?>">
					<input type="submit" name="generate-password" value="genereer een paswoord">
				</li>
				<li>
					<input type="submit" name="submit" value="registreer">
				</li>
			</ul>
		</form>
	</body>
</html>