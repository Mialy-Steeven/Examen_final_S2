<?php 
require "../inc/fonction.php";

$categorie = $_GET['categorie'] ;
echo $categorie;
$cat = recherche_jiaby($categorie);

$nom_obj = $_GET['nom'] ;
echo $nom_obj;

$dispo = $_GET['disponible'] ;
echo $dispo;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Critere de recherche</title>
</head>
<body>
    <h1> Critere de recherche </h1>
</body>
</html>