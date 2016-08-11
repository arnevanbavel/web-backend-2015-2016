<?php
session_start();
$admin = "arninio123@gmail.com";

if(isset($_POST["submit"]) && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false && !empty($_POST["naam"]) && !empty($_POST["bericht"])){ //zien of alles is ingevuld
    //variabelen plaatsten
    $email = $_POST["email"];       
    $naam = $_POST["naam"];
    $bericht = $_POST["bericht"];
    $from = "arninio123@gmail.com";
    
    try
	{
		$db = new PDO('mysql:host=localhost;dbname=opdracht-mail', 'root', '', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); //connectie maken
 
        $queryString = "insert into contact_messages(email, message, time_sent) values(:email, :message, now())"; //query voor in db te zetten
         
        $statement = $db->prepare($queryString); //voorbereiden
        
        
        $statement->bindValue(':email', $email);        //variabelen in query zetten
        $statement->bindValue(':message', $bericht );
        
		$statement->execute();            //query uitvoeren
        
        $header = 	"From: " . $from;        
        mail($admin, "ContactForm", $bericht, $header); //aan/titel/bericht/metadata
 
		$_SESSION["notification"] = array("type" => "succes", "message" => 'Uw bericht is verzonden.');
        
        if(!empty($_POST["kopie"])) //als kopie is aangevinkt
        {
            $berichtkopie = "Beste ". $naam . ", we hebben uw bericht ontvangen en zullen hier spoedig op reageren! Uw bericht: " . $bericht;
            mail($email, "We hebben uw bericht ontvangen!", $berichtkopie, $header); //nieuwe email verzenden
            
            $_SESSION["notification"] = array("type" => "succes", "message" => 'Uw bericht is verzonden. Check uw inbox (ook spam folder) om een kopie van uw bericht te raadplegen.'); //message laten zien wanneer het is gelukt
        }
	}
	catch ( PDOException $e )
	{
		$_SESSION["notification"] = array("type" => "error", "message" => 'Er ging iets mis bij het verzenden van het bericht. Probeer opnieuw.'); //fout opvangen
	}
}
   else {
            if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false){
         $_SESSION["notification"] = array("type" => "error", "message" => 'Gelieve een geldig e-mailadres in te vullen.');
     }
    else {
        $_SESSION["notification"] = array("type" => "error", "message" => 'Gelieve alle velden in te vullen.');
    } 
       if(!empty($_POST["email"])){$_SESSION["email"]=$_POST["email"];}
       if(!empty($_POST["bericht"])){$_SESSION["bericht"]=$_POST["bericht"];}
       if(!empty($_POST["naam"])){$_SESSION["naam"]=$_POST["naam"];}
       if(!empty($_POST["kopie"])){$_SESSION["kopie"]=$_POST["kopie"];}
       
    
       
   }
header('location: contact-form.php');
?>