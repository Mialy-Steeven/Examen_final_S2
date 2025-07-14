<?php 
$id_ob=$_GET["id_ob"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>choix jour</title>
</head>
<body>
    <form action="traitement_emprunt.php?id_o=<?=$id_ob?>" method="get">
        <p>Nb_jour emprunt :</p>
        <input type="number" name="jour" id="">
        <input type="submit" value="Emprunter pour ce delai">
    </form>
</body>
</html>