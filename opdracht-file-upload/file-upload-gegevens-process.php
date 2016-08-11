<?php

    session_start();

     function my_autoloader($class) {
        include 'classes/' . $class . '.php';
    }
    
    spl_autoload_register( 'my_autoloader' );

    define( 'BASE_URL', 'http://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] );
    define( 'HOST', dirname( BASE_URL ) . '/');
    define( 'SERVER_PATH', getcwd() . '\\' );

    $db = new PDO('mysql:host=localhost;dbname=oplossing_file_upload', 'root', ''); // Connectie maken
    $databaseWrapper = new Database( $db );

    $user = new User( $databaseWrapper );

	if (isset($_POST['submit'])) 
	{

		if ((($_FILES["profilePicture"]["type"] == "image/gif")
		|| ($_FILES["profilePicture"]["type"] == "image/jpeg")
		|| ($_FILES["profilePicture"]["type"] == "image/png"))
		&& ($_FILES["profilePicture"]["size"] < 2000000)) 
		{
		  
			if ($_FILES["profilePicture"]["error"] > 0) 
			{
				// Als er een fout in het bestand wordt gevonden (bv. corrupte file door onderbroken upload), moet er een foutboodschap getoond worden
				new Message( "Ongeldig bestand Return Code: " . $_FILES["profilePicture"]["error"] );
                header("location: gegevens-wijzigen-form.php" );
			} 
			else 
			{
				// De root van het bestand moet achterhaald worden om de absolute pathnaam (de plaats op de schijf van de server) te achterhalen
				// Zo weet de server waar het bestand moet terecht komen.
				// We kunnen dit doen door de functie dirname() toe te passen op dit bestand (=__FILE__)
				define('ROOT', dirname(__FILE__));
				
				if (file_exists(ROOT . "/img/" . $_FILES["profilePicture"]["name"])) {
					
					new Message("bestaat al");
                    header("location: gegevens-wijzigen-form.php" );
				} 
				else 
				{
                    $filename = time() . '_' . $_FILES[ 'profilePicture' ][ 'name' ];
                    
                    while ( file_exists( SERVER_PATH . 'img\\' . $filename ) )
                    {
                        $filename = time() . '_' . $_FILES[ 'profilePicture' ][ 'name' ];
                    }
                    move_uploaded_file( $_FILES[ 'profilePicture' ][ 'tmp_name' ], SERVER_PATH . 'img\\' . $filename );
        
				}
			}
		} 
		else 
		{
			 new Message( "Ongeldig bestand");
             header("location: gegevens-wijzigen-form.php" );
		}
        
        if ( $filename )
        {
            $queriegeg  =   'UPDATE users SET profile_picture = :profile_picture WHERE id = :id';

            $placeholders = array( ':profile_picture' => $filename,':id' => $user->getId() );

            $databaseWrapper->query( $queriegeg, $placeholders );

             new Message( "De gegevens zijn gewijzigd!", "success" );
             header("location: gegevens-wijzigen-form.php" );
        }
        
        if (isset($_POST[ 'email' ])) 
	    {
            $email      =   $_POST[ 'email' ];
            $querie  =   'UPDATE users SET email = :email WHERE id = :id';
            $db->prepare($querie);   
            $db->binvalue(':id',$user->getId());
            $db->binvalue(':email',$email);
            $db->execute();
        } 
        else
        {
            $error  =   new Message( "Vul een e-mailadres of een paswoord in", "error" );
            relocate( 'registratie-form.php' );
        }
	}


?>
