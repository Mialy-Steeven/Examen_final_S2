<?php
require "../inc/fonction.php";
$liste_object = list_object();
$liste_objet_cat = list_object_cat();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des objets</title>
</head>

<body>

    <h1>Liste des objets</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Nom de l'objet</th>
                <th>Date de retour</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($liste_object as $value): ?>
                <tr>
                    <td><?= $value["nom_objet"] ?></td>
                    <td>
                        <?= !empty($value["date_retour"])
                            ? $value["date_retour"]
                            : "en cours" ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h1>Liste des objets par categorie </h1>

    <table border="1">
        <thead>
            <tr>
                <th>Nom de la categorie</th>
                <th>Nom de l'objet</th>
                <th>Date de retour</th>
                <th>Emprunteur</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($liste_objet_cat as $value): ?>
                <tr>
                    <td><?= $value["nom_categorie"] ?></td>
                    <td><?= $value["nom_objet"] ?></td>
                    <td>
                        <?= !empty($value["date_retour"])
                            ? $value["date_retour"]
                            : "en cours" ?>
                    </td>
                    <td><?= $value["nom"] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>