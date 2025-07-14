<?php
require "../inc/fonction.php";
session_start();

if (isset($_GET["id_o"]) && isset($_GET["jour"])) {
    $jour = intval($_GET["jour"]);
    $id_o = $_GET["id_o"];
    $id_user = $_SESSION["user"]["id_membre"];

    $date_retour = date('Y-m-d', strtotime("+$jour days"));

    $sql = mysqli_query(dbconnect(), 
        "INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) 
         VALUES ('$id_o', '$id_user', NOW(), '$date_retour')"
    );

    header("Location: Liste_object.php");
    exit();
}
?>
