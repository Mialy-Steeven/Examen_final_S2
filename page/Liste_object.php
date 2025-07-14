<?php
require "../inc/fonction.php";
$liste_object = list_object();
$liste_objet_cat = list_object_cat();
$list_cat = list_cat();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-icons.css" />
    <link rel="stylesheet" href="../assets/bootstrap/styles/style.css" />
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <title>Gestion des Objets - Système de Gestion</title>
</head>

<body>
    <div class="main-container">

        <!-- Header -->
        <div class="page-header fade-in">
            <h1 class="page-title">
                <i class="bi bi-collection"></i>
                Gestion des Objets
            </h1>
            <p class="page-subtitle">Suivi et gestion des objets empruntés</p>
        </div>

        <div>
            <form method="GET" action="recherche.php">
                <label for="categorie">Catégorie :</label>
                <select name="categorie" id="categorie">
                    <option value="">categorie objet</option>
                    <?php foreach ($list_cat as $key => $value) { ?>
                        <option value="<?= $value['nom_categorie'];?>"><?=$value['nom_categorie'];?></option>
                    <?php }?>
                </select>
                <br>
                
                <label for="nom">Nom de l’objet :</label>
                <input type="text" name="nom" id="nom" placeholder="objet">
                <br>
                
                <input type="checkbox" name="disponible" id="disponible" value="1">
                <label for="disponible">Disponible uniquement</label>
                <br>
                
                <input type="submit" value="Rechercher">
            </form>
        </div>

        <!-- Tableau 1: Liste des objets -->
        <div class="table-container fade-in">
            <h2 class="table-title">
                <i class="bi bi-list-ul"></i>
                Liste des Objets
            </h2>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>
                                <i class="bi bi-box"></i>
                                Nom de l'objet
                            </th>
                            <th>
                                <i class="bi bi-calendar-check"></i>
                                Date de retour
                            </th>
                            <th>
                                <i class="bi bi-info-circle"></i>
                                Statut
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($liste_object as $value): ?>
                            <tr class="slide-in">
                                <td>
                                    <strong><?= htmlspecialchars($value["nom_objet"]) ?></strong>
                                </td>
                                <td>
                                    <?php if (!empty($value["date_retour"])): ?>
                                        <i class="bi bi-calendar-event"></i>
                                        <?= htmlspecialchars($value["date_retour"]) ?>
                                    <?php else: ?>
                                        <i class="bi bi-clock"></i>
                                        En cours
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($value["date_retour"])): ?>
                                        <span class="status-badge status-returned">
                                            <i class="bi bi-check-circle"></i>
                                            Rendu
                                        </span>
                                    <?php else: ?>
                                        <span class="status-badge status-pending">
                                            <i class="bi bi-clock"></i>
                                            En cours
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if (empty($liste_object)): ?>
                <div class="text-center" style="padding: 40px; color: var(--text-light);">
                    <i class="bi bi-inbox" style="font-size: 3rem; margin-bottom: 15px;"></i>
                    <p>Aucun objet trouvé dans la base de données.</p>
                </div>
            <?php endif; ?>
        </div>
        <a href="list_obj_cat.php">Liste objet par categorie</a>
</body>

</html>