<?php

	session_start();

	function __autoload( $classname ){require_once( $classname . '.php' );}

	$logout	=	User::logout(); //de mtehode logout in class user

	if ( $logout )
	{
		$_SESSION[ 'error' ][ 'type' ]='uitgelogt';
        $_SESSION[ 'error' ][ 'text' ]='U bent uitgelogd. Tot de volgende keer';
		header( 'location: login.php' );
	}

?>