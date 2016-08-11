<?php

    $md5HashKey = 'd1fa402db91a7a93c4f414b8278ce073';
    
    $tel1 =	"2";
	$tel2 =	"8";
	$tel3 =	"a";

	function tellen1( $md5HashKey, $tel )
	{
		$aantalkeerTel = substr_count ( $md5HashKey, $tel ); // geeft hoeveel keer tel voorkomt in md5HashKey
        $md5leng =  strlen( $md5HashKey ); //geeft lengte

		$procent = ( $aantalkeerTel / $md5leng ) * 100;
        return $procent;
	}

    function tellen2( $tel )
	{
        $md5HashKey = $GLOBALS['md5HashKey'];
		$aantalkeerTel = substr_count ( $md5HashKey, $tel ); // geeft hoeveel keer tel voorkomt in md5HashKey
        $md5leng =  strlen( $md5HashKey ); //geeft lengte

		$procent = ( $aantalkeerTel / $md5leng ) * 100;
        return $procent;
	}

    function tellen3( $tel )
	{
        global $md5HashKey;
		$aantalkeerTel = substr_count ( $md5HashKey, $tel ); // geeft hoeveel keer tel voorkomt in md5HashKey
        $md5leng =  strlen( $md5HashKey ); //geeft lengte

		$procent = ( $aantalkeerTel / $md5leng ) * 100;
        return $procent;
	}

    
    $Antwoord1 = tellen1( $md5HashKey, $tel1 );
    $Antwoord2 = tellen2( $tel2 );
    $Antwoord3 = tellen3( $tel3 );

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht functies: deel 1</title>
	</head>
	<body>
		<h1>Opdracht functies: deel 1</h1>
        <p>Functie 1: De needle '<?= $tel1 ?>' komt <?= $Antwoord1 ?>% voor in de hash key 'd1fa402db91a7a93c4f414b8278ce073'</p>
        <p>Functie 2: De needle '<?= $tel2 ?>' komt <?= $Antwoord2 ?>% voor in de hash key 'd1fa402db91a7a93c4f414b8278ce073'</p>
        <p>Functie 3: De needle '<?= $tel3 ?>' komt <?= $Antwoord3 ?>% voor in de hash key 'd1fa402db91a7a93c4f414b8278ce073'</p>
	</body>
</html>