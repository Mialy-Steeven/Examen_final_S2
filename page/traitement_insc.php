<?php
require "../inc/fonction.php";
session_start();
$uploadDir = __DIR__ . '/uploads/';
$maxSize = 1024 * 1024 * 1024; // 1go 
$allowedMimeTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/svg+xml', 'image/webp', 'application/pdf'];


if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}
// Vérifie si un fichier est soumis

/*if (isset($_POST["title"]) && isset($_POST["description"])) {
    $_SESSION['titre'] = $_POST["title"];
    $_SESSION['desc'] = $_POST["description"];
}*/

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['media'])) {
    $file = $_FILES['media'];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Erreur lors de l’upload : ' . $file['error']);
    }
    // Vérifie la taille 
    if ($file['size'] > $maxSize) {
        die('Le fichier est trop volumineux.');
    }
    // Vérifie le type MIME avec `finfo` 
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    if (!in_array($mime, $allowedMimeTypes)) {
        die('Type de fichier non autorisé : ' . $mime);
    }
    // renommer le fichier 
    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = $originalName . '_' . uniqid() . '.' . $extension;



    // Déplace le fichier 
    if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
        echo "Fichier uploadé avec succès : " . $newName;
        $_SESSION['extension'] = $extension;
        $_SESSION['nom'] = $newName;
        if (isset($_POST["nom"]) && isset($_POST["email"]) && isset($_POST["passwd"]) && isset($_POST["date_naiss"]) && isset($_POST["genre"]) && isset($_POST["ville"])) {
            $email = $_POST["email"];
            $nom = $_POST["nom"];
            $mot_de_pass = $_POST["passwd"];
            $date_naissance = $_POST["date_naiss"];
            $genre = $_POST["genre"];
            $ville = $_POST["ville"];
            $sql = mysqli_query(dbconnect(), "INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp, image_profil)
            VALUES ('$nom','$date_naissance','$genre','$email','$ville','$mot_de_pass','$newName')");
        }
        header("Location: Liste_object.php");
    } else {
        echo "Échec du déplacement du fichier.";
    }
} else {
    echo "Aucun fichier reçu.";
}
?>