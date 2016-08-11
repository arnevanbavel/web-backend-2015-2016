<?php
	session_start();

	$email		=	'';
	$password	=	'';

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	$connection 	=	 new PDO( 'mysql:host=localhost;dbname=phpoefening029', 'root', '' );
	
	if ( User::validate( $connection ) ) //zien of user nog is ingelogt
	{
		header('location: dashboard.php'); // zo jha verwijzen naar dashboard
	}
	else
	{
        $message['type'] = $_SESSION[ 'error' ][ 'type' ];
        $message['text'] = $_SESSION[ 'error' ][ 'text' ];

		if ( isset( $_SESSION[ 'login' ] ) )
		{
			$email		=	$_SESSION[ 'login' ][ 'email' ];
			$password	=	$_SESSION[ 'login' ][ 'password' ];
		}
	}
?>

<!DOCTYPE html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="public/css/global.css">
	</head>
	<body>
		
		<h1>Inloggen</h1>

		<?php if ( $message ): ?>
			<div class="modal <?php echo $message['type'] ?>">
				<?php echo $message['text'] ?>
			</div>
		<?php endif ?>

		<form action="login-confirm.php" method="post">
			<ul>
				<li>
					<label for="email">Email</label>
					<input type="text" name="email" id="email" value="<?= $email ?>">
				</li>
				
				<li>
					<label for="password">Paswoord</label>
					<input type="password" name="password" id="password" value="<?= $password ?>">
				</li>
			</ul>
			
			<input type="submit" name="submit" value="log in">
		</form>
		
		<p>Nog geen login? <a href="registratie-form.php">Registreer dan hier.</a></p>
		
		<p>Opm: het paswoord van alle gebruikers is "test"</p>
	</body>
</html>