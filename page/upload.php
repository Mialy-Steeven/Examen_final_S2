<?php
require "../inc/fonction.php";
session_start();

$uploadDir = __DIR__ . '/uploads/';
$maxSize = 1024 * 1024 * 1024;
$allowedMimeTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/svg+xml', 'image/webp', 'application/pdf'];

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['media'])) {
    $file = $_FILES['media'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Erreur lors de l’upload : ' . $file['error']);
    }

    if ($file['size'] > $maxSize) {
        die('Le fichier est trop volumineux.');
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mime, $allowedMimeTypes)) {
        die('Type de fichier non autorisé : ' . $mime);
    }

    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = $originalName . '_' . uniqid() . '.' . $extension;

    if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
        echo "Fichier uploadé avec succès : " . $newName;

        $_SESSION['extension'] = $extension;
        $_SESSION['nom'] = $newName;

        if (isset($_POST["nom"], $_POST["cat"])) {
            $nom = $_POST["nom"];
            $cat = $_POST["cat"];
            $id_user = $_SESSION["user"]["id_membre"];

            // ❗ Crée UNE SEULE connexion
            $db = dbconnect();

            // Insertion de l'objet
            $sql = mysqli_query($db, "INSERT INTO objet (nom_objet, id_categorie, id_membre)
                                      VALUES ('$nom', '$cat', '$id_user')");

            // Récupère l’ID de l’objet depuis cette même connexion
            $id_object = mysqli_insert_id($db);

            // Insertion de l’image
            $sql3 = mysqli_query($db, "INSERT INTO images_objet (id_objet, nom_image)
                                       VALUES ('$id_object', '$newName')");
        }

        header("Location: Liste_object.php");
        exit;
    } else {
        echo "Échec du déplacement du fichier.";
    }
} else {
    echo "Aucun fichier reçu.";
}
?>
