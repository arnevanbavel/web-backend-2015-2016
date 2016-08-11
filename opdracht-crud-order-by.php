<?php

    $errorbericht = '';


        try
        {
            $db = new PDO('mysql:host=localhost;dbname=bieren', 'root','', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));     //connectie maken  
            
            $orderColumn	=	'bieren.biernr';         //oreder op biernr
            $order			=	'ASC';                   //order ASC
    
            if ( isset( $_GET[ 'orderBy' ] ) )          // wanneer op th gedrukt wordt kolom naam terug gestuurd en DESC of ASC
            {
                $orderArray		=	explode( '-', $_GET[ 'orderBy' ] ); //explode split een string nu wanneer het - tegen komt
                $orderColumn	=	$orderArray[ 0 ];                    //de kolom naam
    
                $order		=	$orderArray[ 1 ];                         // ASC of DESC
            }
    
            $orderQuery		=	'ORDER BY ' . $orderColumn . ' ' . $order;   //query opstellen
    
            if ( isset( $_GET[ 'orderBy' ] ) )  
            {
                $order = ( $orderArray[ 1 ] != 'DESC') ? 'DESC' 	:	'ASC'; //order word gewisselt
            }
    
            $query	=	'SELECT bieren.biernr,
                                bieren.naam,
                                brouwers.brnaam,
                                soorten.soort,
                                bieren.alcohol 
                            FROM bieren 
                                INNER JOIN brouwers
                                ON bieren.brouwernr	= brouwers.brouwernr
                                INNER JOIN soorten
                                ON bieren.soortnr = soorten.soortnr '
                                . $orderQuery;                              //query opstellen/samenvoegen
    
            $bierenQuery	=	query( $db, $query  ) ;                      //krijggt array terug met veldnamen en data
    
            $bierenFieldnames		= 	$bierenQuery[ 'fieldnames' ];
            $bierenCleanFieldnames	= 	processFieldnames( $bierenFieldnames );   //in deze functie worden den veeldnamen "mooier" geschreven
            $bieren	                =	$bierenQuery[ 'data' ];
        }
        catch ( PDOException $e )
        {
            $errorbericht	=	'Er ging iets mis: ' . $e->getMessage();
        }

        function query( $db, $query, $tokens = false )
        {
            $statement = $db->prepare( $query );
            
            if ( $tokens )
            {
                foreach ( $tokens as $token => $tokenValue )
                {
                    $statement->bindValue( $token, $tokenValue );
                }
            }
    
            $statement->execute();
    
            /*  Veldnamen ophalen*/
            $fieldnames	=	array();
    
            for ( $fieldNumber = 0; $fieldNumber < $statement->columnCount(); ++$fieldNumber )  //de header krijgen (kolom namen verkrijgen
            {
                $fieldnames[]	=	$statement->getColumnMeta( $fieldNumber )['name'];
            }
    
            /*De brouwer-data ophalen*/
            $data	=	array();
    
            while( $row = $statement->fetch( PDO::FETCH_ASSOC ) )
            {
                $data[]	=	$row;
            }
    
            $returnArray['fieldnames']	=	$fieldnames;
            $returnArray['data']		=	$data;
    
            return $returnArray;
        }

        function processFieldnames( $array )
        {
    
            $cleanFieldnames	=	array();
    
            foreach( $array as $value )
            {
                switch( $value )
                {
                    case "biernr":
                        $name	=	"Biernummer (PK)";
                        break;
                    case "naam":
                        $name	=	"Bier";
                        break;
                    case "brnaam":
                        $name	=	"Brouwer";
                        break;
                    case "soort":
                        $name	=	"Soort";
                        break;
                    case "alcohol":
                        $name	=	"Alcoholpercentage";
                        break;
                    default:
                        $name	=	$value;
                }
    
                $cleanFieldnames[ ]	=	$name;
            }
    
            return $cleanFieldnames;
        }

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Opdracht Crud delete</title>
		    <link rel="stylesheet" href="http://web-backend.local/css/global.css">
            <link rel="stylesheet" href="http://web-backend.local/css/facade.css">
            <link rel="stylesheet" href="http://web-backend.local/css/directory.css">
        <style>
            .order a
			{
				padding-right:20px;
			}
            .ascending a
			{
				background:	no-repeat url('img/icon-asc.png') right ;
			}

			.descending a
			{
				background:	no-repeat url('img/icon-desc.png') right;
			}
        </style>
	</head>
<body>

    <p><?= $errorbericht ?></p>
	<table>
		
		<thead>
			<tr>
				<?php foreach ($bierenCleanFieldnames as $key => $cleanFieldname): ?>
					<th class="order <?= ( $order == 'ASC' && $orderColumn == $bierenFieldnames[ $key ] ) ? 'descending' : 'ascending' ?> 
                               <?= ( $orderColumn == $bierenFieldnames[ $key ] ) ? 'selected' : '' ?>">
                        <a href="<?= $_SERVER['PHP_SELF'] ?>?orderBy=<?= $bierenFieldnames[ $key ] ?>-<?= $order ?>"><?= $cleanFieldname ?></a></th>
				<?php endforeach ?>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($bieren as $key => $brouwer): ?>
				<tr class="<?= ( ($key + 1) % 2 == 0 ) ? 'even' : '' ?>">
					<?php foreach ($brouwer as $value): ?>
						<td><?= $value ?></td>
					<?php endforeach ?>
				</tr>
			<?php endforeach ?>
			
		</tbody>

	</table>

</body>
</html>