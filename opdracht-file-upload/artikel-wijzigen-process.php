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

    var_dump( $_POST );

    if ( isset( $_POST[ 'submit' ] ) )
    {

        $id             =   $_POST[ 'id' ];
        $titel          =   $_POST['titel'];
        $artikelTekst   =   $_POST['artikel'];
        $kernwoorden    =   $_POST['kernwoorden'];
        $datum          =   $_POST['datum'];
        $is_active      =   isset( $_POST['is_active'] ) ? 1 : 0;

        $artikel = new Artikel( $databaseWrapper );

        $artikelEdited = $artikel->edit( $id, $titel, $artikelTekst, $kernwoorden, $datum, $is_active );

        if ( $artikelEdited )
        {
            new Message( 'Het artikel met titel "'. $titel .'" werd gewijzigd.', 'success');
            relocate("artikels-overzicht.php");
        }
        
    }

?>