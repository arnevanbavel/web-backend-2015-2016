<?php
    session_start();
    
    $link = str_replace(basename(__FILE__), '', $_SERVER['REQUEST_URI']);
    
    $zoekterm = '';
    $jaar = 2010;
    $fetchRow = array();
    $message='';
    if(isset($_SESSION['notification']))
    {
        $message = $_SESSION['notification'];
        unset($_SESSION['notification']);
    }
    try
    {
        $db = new pdo('mysql:host=localhost;dbname=opdracht_mod_rewrite_blog','root','', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        
        
        if (isset($_GET['zoekInArtikel']))   
        {
            $zoekterm = 'artikels die het woord "'.$_GET['artikel'].'" bevatten';
            
            $zoekArtikelQueryString = "Select * from artikels
                                        WHERE artikel LIKE :artikel";
            
            $statement2 = $db -> prepare($zoekArtikelQueryString);
            $statement2->bindValue(':artikel','%'. $_GET['artikel'].'%' );
            $statement2->execute();
            $fetchRow = array();
            while ( $row = $statement2->fetch(PDO::FETCH_ASSOC) )
            {
                $fetchRow[]	=	$row;
            }  
        
        }
        
        if(isset($_GET['zoekOpDatum']))
        {
            $jaar = $_GET['jaar'];
            $zoekterm = 'artikels geschreven in "'.$_GET['jaar'].'"';
            
            $zoekOpDatumQueryString = "Select * from artikels
                                        WHERE year(Datum) = :jaar";
            
            $statement3 = $db -> prepare($zoekOpDatumQueryString);
            $statement3->bindValue(':jaar', $_GET['jaar']);
            $statement3->execute();
            $fetchRow = array();
            while ( $row = $statement3->fetch(PDO::FETCH_ASSOC) )
            {
                $fetchRow[]	=	$row;
            }
        }  
    }
    catch( PDOException $e ){
    $_SESSION['notification'] = 'Er ging iets mis: '.$e->getmessage();
    }
    
    
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <p><?php echo $message ?></p>
        <form action="artikel-zoeken.php" method="get">
            <label for="artikel">Zoeken in artikels:</label>
            <input type="text" name="artikel" id="artikel" >
            <input type="submit" name="zoekInArtikel" value="Zoeken">
        <form><br><br>
            
        <form action="artikel-zoeken.php" method="get">          
            <label for="jaar">Zoeken op datum:</label>
            <select name="jaar">
                <?php for($i=2010;$i<2019;$i++): ?>
                    <?php if($jaar == $i): ?>
                        <option value="<?php echo $i?>" selected><?php echo $i ?></option>
                    <?php else: ?>
                         <option value="<?php echo $i?>"><?php echo $i ?></option>
                    <?php endif?>
                <?php endfor ?>
            </select>
            <input type="submit" name="zoekOpDatum" value="Zoeken">
        </form>
            
        <h2><?php echo $zoekterm ?>:</h2>
        <a href="artikel-overzicht.php">Terug naar overzicht</a>
        
        <?php foreach ($fetchRow as $row => $rowdata): ?>
            <article>
                <h3><?php echo $rowdata['Titel'] ?> | <?php echo $rowdata['Datum'] ?></h3>
                <p><?php echo $rowdata['Artikel'] ?></p>
                <p>Keywords: <?php echo $rowdata['Kernwoorden'] ?></p>
            </article>
        <?php endforeach ?>
    </body>
</html>