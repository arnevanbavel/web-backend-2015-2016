<?php
	
	session_start();

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	$connection 	=	 new PDO( 'mysql:host=localhost;dbname=opdracht-security-login', 'root', '' );
	if ( User::validate( $connection ) )
	{
		$message['type'] = 'inloggen';
        $message['text'] = 'u moet eerst inloggen';
	}
	else
	{
		User::logout();
		$_SESSION[ 'error' ][ 'type' ]='inloggen';
        $_SESSION[ 'error' ][ 'text' ]='Er ging iets mis tijdens het inloggen, probeer opnieuw.' ;
		header( 'location: login.php' );
	}

	

	var_dump( $_SESSION );
?>

<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="public/css/global.css">
	</head>
	<body>

		<h1>Dashboard</h1>
		
		<?php if ( isset ( $message ) ): ?>
			<div class="modal <?= $message['type'] ?>">
				<?= $message['text'] ?>
			</div>
		<?php endif ?>
		
		<p>Hallo,</p>
		
		<a href="logout.php">uitloggen</a>
	</body>
</html>