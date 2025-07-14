<?php 
require "../inc/fonction.php";

$categorie = isset($_GET['categorie']) ? $_GET['categorie'] : "";
$nom_obj = isset($_GET['nom']) ? $_GET['nom'] : "";
$dispo = isset($_GET['disponible']) ? 1 : 0;

$cat = [];
if ($categorie !== "" || $nom_obj !== "" || $dispo) {
    $cat = recherche_combinee($categorie, $nom_obj, $dispo);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Critère de recherche</title>
</head>
<body>
    <h1> Critère de recherche </h1>

    <?php if (!empty($cat)) : ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Nom Objet</th>
                    <th>Catégorie</th>
                    <th>Disponibilité</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cat as $objet) : ?>
                    <tr>
                        <td><?= htmlspecialchars($objet['nom_objet']) ?></td>
                        <td><?= htmlspecialchars($objet['nom_categorie']) ?></td>
                        <td><?= ($objet['disponible']) ? "Disponible" : "Indisponible" ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucun objet trouvé.</p>
    <?php endif; ?>
    <a href="Liste_object.php">Retour</a>
</body>
</html>