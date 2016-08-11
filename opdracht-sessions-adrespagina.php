<?php	
	session_start();

    if(isset($_POST['submit']))
    {
        $_SESSION['email'][0]=$_POST['email'];
        $_SESSION['nickname'][0]=$_POST['nickname'];
    }
    
    $straat	=	( isset( $_SESSION[ 'straat'] ) ) ? $_SESSION[ 'straat'][0] : '';
	$nummer=	( isset( $_SESSION[ 'nummer'] ) ) ? $_SESSION[ 'nummer'][0] : '';
    $gemeente	=	( isset( $_SESSION[ 'gemeente'] ) ) ? $_SESSION[ 'gemeente'][0] : '';
	$postcode=	( isset( $_SESSION[ 'postcode'] ) ) ? $_SESSION[ 'postcode'][0] : '';

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

		<h1>Registratiegegevens</h1>
        <p>- <?php echo $_SESSION['email'][0] ?></p>
        <p>- <?php echo $_SESSION['nickname'][0] ?></p>
		
        <h1>Deel2: adres</h1>
        <form action="opdracht-sessions-overzichtspagina.php" method="post">
            <label for="straat">straat:</label>
            <input type="text" name="straat" id="straat" value="<?= $straat ?>" <?= ( isset( $_GET['focus'] ) && $_GET['focus'] == $straat ) ? 'autofocus' : '' ?>>
            
            <label for="nummer">nummer:</label>
            <input type="number" name="nummer" id="nummer" value="<?= $nummer ?>" <?= ( isset( $_GET['focus'] ) && $_GET['focus'] == $nummer ) ? 'autofocus' : '' ?>>
            
            <label for="gemeente">gemeente:</label>
            <input type="text" name="gemeente" id="gemeente" value="<?= $gemeente ?>" <?= ( isset( $_GET['focus'] ) && $_GET['focus'] == $gemeente ) ? 'autofocus' : '' ?>>
            
            <label for="postcode">postcode:</label>
            <input type="text" name="postcode" id="postcode" value="<?= $postcode ?>" <?= ( isset( $_GET['focus'] ) && $_GET['focus'] == $postcode ) ? 'autofocus' : '' ?>>
            
            <input type="submit" name="submit" value="Volgende">
        </form>
	</section>
    <pre>
        <?php var_dump($_SESSION);  ?>
    </pre>
</body>
</html>