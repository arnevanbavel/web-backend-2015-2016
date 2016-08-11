<?php 
//ajax request?
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){ // Check of de request een ajax-request was
    
    $admin = "arninio123@gmail.com";
    if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false && !empty($_POST["naam"]) && !empty($_POST["bericht"]))
    {
        
        $email = $_POST["email"];
        $naam = $_POST["naam"];
        $bericht = $_POST["bericht"];
        $from = "arninio123@gmail.com";
        
        try
        {
            $db = new PDO('mysql:host=localhost;dbname=opdracht-mail', 'root', '', array (PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
     
            $queryString = "insert into contact_messages(email, message, time_sent) values(:email, :message, now())";
    
            $statement = $db->prepare($queryString);
            
            
            $statement->bindValue(':email', $email);
            $statement->bindValue(':message', $bericht );
            
            $statement->execute();
            $header 		= 	"From: <$from>";        
            mail($admin, "ContactForm", $bericht, $header);
     
            $ajaxMessage = array("type" => "succes");
            
            if(!empty($_POST["kopie"]))
            {
                $berichtkopie = "Beste ". $naam . ", we hebben uw bericht ontvangen en zullen hier spoedig op reageren! Uw bericht: " . $bericht;
                
                mail($email, "We hebben uw bericht ontvangen!", $berichtkopie, $header);
                $ajaxMessage = array("type" => "succes");
            }
        }
        catch ( PDOException $e )
        {
            $ajaxMessage = array("type" => "error");
        }
    }
       else {
                if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false){
             $ajaxMessage = array("type" => "error");
         }
        else {
            $ajaxMessage = array("type" => "error");
        } 
           if(!empty($_POST["email"])){$_SESSION["email"]=$_POST["email"];}
           if(!empty($_POST["bericht"])){$_SESSION["bericht"]=$_POST["bericht"];}
           if(!empty($_POST["naam"])){$_SESSION["naam"]=$_POST["naam"];}
           if(!empty($_POST["kopie"])){$_SESSION["kopie"]=$_POST["kopie"];}
           
        
           
       }
        
        echo json_encode($ajaxMessage);
    
}
?>