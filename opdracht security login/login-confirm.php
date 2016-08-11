<?php

	session_start();

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}

	if ( isset( $_POST[ 'submit' ] ) )
	{

		$email		=	$_POST[ 'email' ];      
		$password	=	$_POST[ 'password' ];

		$_SESSION[ 'login' ][ 'email' ]		=	$email;        //email en paswoord van login in sessie steken
		$_SESSION[ 'login' ][ 'password' ]	=	$password;       //email en paswoord van login in sessie steken

		$isEmail	=	filter_var( $email, FILTER_VALIDATE_EMAIL ); //zien of email klopt

		if ( !$isEmail )
		{
			$_SESSION[ 'error' ][ 'type' ] = "email";
            $_SESSION[ 'error' ][ 'text' ] = "Dit is geen geldig e-mailadres. Vul een geldig e-mailadres in." ; 
			header('location: login.php' );
        }
        elseif ( $password == '' ) //paswoord validatie
		{
			$_SESSION[ 'error' ][ 'type' ] = "email";
            $_SESSION[ 'error' ][ 'text' ] = "Dit is geen geldig paswoord. Vul een geldig paswoord in." ; 
			header('location: login.php' );
		}
		else
		{
			$connection	=	new PDO( 'mysql:host=localhost;dbname=phpoefening029', 'root', '' );
			$db = new Database( $connection );

			$userData	=	$db->query( 'SELECT * FROM users WHERE email = :email', array(':email' => $email ) );

			if( isset( $userData['data'][0] ) )
			{
				var_dump( $_POST );
				var_dump( $userData['data'][0] );
				# Controle of het paswoord correct is of niet
				$salt 		= 	$userData['data'][0]['salt'];
				$passwordDb = 	$userData['data'][0]['password'];

				$newlyHashedPassword = hash( 'sha512', $salt . $password);

				var_dump( $newlyHashedPassword );

				if ($newlyHashedPassword == $passwordDb) //kijken of de paswoorden overeenkomen
				{
					$loginUser	=	User::createCookie( $salt, $email ); //nieuwe cookie aanmaken verlengen van datum

					if ( $loginUser )
					{
						$_SESSION[ 'error' ][ 'type' ] = "gelukt";
                        $_SESSION[ 'error' ][ 'text' ] ="Welkom, u bent ingelogd.";
						header('location: dashboard.php');
					}
				}
				else
				{
					$_SESSION[ 'error' ][ 'type' ] = "password";
                    $_SESSION[ 'error' ][ 'text' ] = "U kon niet ingelogd worden. Probeer opnieuw.";
					header('location: login.php' );
				}
			}
			else
			{
				$_SESSION[ 'error' ][ 'type' ] = "email";
                $_SESSION[ 'error' ][ 'text' ] = 'Deze gebruiker komt niet voor in de database. Klopt het e-mailadres wel?';
				header('location: login.php' );
			}
		}
	}
?>