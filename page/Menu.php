<?php
require "../inc/fonction.php";


$tot = nb_total_emprunts_rendu();

$ok = ok ();

$abimes = simba();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques des objets empruntés</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h1 class="mb-4">Statistiques sur les objets empruntés</h1>

    <div class="card mb-3">
        <div class="card-body">
            <?php foreach ($tot as $key => $value) { ?>
                <h4>Total des objets rendus : <span class="badge bg-primary"><?= $value['total']; ?></span></h4>
            <?php }?>
            <?php foreach ($ok as $key => $value) { ?>
            <h5>Objets rendus intacts : <span class="badge bg-success"><?= $value['total']; ?></span></h5>
            <?php }?>
            <?php foreach ($abimes as $key => $value) { ?>
            <h5>Objets rendus abîmés : <span class="badge bg-danger"><?= $value['total']; ?></span></h5>
            <?php }?>
        </div>
    </div>

    <a href="Liste_object.php" class="btn btn-secondary">← Retour à la liste des objets</a>
</body>
</html>
