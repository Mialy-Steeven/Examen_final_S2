<?php
require "../inc/fonction.php";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Objet invalide");
}
$id_objet = (int)$_GET['id'];

$conn = dbconnect();

$sql_objet = "
    SELECT o.*, 
        c.nom_categorie,
        (SELECT nom_image FROM images_objet i WHERE i.id_objet = o.id_objet ORDER BY i.id_image ASC LIMIT 1) AS image_principale
    FROM objet o
    JOIN categorie_objet c ON o.id_categorie = c.id_categorie
    WHERE o.id_objet = $id_objet
";
$res_objet = mysqli_query($conn, $sql_objet);
if (mysqli_num_rows($res_objet) === 0) {
    die("Objet non trouvé");
}
$objet = mysqli_fetch_assoc($res_objet);

$sql_images = "SELECT * FROM images_objet WHERE id_objet = $id_objet ORDER BY id_image ASC";
$res_images = mysqli_query($conn, $sql_images);
$images = [];
while ($row = mysqli_fetch_assoc($res_images)) {
    $images[] = $row;
}

$sql_emprunts = "
    SELECT e.*, m.nom AS nom_emprunteur
    FROM emprunt e
    LEFT JOIN membre m ON e.id_membre = m.id_membre
    WHERE e.id_objet = $id_objet
    ORDER BY e.date_emprunt DESC
";
$res_emprunts = mysqli_query($conn, $sql_emprunts);
$emprunts = [];
while ($row = mysqli_fetch_assoc($res_emprunts)) {
    $emprunts[] = $row;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Fiche objet - <?= htmlspecialchars($objet['nom_objet']) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($objet['nom_objet']) ?></h1>
    <p>Catégorie : <?= htmlspecialchars($objet['nom_categorie']) ?></p>

    <h2>Image principale</h2>
    <?php if (!empty($objet['image_principale'])): ?>
        <img src="uploads/<?= htmlspecialchars($objet['image_principale']) ?>" alt="Image principale" width="300" />
    <?php else: ?>
        <img src="uploads/default.jpg" alt="Image par défaut" width="300" />
    <?php endif; ?>

    <h2>Autres images</h2>
    <?php if (count($images) > 1): ?>
        <?php foreach ($images as $img): ?>
            <?php if ($img['nom_image'] !== $objet['image_principale']): ?>
                <img src="uploads/<?= htmlspecialchars($img['nom_image']) ?>" alt="Image secondaire" width="150" style="margin-right:10px;" />
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune autre image disponible.</p>
    <?php endif; ?>

    <h2>Historique des emprunts</h2>
    <?php if (count($emprunts) > 0): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Emprunteur</th>
                    <th>Date d'emprunt</th>
                    <th>Date de retour</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emprunts as $emprunt): ?>
                    <tr>
                        <td><?= htmlspecialchars($emprunt['nom_emprunteur']) ?></td>
                        <td><?= htmlspecialchars($emprunt['date_emprunt']) ?></td>
                        <td><?= !empty($emprunt['date_retour']) ? htmlspecialchars($emprunt['date_retour']) : 'Non retourné' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun emprunt pour cet objet.</p>
    <?php endif; ?>

    <p><a href="Liste_object.php">← Retour à la liste des objets</a></p>
</body>
</html>
