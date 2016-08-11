<?php

	function __autoload( $classname )
	{
		require_once( $classname . '.php' );
	}
$root 	= 	dirname(__FILE__) . '/';

    $connection 	=	 new PDO( 'mysql:host=localhost;dbname=phpoefening036', 'root', '' );


?>
