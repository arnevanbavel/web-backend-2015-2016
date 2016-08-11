<?php	
	session_start();

    if(isset($_POST['submit']))
    {
        $_SESSION['straat'][0]=$_POST['straat'];
        $_SESSION['nummer'][0]=$_POST['nummer'];
        $_SESSION['gemeente'][0]=$_POST['gemeente'];
        $_SESSION['postcode'][0]=$_POST['postcode'];
    }
    
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

		<h1>overzichtspagina</h1>
        <p>- <?php echo $_SESSION['email'][0] ?> | <a href="opdracht-sessions.php?focus=<?= $_SESSION['email'][0] ?>">wijzig</a></p>
        <p>- <?php echo $_SESSION['nickname'][0] ?> | <a href="opdracht-sessions.php?focus=<?= $_SESSION['nickname'][0] ?>">wijzig</a></p>
        <p>- <?php echo $_SESSION['straat'][0] ?> | <a href="opdracht-sessions-adrespagina.php?focus=<?= $_SESSION['straat'][0] ?>">wijzig</a></p>
        <p>- <?php echo $_SESSION['nummer'][0] ?> | <a href="opdracht-sessions-adrespagina.php?focus=<?= $_SESSION['nummer'][0] ?>">wijzig</a></p>
        <p>- <?php echo $_SESSION['gemeente'][0] ?> | <a href="opdracht-sessions-adrespagina.php?focus=<?= $_SESSION['gemeente'][0] ?>">wijzig</a></p>
        <p>- <?php echo $_SESSION['postcode'][0] ?> | <a href="opdracht-sessions-adrespagina.php?focus=<?= $_SESSION['postcode'][0] ?>">wijzig</a></p>
		
	</section>
    <pre>
        <?php var_dump($_SESSION);  ?>
    </pre>
</body>
</html>