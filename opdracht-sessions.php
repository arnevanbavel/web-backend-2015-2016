<?php	
    session_start();

	if ( isset( $_GET['session'] ) )   //als in url sessions staat
    {
        if ( $_GET['session']  == 'destroy' )   //en gelijk is aan destroy
        {
            session_destroy( );                 //destroy sessie
            header( 'location: opdracht-sessions.php' );    //keer terug
        }
    }

    $email		=	( isset( $_SESSION[ 'email'] ) ) ? $_SESSION[ 'email'][0] : '';
	$nickname		=	( isset( $_SESSION[ 'nickname'] ) ) ? $_SESSION[ 'nickname'][0] : '';

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Opdracht sessions</title>
    <link rel="stylesheet" href="http://web-backend.local/css/global.css">
    <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
    <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
</head>

<body class="web-backend-voorbeeld">

	<section class="body">

        <a href="opdracht-sessions.php?session=destroy">vernietig sessie</a>
        
		<h1>registratie</h1>
		
        <form action="opdracht-sessions-adrespagina.php" method="post">
            <label for="email">email:</label>
            <input type="text" name="email" id="email" value="<?= $email ?>" <?= ( isset( $_GET['focus'] ) && $_GET['focus'] == $email ) ? 'autofocus' : '' ?>>
            
            <label for="nickname">nickname:</label>
            <input type="text" name="nickname" id="nickname" value="<?= $nickname ?>" <?= ( isset( $_GET['focus'] ) && $_GET['focus'] == $nickname ) ? 'autofocus' : '' ?>>
            
            <input type="submit" name="submit" value="Volgende">
        </form>
	</section>
    
</body>
</html>