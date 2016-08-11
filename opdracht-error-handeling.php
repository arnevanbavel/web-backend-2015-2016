<?php
session_start();
$message = FALSE;
$isValid = FALSE;

function logToFile( $message )
{
	$date	=	'[' . date( 'H:i:s', time() ).']'; //tijd krijgen
	$ip	=	$_SERVER['REMOTE_ADDR']; // ipaddress

	$errorString =	$date . ' - ' . $ip . ' - type:[' . $message['type'] . '] ' . $message[ 'text' ] . "\n\r";  //alles in string zetten
	file_put_contents( 'log.txt', $errorString, FILE_APPEND ); //in log.txt zetten
}

try
{
    if(isset($_POST['submit']))
    {
        if(isset($_POST['code']))
        {
            if (strlen($_POST['code'] )== 8 )
				{
					$isValid = TRUE;
				}
				else
				{
					throw new Exception('VALIDATION-CODE-LENGTH');
				}
            
        }else
        {
            throw new Exception( 'SUBMIT-ERROR' );
        }
        
    }
}
catch(Exception $e) 
{
    $messageCode = $e->getMessage();    //vangt de exception class op
    $message = array();
    $createMessage = FALSE;

	switch($messageCode)
	{
		case'SUBMIT-ERROR':
	       $message['type'] =	'error';
	       $message['text'] =	'Er werd met het formulier geknoeid';
        break;
        
        case'VALIDATION-CODE-LENGTH':
            $message[ 'type' ]	=	'error';
			$message[ 'text' ]	=	'De kortingscode heeft niet de juiste lengte';
            $createMessage = TRUE;
        break;

    }
    
    if($createMessage)
    {
        createMessage($message);
    }
    
    logToFile($message);
    $message = showMessage();
}

function createMessage( $message )
{
	$_SESSION['message']	=	$message;
    //var_dump($_SESSION['message']);
}

	function showMessage()
	{

		if ( isset($_SESSION['message']))
		{
			$message = $_SESSION['message'];
			unset($_SESSION['message']);
		}else
        {
            $message = FALSE;
        }

		return $message;
	}

?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>opdracht error handling</title>
</head>

<body class="web-backend-voorbeeld">

	<section class="body">

		<h1>opdracht error handling</h1>
        <?php if ( $message ): ?>

			<div class="modal <?= $message[ 'type' ] ?>"><?= $message[ 'text' ]?></div>
			
		<?php endif ?>
        
        <?php if($isValid): ?>
        <p>Korting toegekend!</p>
        <?php else: ?>
        <h2>Geef u kortingscode op</h2>
		<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
			
			<ul>
				<li>
					<label for="Kortingscode">Kortingscode</label>
					<input type="text" name="code" id="Kortingscode" >
				</li>
			</ul>
			<input type="submit" name="submit" value="Verzenden">

		</form>
		<?php endif ?>
	</section>

</body>
</html>