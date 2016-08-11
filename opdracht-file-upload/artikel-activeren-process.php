<?php

    session_start();

    function relocate( $url )
    {
        header('location: ' . $url );
    }

    function my_autoloader($class) {
        include 'classes/' . $class . '.php';
    }

    spl_autoload_register( 'my_autoloader' );

    define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );
    define( 'HOST', dirname( BASE_URL ) . '/');
    
    $message    =   false;

    if ( Message::hasMessage() )
    {
        $message = Message::getMessage();

        Message::remove();
    }

    $db = new PDO('mysql:host=localhost;dbname=opdracht_file_upload', 'root', ''); // Connectie maken

    $databaseWrapper    =   new Database( $db );

    $user = new User( $databaseWrapper );

    if ( !$user->validate() )
    {
        new Message( "U moet eerst inloggen", "error" );
        relocate("login-form.php");
    }

    if ( isset( $_POST[ 'activate' ] ) )
    {
        $artikel = new Artikel( $databaseWrapper );
        
        $id = $_POST[ 'activate' ];

        var_dump( $_POST );

        $artikel->toggle( $id );

        new Message( 'Het artikel is succesvol van activatiestatus veranderd', 'success');
        relocate("artikels-overzicht.php");
    }

?>