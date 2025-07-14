<?php 
require "connexion.php";
ini_set("display_errors","1");

function list_object () {
    $req1 = mysqli_query(dbconnect(),"SELECT nom_objet,date_retour,nom_image,id_image,id_objet FROM v_list_object "); 
    $res=array();
    while($result1 = mysqli_fetch_array($req1)){
        $res[]=$result1;
    }
    return $res;  
}

function list_object_cat() {
    $req1 = mysqli_query(dbconnect(),"SELECT * FROM v_liste_objet_categorie "); 
    $res=array();
    while($result1 = mysqli_fetch_array($req1)){
        $res[]=$result1;
    }
    return $res;  
}

function list_cat()
{
    $req1 = mysqli_query(dbconnect(), "SELECT * FROM v_lis_categorie ");
    $res = array();
    while ($result1 = mysqli_fetch_array($req1)) {
        $res[] = $result1;
    }
    return $res;
}

function recherche_par_categorie($categorie) {
    $conn = dbconnect();
    $categorie = mysqli_real_escape_string($conn, $categorie);

    $sql = "SELECT o.nom_objet, co.nom_categorie, o.disponible
            FROM objet o
            JOIN categorie_objet co ON co.id_categorie = o.id_categorie
            WHERE co.nom_categorie = '$categorie'";

    $req = mysqli_query($conn, $sql);

    $res = array();
    while ($row = mysqli_fetch_assoc($req)) {
        $res[] = $row;
    }
    return $res;
}

function recherche_par_nom($nom) {
    $conn = dbconnect();
    $nom = mysqli_real_escape_string($conn, $nom);

    $sql = "SELECT o.nom_objet, co.nom_categorie, o.disponible
            FROM objet o
            JOIN categorie_objet co ON co.id_categorie = o.id_categorie
            WHERE o.nom_objet LIKE '%$nom%'";

    $req = mysqli_query($conn, $sql);

    $res = array();
    while ($row = mysqli_fetch_assoc($req)) {
        $res[] = $row;
    }
    return $res;
}

function recherche_combinee($categorie, $nom, $disponible) {
    $conn = dbconnect();

    $conditions = array();

    if ($categorie != "") {
        $categorie = mysqli_real_escape_string($conn, $categorie);
        $conditions[] = "co.nom_categorie = '$categorie'";
    }

    if ($nom != "") {
        $nom = mysqli_real_escape_string($conn, $nom);
        $conditions[] = "o.nom_objet LIKE '%$nom%'";
    }

    $where = "";
    if (!empty($conditions)) {
        $where = "WHERE " . implode(" AND ", $conditions);
    }

    $sql = " SELECT 
            o.id_objet,
            o.nom_objet,
            co.nom_categorie,
            IF(e.id_objet IS NULL, 1, 0) AS disponible
        FROM objet o
        JOIN categorie_objet co ON co.id_categorie = o.id_categorie
        LEFT JOIN (
            SELECT DISTINCT id_objet
            FROM emprunt
            WHERE date_retour IS NULL
        ) e ON o.id_objet = e.id_objet
        $where
    ";

    if ($disponible) {
        $sql = "SELECT * FROM ($sql) as tmp WHERE tmp.disponible = 1";
    }

    $req = mysqli_query($conn, $sql);

    $res = array();
    while ($row = mysqli_fetch_assoc($req)) {
        $res[] = $row;
    }
    return $res;
}


?>