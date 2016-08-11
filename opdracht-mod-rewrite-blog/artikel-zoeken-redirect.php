<?php 
if(isset($_GET["zoeken-artikel"]) && !empty($_GET["zoeken-artikel"])){
    
    $zoekterm = $_GET["zoeken-artikel"];
    header('location: zoeken/content/'.$zoekterm);
    
}
elseif(isset($_GET["zoeken-datum"]) && !empty($_GET["zoeken-datum"])){
    
    $zoekterm = $_GET["zoeken-datum"];
    header('location: zoeken/datum/'.$zoekterm);
    
}
?>