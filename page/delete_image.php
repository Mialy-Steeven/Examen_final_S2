<?php
require "../inc/fonction.php";

$id = $_GET['id'];
$file = $_GET['file'];

mysqli_query(dbconnect(), "DELETE FROM images_objet WHERE id_image = $id");

$path = __DIR__ . '/uploads/' . $file;
if (file_exists($path)) {
    unlink($path);
}

header("Location: Liste_object.php");
