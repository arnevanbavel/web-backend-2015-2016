<?php 
session_start();
    
    if(isset($_POST['submit']))
    {
        $_SESSION['titel'] = $_POST['titel'];
        $_SESSION['artikel'] = $_POST['artikel'];
        $_SESSION['kernwoorden'] = $_POST['kernwoorden'];
        $_SESSION['datum'] = $_POST['datum'];
    
    
    try
    {
       $db = new pdo('mysql:host=localhost;dbname=opdracht_mod_rewrite_blog','root','', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
        
        $queryString ="insert into artikels
    (Titel,Artikel,Kernwoorden,Datum)
    values
    (:Titel,:Artikel,:Kernwoorden,:Datum)";
       
        $statement = $db -> prepare($queryString);
        
        $statement->bindValue(':Titel', $_POST['titel'] );
        $statement->bindValue(':Artikel', $_POST['artikel'] );
        $statement->bindValue(':Kernwoorden', $_POST['kernwoorden'] );
        $statement->bindValue(':Datum', /*date("d-m-Y", strtotime())*/$_POST['datum']);
        
        $gelukt = $statement->execute();
                              
        if ($gelukt)
        {
            $_SESSION['notification'] = 'Het artikel werd toegevoegd.';
            header('location:artikel-overzicht.php');
        }
        else
        {
            $_SESSION['notification'] = 'Er ging iets mis bij het toevoegen. Gelieve alle velden juist in te vullen.';
            header('location:artikel-toevoegen-form.php');
        }
    }
    catch( PDOException $e ){
    $_SESSION['notification'] = 'Er ging iets mis: '.$e->getmessage();
    }
    }
    
?>