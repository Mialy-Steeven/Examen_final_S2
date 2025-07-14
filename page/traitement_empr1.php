<?php 
require "../inc/fonction.php";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["retour_id"])) {
    $id_emprunt = $_POST["retour_id"];
    $etat = $_POST["etat"] ?? "intact";

    $db = dbconnect();

   
    mysqli_query($db, "UPDATE emprunt SET date_retour = CURDATE() WHERE id_emprunt = $id_emprunt");

    
    mysqli_query($db, "INSERT INTO etat_retour (id_emprunt, etat) VALUES ($id_emprunt, '$etat')");

    header("Location: fiche_membre.php");
    exit;
}
?>