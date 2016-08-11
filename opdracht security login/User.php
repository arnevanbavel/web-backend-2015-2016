<?php

	class User
	{

		public static function createNewUser( $connection, $email, $password )
		{
			$salt = uniqid(mt_rand(), true);                             //willekeurge salt
			$hashedPassword	=	hash( 'sha512', $salt . $password );   //sha512-heashed paswoord + salt

			$db = new Database( $connection );

			$query 	=	'INSERT INTO users (email,salt,password,lastlogin)
									VALUES (:email,:salt,:password,NOW())';

			$tokens	=	array( ':email' => $email, ':salt' => $salt, ':password' => $hashedPassword);
			$userData	=	$db->query( $query , $tokens );

			$cookie 	= 	self::createCookie( $salt, $email ); //cookie aanmaken
			return $cookie;
		}

		public static function logout()
		{
			unset( $_SESSION['login'] );

			$unsetCookie 	=	setcookie( 'authenticated', '', 0 ); //unsetten van cookie
			return $unsetCookie;
		}

		public static function createCookie( $salt, $email )      //functie om aan maken van cookie
		{
			// Cookie aanmaken
			$hashedEmail	=	hash( 'sha512', $salt . $email ); //hashes email + salt
			$cookieValue	=	$email . ',' . $hashedEmail;

			$cookie	=	setcookie( 'authenticated', $cookieValue, time() + (86400 * 30) ); //cookie van 30 dagen

			return $cookie;
		}

		public static function validate( $connection )
		{

			if ( isset( $_COOKIE['authenticated'] ) ) //zien of cookie geset is
			{
				
				$userData		=	explode( ',', $_COOKIE['authenticated'] ); //explode sheid een string bij ','
				$email			= 	$userData[0];       //email adress
				$saltedEmail	= 	$userData[1];       //gesalted email adress

				$db = new Database( $connection );

				$userData	=	$db->query( 'SELECT * FROM users WHERE email = :email', array(':email' => $email ) );

				if( isset( $userData['data'][0] ) )
				{
					$salt = $userData['data'][0]['salt'];
					$newlySaltedEmail 	= hash( 'sha512' , $salt . $email ); 

					if ( $newlySaltedEmail == $saltedEmail ) //kijken of of email db en cookie gelijk zijn
					{
						# Cookie is correct
						return true;
					}
					else
					{
						# Password niet correct
						return false;
					}
				}
				else
				{
					# User niet gevonden
					return false;
				}
			}
			else
			{
				#Cookie niet geset
				return false;
			}

		}

	}

?>