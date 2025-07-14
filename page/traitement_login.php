<?php 
require "../inc/fonction.php";
session_start();
if (isset($_GET["nom"]) && isset($_GET["email"]) && isset($_GET["passwd"])) {
    $email = $_GET["email"];
    $nom=$_GET["nom"];
    $mot_de_pass = $_GET["passwd"];
    $sql=mysqli_query(dbconnect(),"SELECT * from membre where email='$email' and nom='$nom' and mdp='$mot_de_pass' ");
  if (mysqli_num_rows($sql)> 0) {
    $row = mysqli_fetch_array($sql);
    $_SESSION["user"] =$row;
    header("Location: Liste_object.php");
  }else{
        header("Location: page_login.php?err=1");
  }
}
?>
