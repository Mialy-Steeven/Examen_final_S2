<?php
require "../inc/fonction.php";
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

$id_membre = $_SESSION["user"]["id_membre"];

// Traitement retour
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["retour_id"])) {
    $id_emprunt = $_POST["retour_id"];
    $etat = $_POST["etat"] ?? "intact";

    $db = dbconnect();

    // mise à jour date_retour
    mysqli_query($db, "UPDATE emprunt SET date_retour = CURDATE() WHERE id_emprunt = $id_emprunt");

    // enregistre l'état
    mysqli_query($db, "INSERT INTO etat_retour (id_emprunt, etat) VALUES ($id_emprunt, '$etat')");

    header("Location: mes_emprunts.php");
    exit;
}

$emprunts = list_emprunt_membre($id_membre);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Emprunts</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-icons.css">
    <style>
        img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }
        .etat-form {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body class="container mt-5">
    <h2 class="mb-4">Mes emprunts</h2>

    <?php if (empty($emprunts)) : ?>
        <div class="alert alert-info">Aucun emprunt trouvé.</div>
    <?php else : ?>
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Objet</th>
                    <th>Catégorie</th>
                    <th>Début</th>
                    <th>Retour</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emprunts as $e) : ?>
                    <tr>
                        <td><?= htmlspecialchars($e['nom_objet']) ?></td>
                        <td><?= htmlspecialchars($e['nom_categorie']) ?></td>
                        <td><?= htmlspecialchars($e['date_emprunt']) ?></td>
                        <td><?= $e['date_retour'] ?? '<span class="text-warning">-</span>' ?></td>
                        <td>
                            <?php if ($e['date_retour']) : ?>
                                <span class="badge bg-success">Terminé</span>
                            <?php else : ?>
                                <span class="badge bg-warning text-dark">En cours</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!$e['date_retour']) : ?>
                                <form method="post" action="traitement_empr1.php" class="etat-form">
                                    <input type="hidden" name="retour_id" value="<?= $e['id_emprunt'] ?>">
                                    <select name="etat" class="form-select form-select-sm" required>
                                        <option value="intact">Intact</option>
                                        <option value="abime">Abîmé</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-arrow-return-left"></i> Retourner
                                    </button>
                                </form>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <a href="Menu.php">statistique</a>
</body>
</html>
