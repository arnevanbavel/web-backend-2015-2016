<?php
	session_start(); // sessie starten anders kunnen wie variabelen niet op meerdere paginas gebruiken

    	function __autoload( $classname ) //inladen van alle gebruikte classes
        {
            require_once( $classname . '.php' );
        }

    if ( isset( $_POST[ 'generate-password' ] ) )   //wanneer op knop genereer paswoord word gedrukt
        {
            $generatedPassword	=	generatePassword( 16, true, true );    //maak paswoord (functie)
    
            $_SESSION[ 'registration' ][ 'email' ]		=	$_POST[ 'email' ];    //zet de email in sessie
            $_SESSION[ 'registration' ][ 'password' ]	=	$generatedPassword;     //zet gegeneerd paswoord in sessie
    
            header( 'location: registratie-form.php' );
        }

    if ( isset( $_POST[ 'submit' ] ) )
	   {
            $email		=	$_POST[ 'email' ];
            $password	=	$_POST[ 'password' ];
    
            $_SESSION[ 'registration' ][ 'email' ]		=	$email;
            $_SESSION[ 'registration' ][ 'password' ]	=	$password;
    
            $isEmail	=	filter_var( $email, FILTER_VALIDATE_EMAIL ); //validate emailadress geeft true or false terug
    
            if ( !$isEmail )
            {
                $_SESSION[ 'error' ][ 'type' ]	= "email" ;
                $_SESSION[ 'error' ][ 'text' ]	= "Dit is geen geldig e-mailadres. Vul een geldig e-mailadres in." ; 
                header('location: ' . 'registratie-form.php' );
		    }
        		
            elseif ( $password == '' )
            {
                $_SESSION[ 'error' ][ 'type' ]	= "password" ;
                $_SESSION[ 'error' ][ 'text' ]	= "Dit is geen geldig paswoord. Vul een geldig paswoord in."; 
                header('location: registratie-form.php' );
            }
            else
            {
                // controleren of het emailadres reeds in de db voorkomt
    
                $connection	=	new PDO( 'mysql:host=localhost;dbname=opdracht-security-login', 'root', '' );    
                $db = new Database( $connection );

                $userData	=	$db->query( 'SELECT * FROM users WHERE email = :email', array(':email' => $email ) ); //alles selectere  waar email gelijk is aan email
    
                if ( isset( $userData['data'][ 0 ] ) ) //als userdata inhoud bevat is het teken dat er al een user is met dat email adress
                {
                    $_SESSION[ 'error' ][ 'type' ]	= "email" ;
                    $_SESSION[ 'error' ][ 'text' ]	= "De gebruiker met het e-mailadres " . $email . "komt reeds voor in onze database." ; 
    
                    header('location: registratie-form.php' );
                }
                else
                {
                    $newUser	=	User::CreateNewUser( $connection, $email, $password );   // class voor toevoegen nieuwe user en coockie aante maken
                                                                                            // krijgt cookie terug
                    if ( $newUser )
                    {
                        $_SESSION[ 'error' ][ 'type' ]	= "succes" ;
                        $_SESSION[ 'error' ][ 'text' ]	="Welkom, u bent vanaf nu geregistreerd in onze app.";
                        header('location: dashboard.php');
                    }
                }


			// gebruiker toevoegen aan de database

			// cookie aanmaken met de juiste value
		}
	}


    function generatePassword($length, $numeric = TRUE, $alphanumeric = FALSE, $alphanumericUppercase = FALSE, $specialChars = FALSE) 
    {
            $passwordDump = ''; //Hierin komen alle willekeurige karakters van het paswoord te staan.
            $passwordCharacters = array(); //Hierin komen alle toegelaten arrays met karakters te staan.
            
            if ($numeric) {
                $passwordCharacters['numeric'] = array(0,1,2,3,4,5,6,7,8,9); // hardcoded array met opeenvolgende cijfers/letters kunnen vervangen worden door (voor bv. cijfers) range(0,9)
            }	
            
            if ($alphanumeric) {
                $passwordCharacters['alphanumericString'] = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
            }	
            
            if ($alphanumericUppercase) {
                $passwordCharacters['alphanumericUppercaseString'] = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            }	
            
            if ($specialChars) {
                $passwordCharacters['specialChars'] = array('+','-','*','/','$','%','@','#','_');
            }
            
            $characterCount = 0;
            
            while ($characterCount < $length) {
            
                $arrayCount = 0; //Dient om de array in $passwordCharacters te kunnen overlopen. Wordt per keer de whilelus doorlopen wordt, weer op 0 gezet.
            
                foreach ($passwordCharacters as $value) { //Overloopt alle values (= array met alle toegestande karakters) in de array $passwordCharacters
                
                    if ($characterCount < $length) { // Er mag een karakter toegevoegd worden aan de passwordDump zolang characterCount kleiner is dan de opgegeven lengte
                        $randomCharacter = rand(0,(count($value)-1)); //Selecteert een willekeurige value uit de array met karakters. Het grootste random getal mag maximum zo groot zijn als de count van de array met karakters - 1 (nulwaarde van count() is altijd gelijk aan 1!)
                        $passwordDump .= $value[$randomCharacter]; //Het willekeurige getal dat maximum zo groot is als het laatste karakter in de array moet toegevoegd worden aan de passwordDump
                        $characterCount++; //Tel ééntje op bij de characterCount die bijhoudt hoeveel karakters er al gebruikt zijn
                    }
                    $arrayCount++; //Tel eentje op zodat de volgende array met karakters geselecteerd kan worden.
                }
            }
            
            $passwordDump = str_shuffle($passwordDump); //Zet alle karakters van een string in willekeurige volgorde. Garandeert optimale willekeurigheid.
            return $passwordDump; //Geef het gegenereerde paswoord terug aan de oproeper (caller) van de functie.
	}
?>